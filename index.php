<?php
/**
 * Main template file.
 */
?>

<?php 
// header 
get_header();

if(have_posts()){
    while(have_posts()){
        the_post(); // we can use, get_post(); 
    }
}
//footer
get_footer();