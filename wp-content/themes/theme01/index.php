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
<div class="card">
    <img src="img_avatar.png" alt="Avatar" style="width:100%">
    <div class="container">
        <h4><b>John Doe</b></h4>
        <p>Architect & Engineer</p>
    </div>
</div>
<?php
//footer
get_footer();