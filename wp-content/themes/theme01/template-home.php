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
        <div class="category-card">
            <a href="<?php echo get_category_link($categoryValue->term_id);?>">
                <p><?php echo $categoryValue->name ?></p>
            </a>
        </div>
        <?php
    }
    ?>
</div>

<?php

get_footer(); // call footer
