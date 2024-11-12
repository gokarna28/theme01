<?php
//Template Name:Movies

get_header();// call the header
?>

<div class="movie_card_container">
    <?php
    $args = array(
        'post_type' => 'theme01_movies',
        'posts_per_page' => 10,
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
get_footer(); // call the footer
