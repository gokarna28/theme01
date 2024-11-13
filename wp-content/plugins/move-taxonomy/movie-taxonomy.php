<?php
/*
 * Plugin Name: Movie Taxonomy
 * Description: a custom movie taxonomy named Genre.
 * Version: 1.0
 * Author: Gokarna Chaudhary
 * Author URI: gokarnachaudhary.kesug.com
 */


//create a cuystom taxonomy genre to theme01_movies
function theme01_register_taxonomy_genre()
{
    $labels = array(
        'name' => _x('genre', 'taxonomy general name'),
        'singular_name' => _x('genre', 'taxonomy singular name'),
        'search_items' => __('Search Genre'),
        'all_items' => __('All Genre'),
        'parent_item' => __('Parent Genre'),
        'parent_item_colon' => __('Parent Genre:'),
        'edit_item' => __('Edit Genre'),
        'update_item' => __('Update Genre'),
        'add_new_item' => __('Add New Genre'),
        'new_item_name' => __('New Genre Name'),
        'menu_name' => __('genre'),
    );
    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => ['slug' => 'genre'],
    );
    register_taxonomy('genre', ['theme01_movies'], $args);
}
add_action('init', 'theme01_register_taxonomy_genre');




// Add Custom Meta Box for Review
function theme01_add_movie_review_meta_box()
{
    add_meta_box(
        'movie_review',
        'Movie Review',
        'theme01_movie_review_meta_box_callback',
        'theme01_movies',
        'normal',
        'default'

    );
}
add_action('add_meta_boxes', 'theme01_add_movie_review_meta_box');


// Callback function for the Movie Review meta box
function theme01_movie_review_meta_box_callback($post)
{
    // Retrieve existing review value from the database
    $review = get_post_meta($post->ID, '_movie_review', true);

    // Display the textarea field for the review
    echo '<label for="movie_review">Enter Review:</label>';
    echo '<textarea id="movie_review" name="movie_review" rows="4" style="width:100%;">' . esc_textarea($review) . '</textarea>';
}

// Save the custom field data
function theme01_save_movie_review_meta($post_id)
{
    if (isset($_POST['movie_review'])) {
        // Save the movie review
        update_post_meta($post_id, '_movie_review', sanitize_textarea_field($_POST['movie_review']));
    }
}
add_action('save_post', 'theme01_save_movie_review_meta');




