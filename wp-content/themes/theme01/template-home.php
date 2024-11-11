<?php
//Template Name:Home

get_header();// call header
?>

<!-- movie card container  -->
<div class="movie_wrapper">
    <h2>Popular Movies</h2>
    <?php //get_template_part('template-parts/movies/latest_movies') ?>
    <div>


        <div class="movie_card_container">
            <?php
            $args = array(
                'post_type' => 'theme01_movies',
                'posts_per_page' => 5,
                'meta_key' => '_theme01_popular_movie',
                'meta_value' => '1',
            );
            $loop = new WP_Query($args);
            while ($loop->have_posts()) {
                $loop->the_post();
                ?>
                <a href="<?php the_permalink(); ?>" class="movie_card">
                    <div class="movie_image">
                        <?php
                        $image_path = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
                        ?>
                        <img src="<?php echo $image_path[0]; ?>" alt="movie image">
                    </div>
                    <div class="movie_details">
                        <p class="movie_title"><?php the_title(); ?></p>
                        <p class="movie_date"><?php echo get_the_date(); ?></p>
                    </div>
                </a>
                <?php
            }
            ?>

        </div>

        <?php
        //}
        
        ?>

    </div>
</div>



<?php
get_footer(); // call footer
