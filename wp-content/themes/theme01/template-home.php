<?php
//Template Name:Home

get_header();// call header
?>

<?php
//returns the category 
//$category = get_categories(array('taxonomy' => 'category'));
// echo "<pre>";
// print_r($category);
// echo "</pre>";
?>
<!-- <div class="category-container">
    <?php
    // foreach ($category as $categoryValue) {
    ?>
        <a class="category-card" href="<? php// echo get_category_link($categoryValue->term_id); ?>">
            <div>
                <p><?php //echo $categoryValue->name ?><span>(<?php //echo $categoryValue->count ?>)</span></p>
            </div>
        </a>

        <?php
        // }
        ?>
</div> -->

<!-- custom taxonomy -->
 <div class="category_wrapper">
<?php
$movieCate = get_terms(['taxonomy' => 'movies_category', 
'hide_empty' => false,
'orderby'=>'name',
'order'=>'DESC',
'number'=>4,
]);
// echo "<pre>";
// print_r($movieCate);
// echo "<pre>";
?>
<div class="category-container">
    <?php
    foreach ($movieCate as $movie_cate) {
        ?>
        <a class="category-card" href="<?php echo get_category_link($movie_cate->term_id); ?>">
            <div>
                <p><?php echo $movie_cate->name ?></p>
            </div>
        </a>

        <?php
    }
    ?>
</div>
</div>

<!-- latest movies section  -->
<div class="movie_wrapper">
    <h2>Latest Movies</h2>
    <?php get_template_part('template-parts/movies/latest_movies') ?>
</div>
<?php
get_footer(); // call footer
