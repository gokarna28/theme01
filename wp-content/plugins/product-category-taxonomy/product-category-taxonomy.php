<?php
/*
 * Plugin Name: Product Category Taxonomy
 * Description: a custom product category taxonomy.
 * Version: 1.0
 * Author: Gokarna Chaudhary
 * Author URI: gokarnachaudhary.kesug.com
 */


//create a cuystom taxonomy genre to prodicts
function theme01_register_product_taxonomy_categories()
{
    $labels = array(
        'name' => _x('categories', 'taxonomy general name'),
        'singular_name' => _x('category', 'taxonomy singular name'),
        'search_items' => __('Search Category'),
        'all_items' => __('All Category'),
        'parent_item' => __('Parent Category'),
        'parent_item_colon' => __('Parent Category:'),
        'edit_item' => __('Edit Categoy'),
        'update_item' => __('Update Category'),
        'add_new_item' => __('Add New Category'),
        'new_item_name' => __('New Category'),
        'menu_name' => __('Categories'),
    );
    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => ['slug' => 'categories'],
    );
    register_taxonomy('categories', ['products'], $args);
}
add_action('init', 'theme01_register_product_taxonomy_categories');





