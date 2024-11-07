<div class="movie_card_container">

    <?php
    $wpmovie = array(
        'post_type' => 'movies',
        'post_status' => 'publish',
        'orderby' => 'name',
        'order' => 'DESC',
    );

    $moviesQuery = new Wp_Query($wpmovie);

    while ($moviesQuery->have_posts()) {
        $moviesQuery->the_post();

        ?>
        <a href="" class="movie_card">
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