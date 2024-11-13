<?php
//Template Name:Home

get_header();// call header
?>
<main class="home-template-container">
    <div class="category_wrapper">
        <h1>Popular Genre</h1>
        <div class="category-container">
            <?php

            $genres = get_terms([
                'taxonomy' => 'genre',
                'hide_empty' => false,
                'meta_query' => array(
                    array(
                        'key' => '_theme01_popular_genre',
                        'value' => 1,
                        'compare' => '=',
                    )
                ),
                'number' => 3,
            ]);

            // echo "<pre>";
            // print_r($genres);
            // echo "<pre>";
            
            if (!empty($genres) && !is_wp_error($genres)) {
                foreach ($genres as $genre) {

                    $genre_movies_link = get_term_link($genre);
                    //  echo $genre_movies_link;
            
                    // Retrieve the image ID and URL for the genre
                    $image_id = get_term_meta($genre->term_id, '_theme01_taxonomy_image_id', true);
                    //echo $image_id;
                    $image_url = wp_get_attachment_url($image_id);

                    if (!empty($image_url)) {
                        ?>
                        <a href="<?php echo $genre_movies_link; ?>" class="genre_card">
                            <div class="taxonomy_image_container">
                                <img src="<?php echo $image_url; ?>" alt="taxonomy_image" />
                            </div>
                            <p><?php echo esc_html($genre->name); ?></p>
                        </a>
                        <?php
                    } else {
                        ?>
                        <a href="<?php echo $genre_movies_link; ?>" class="genre_card">
                            <p><?php echo esc_html($genre->name); ?></p>
                        </a>
                        <?php
                    }
                }
            } else {
                echo "";
            }

            ?>
        </div>
    </div>
</main>
<?php
get_footer(); // call footer
