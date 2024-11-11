<?php
/*
 * Plugin Name: Movie Taxonomy
 * Description: a custom movie taxonomy named Genre.
 * Version: 1.0
 * Author: Gokarna Chaudhary
 * Author URI: gokarnachaudhary.kesug.com
 */

function theme01_register_taxonomy_genre()
{
    $labels = array(
        'name' => _x('Genre', 'taxonomy general name'),
        'singular_name' => _x('Genre', 'taxonomy singular name'),
        'search_items' => __('Search Genre'),
        'all_items' => __('All Genre'),
        'parent_item' => __('Parent Genre'),
        'parent_item_colon' => __('Parent Genre:'),
        'edit_item' => __('Edit Genre'),
        'update_item' => __('Update Genre'),
        'add_new_item' => __('Add New Genre'),
        'new_item_name' => __('New Genre Name'),
        'menu_name' => __('Genre'),
    );
    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => ['slug' => 'course'],
    );
    register_taxonomy('Genre', ['theme01_movies'], $args);
}
add_action('init', 'theme01_register_taxonomy_genre');



// Add Custom Meta Box for Review
function theme01_add_movie_review_meta_box()
{
    add_meta_box(
        'movie_review',
        'Movie Review',
        'wporg_movie_review_meta_box_callback',
        'theme01_movies',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'theme01_add_movie_review_meta_box');


// Callback function for the Movie Review meta box
function wporg_movie_review_meta_box_callback($post)
{
    // Retrieve existing review value from the database
    $review = get_post_meta($post->ID, '_movie_review', true);

    // Add a nonce field for security
    //wp_nonce_field('save_movie_review', 'movie_review_nonce');

    // Display the textarea field for the review
    echo '<label for="movie_review">Enter Review:</label>';
    echo '<textarea id="movie_review" name="movie_review" rows="4" style="width:100%;">' . esc_textarea($review) . '</textarea>';
}


// Save the custom field data
function wporg_save_movie_review_meta($post_id)
{
    // Check if nonce is valid
    if (!isset($_POST['movie_review_nonce']) || !wp_verify_nonce($_POST['movie_review_nonce'], 'save_movie_review')) {
        return;
    }

    // Check if it's an autosave or if the user has permission
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (isset($_POST['movie_review'])) {
        // Save the movie review
        update_post_meta($post_id, '_movie_review', sanitize_textarea_field($_POST['movie_review']));
    }
}
add_action('save_post', 'wporg_save_movie_review_meta');





// Register the meta box for Popular Checkbox
function theme01_add_popular_meta_box()
{
    add_meta_box(
        'theme01_popular_movie',
        'Popular Movie',
        'theme01_popular_meta_box_html',
        'theme01_movies',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'theme01_add_popular_meta_box');



// Display the checkbox field
function theme01_popular_meta_box_html($post)
{
    // Get the current value of the checkbox field
    $popular = get_post_meta($post->ID, '_theme01_popular_movie', true);

    // Add nonce for security
    //wp_nonce_field('theme01_popular_nonce_action', 'theme01_popular_nonce_name');
    ?>
    <label for="theme01_popular_movie">
        <input type="checkbox" id="theme01_popular_movie" name="theme01_popular_movie" value="1" <?php checked($popular, '1'); ?> />
        Mark as Popular
    </label>
    <?php
}

// Save the value of the checkbox
function theme01_save_popular_meta_box($post_id)
{
    // Check if our nonce is set.
    if (!isset($_POST['theme01_popular_nonce_name'])) {
        return $post_id;
    }

    $nonce = $_POST['theme01_popular_nonce_name'];

    // Verify that the nonce is valid.
    if (!wp_verify_nonce($nonce, 'theme01_popular_nonce_action')) {
        return $post_id;
    }

    // Check if the user has permission to save data
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    if ('theme01_movies' != $_POST['post_type']) {
        return $post_id;
    }

    // If the checkbox is checked, save the value as '1', otherwise save it as '0'
    $popular = isset($_POST['theme01_popular_movie']) ? '1' : '0';

    // Save the value
    update_post_meta($post_id, '_theme01_popular_movie', $popular);
}
add_action('save_post', 'theme01_save_popular_meta_box');
