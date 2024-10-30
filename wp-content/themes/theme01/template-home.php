<?php
//Template Name:Home

get_header();// call header
?>

<?php
//returns the category 
$category = get_categories(array('taxonomy' => 'category'));
// echo "<pre>";
// print_r($category);
// echo "</pre>";
?>
<div class="category-container">
    <?php
    foreach ($category as $categoryValue) {
        ?>
        <a class="category-card" href="<?php echo get_category_link($categoryValue->term_id); ?>">
            <div>
                <p><?php echo $categoryValue->name ?><span>(<?php echo $categoryValue->count ?>)</span></p>
            </div>
        </a>

        <?php
    }
    ?>
</div>
<?php
get_footer(); // call footer
