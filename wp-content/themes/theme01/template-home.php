<?php
//Template Name:Home

get_header();// call header
?>

<div class="category_wrapper">
    <h1>Popular Genre</h1>
    <div class="category-container">
        <?php

        $genres = get_terms([
            'taxonomy' => 'Genre',
            'hide_empty' => false,
            'meta_query' => array(
                array(
                    'key' => '_theme01_popular_genre',
                    'value' => 1,
                    'compare' => '=',
                )
                ),
                'number'=> 4,
        ]);

        // echo "<pre>";
        // print_r($genres);
        // echo "<pre>";

        if (!empty($genres) && !is_wp_error($genres)) {
            foreach ($genres as $genre) {

                $genre_movies_link= get_term_link($genre);
              //  echo $genre_movies_link;
                ?>
                <a href="<?php echo  $genre_movies_link ;?>" class="genre_card">
                    <p><?php echo esc_html($genre->name); ?></p>
                </a>
                <?php
            }
        } else {
            echo "";
        }

        ?>
    </div>
</div>

<?php
get_footer(); // call footer
