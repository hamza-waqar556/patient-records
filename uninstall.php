<?php

/**
 * Trigger this file on Plugin uninstall.
 *
 * @package TourBooking
 */

defined('WP_UNINSTALL_PLUGIN') or die;


/**
 * Deletes posts and associated data for specified custom post types.
 *
 * This function checks if posts exist for each CPT before attempting deletion.
 *
 * @param array $post_types Array of custom post type names.
 * @return void
 */
function clearPostTypeData($post_types = [])
{
    if (empty($post_types))
    {
        return;
    }

    global $wpdb;
    foreach ($post_types as $post_type)
    {
        // Check if any posts of this type exist.
        $count = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT COUNT(*) FROM {$wpdb->posts} WHERE post_type = %s",
                $post_type
            )
        );
        if ($count > 0)
        {
            // Delete posts of the given post type.
            $wpdb->query(
                $wpdb->prepare(
                    "DELETE FROM {$wpdb->posts} WHERE post_type = %s",
                    $post_type
                )
            );
        }
    }

    // Clean orphaned post meta.
    $wpdb->query(
        "DELETE FROM {$wpdb->postmeta}
         WHERE post_id NOT IN (SELECT ID FROM {$wpdb->posts})"
    );

    // Clean orphaned term relationships.
    $wpdb->query(
        "DELETE FROM {$wpdb->term_relationships}
         WHERE object_id NOT IN (SELECT ID FROM {$wpdb->posts})"
    );
}

/**
 * Deletes plugin tables from the database.
 *
 * For each table provided, it first checks if the table exists using a SHOW TABLES query.
 * If it does, the table is dropped. Otherwise, it is simply skipped.
 *
 * @param array $tables Array of table names (with prefix) to drop.
 * @return void
 */
function deletePluginTables($tables = [])
{
    if (empty($tables))
    {
        return;
    }

    global $wpdb;
    foreach ($tables as $table_name)
    {
        // Check if the table exists.
        $result = $wpdb->get_var("SHOW TABLES LIKE '{$table_name}'");
        if ($result !== $table_name)
        {
            // Table does not exist, skip.
            continue;
        }
        // Drop the table.
        $wpdb->query("DROP TABLE IF EXISTS `{$table_name}`");
    }
}


global $wpdb;

// Array of custom post types to delete.
$cptDelete = [];

// Array of plugin tables to delete (table names should include the prefix).
$tablesDelete = [];



// Execute cleanup functions on uninstall.
clearPostTypeData($cptDelete);
deletePluginTables($tablesDelete);
