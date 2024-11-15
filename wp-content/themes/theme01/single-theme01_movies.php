<?php
get_header(); // call the header
?>
<div class="movie-content-container">
    <div class="movie-left">
        <h2><?php the_title(); ?></h2>
        <p><?php the_content(); ?></p>
        <div>
            <?php if (has_post_thumbnail()): ?>
                <div class="movie-thumbnail">
                    <?php
                    $featured_image = get_the_post_thumbnail_url();
                    //echo $featured_image;
                    ?>
                    <img src="<?php echo $featured_image; ?>" />
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="movie-right">
        right
    </div>
</div>

<?php
get_footer(); // call the footer
?>