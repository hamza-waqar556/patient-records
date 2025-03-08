<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Progress Note</title>
    <style>
        /* Your styles – you can include the 1000-line template content here */
        body {
            color: black;
        }
    </style>
</head>

<body>
    <div class="pdf-main-container">

        <!-- Insert additional dynamic content as needed -->
    </div>

    <h1>PDF</h1>

    <p>
        <?php
        echo "<pre>";
        print_r(json_decode($data['post_data']));
        echo "</pre>";
        ?>
    </p>
</body>

</html>