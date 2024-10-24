<?php
/**
 * Main template file.
 */
?>

<?php
// header 
get_header();

if (have_posts()) {
    while (have_posts()) {
        the_post(); // we can use, get_post(); 
    }
}
?>

<!-- //blog posts it should be in loop and dynamic -->
<div class="blog-post-wrapper">
    <div class="blog-post-container">
        <?php
        while (have_posts()) {
            the_post(); //this function help to determine the loop to the number of posts
            ?>
            <a class="card-wrapper" href="<?php the_permalink(); //automaticly call the single page ?>">
                <div class="card">
                    <?php the_post_thumbnail('medium'); //returns the featured image of size medium?>
                    <div class="container">
                        <h4><b><?php the_title(); ?></b></h4>
                        <!-- <p> the_excerpt(); // return the short disc?></p> -->
                        <p class="blog-post-date"><?php the_date(); ?></p>
                    </div>
                </div>
            </a>
        <?php } ?>

    </div>
    <div class="blog-post-pagination">
        <?php echo wp_pagenavi(); ?>
    </div>
</div>


<?php
//footer
get_footer();