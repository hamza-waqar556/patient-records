<?php

namespace Inc\Api;

class CptQueryHandler
{
    private $post_type;
    private $meta_filters = [];
    private $query_args = [];

    public function setPostType(string $post_type): self
    {
        $this->post_type = $post_type;
        return $this;
    }

    public function whereMeta(string $key, $value, string $compare = '='): self
    {
        $this->meta_filters[] = [
            'key'     => $key,
            'value'   => $value,
            'compare' => $compare,
        ];
        return $this;
    }

    public function getResults(): array
    {
        if (!$this->post_type)
        {
            return [];
        }

        $this->query_args = [
            'post_type'      => $this->post_type,
            'posts_per_page' => -1,
            'post_status'    => 'publish',
        ];

        // Only include meta_query if at least one meta filter exists
        if (!empty($this->meta_filters))
        {
            $this->query_args['meta_query'] = $this->meta_filters;
        }

        $query = new \WP_Query($this->query_args);
        return $this->formatResults($query->posts);
    }


    private function formatResults(array $posts): array
    {
        $formatted_posts = [];

        foreach ($posts as $post)
        {
            $post_data = [
                'ID'          => $post->ID,
                'title'       => $post->post_title,
                'thumbnail'   => $this->getFeaturedImage($post->ID),
                'meta'        => $this->getPostMeta($post->ID),
            ];
            $formatted_posts[] = $post_data;
        }

        return $formatted_posts;
    }

    private function getPostMeta(int $post_id): array
    {
        $meta_data = [];
        $all_meta = get_post_meta($post_id);

        foreach ($all_meta as $key => $values)
        {
            $meta_data[$key] = count($values) === 1 ? maybe_unserialize($values[0]) : array_map('maybe_unserialize', $values);
        }

        return $meta_data;
    }

    private function getFeaturedImage(int $post_id)
    {
        if (!has_post_thumbnail($post_id))
        {
            return null;
        }
        return wp_get_attachment_url(get_post_thumbnail_id($post_id));
    }
}

// Example Usage:
// $results = (new CptQueryHandler())
//     ->setPostType('flight')
//     ->whereMeta('_from_airport', 'JFK')
//     ->whereMeta('_to_airport', 'LAX')
//     ->whereMeta('_duration', 40)
//     ->getResults();

// Example Usage:
$results = (new CptQueryHandler())
    ->setPostType('hotel')
    ->whereMeta('_from_airport', 'JFK')
    ->whereMeta('_to_airport', 'LAX')
    ->whereMeta('_duration', 15)
    ->getResults();
