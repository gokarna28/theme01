<?php
/**
 * Theme Functions.
 * 
 * @package theme01
 */

//  enqueue style and scripts 
function theme01_enqueue_scripts()
{
    //register styles
    wp_register_style(
        'style-css',
        get_stylesheet_uri(),
        [],
        filemtime(get_template_directory() . '/style.css'),
        'all'
    );
    wp_register_style(
        'bootstrap-css',
        get_template_directory_uri() . '/assets/src/library/css/bootstrap.min.css',
        [],
        false,
        'all'
    );

    //register scripts
    wp_register_script(
        'main-js',
        get_template_directory_uri() . '/assets/main.js',
        [],
        filemtime(get_template_directory() . '/assets/main.js'),
        true
    );
    wp_register_script(
        'bootstrap-js',
        get_template_directory_uri() . '/assets/src/library/js/bootstrap.min.js',
        ['jquery'],
        false,
        true
    );

    //enqueue style
    wp_enqueue_style('style-css');
    wp_enqueue_style('bootstrap-css');

    //wnqueue scripts
    wp_enqueue_script('main-js');
    wp_enqueue_script('bootstrap-js');
}
add_action('wp_enqueue_scripts', 'theme01_enqueue_scripts');


//register menu 
register_nav_menus(
    array('primary-menu' => 'Header Menu')
);

//add the thumbnails option to the admin
add_theme_support('post-thumbnails');

//add the header image option to admin
add_theme_support('custom-header');


//add the widgit option to admin
function my_custom_sidebars()
{
    // primary-sidebar
    register_sidebar(
        array(
            'name' => 'Primary Sidebar',
            'id' => 'sidebar-1',
            'description' => 'This is sidebar for the all the pages. ',
        )
    );

}

add_action('widgets_init', 'my_custom_sidebars');


// add the background image option in the apperence to the admin
add_theme_support('custom-background');


//add the excerpt option to the admin
add_post_type_support('page', 'excerpt');



// Register the custom post type
function theme01_custom_post_type()
{
    register_post_type(
        'theme01_movies',
        array(
            'labels' => array(
                'name' => __('movies', 'textdomain'),
                'singular_name' => __('movie', 'textdomain'),
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'movie'), // my custom slug
            'supports' => array('title', 'editor', 'thumbnail'),
        )
    );
}
add_action('init', 'theme01_custom_post_type');





// Register the meta box for Popular Checkbox
function theme01_add_genre_custom_field()
{
    ?>
    <div class="custom_taxonomy_image">
        <label for="theme01_taxonomy_image">
            <input type="file" id="theme01_taxonomy_image" name="them01_taxonomy_image" accept="image/png, image/jpeg" />
        </label>
    </div>
    <label for="theme01_popular_genre">
        <input type="checkbox" id="theme01_popular_genre" name="theme01_popular_genre" value="1" />
        Mark as Popular
    </label>

    <?php
}
add_action('Genre_add_form_fields', 'theme01_add_genre_custom_field');


//For the edit screen    
function theme01_edit_genre_custom_field($term)
{
    //Get the current value of the checkbox field
    $popular = get_term_meta($term->term_id, '_theme01_popular_genre', true);

    // $image_id = get_term_meta($term->term_id, '_theme01_taxonomy_image_id', true);
    //var_dump($image_id);

    // $image_url = wp_get_attachment_url($image_id);
    //var_dump($image_url);
    ?>
    <div class="custom_taxonomy_image">
        <label for="theme01_taxonomy_image"> Upload Imgage</label>
        <!-- <input type="file" id="theme01_taxonomy_image" name="theme01_taxonomy_image"  /> -->

        <?php
        // if ($image_url) {
        //     ?>
        <!-- //     <div>
        //         <img src="<?php //echo $image_url; ?>" alt="Genre Image" style="max-width: 150px; height: auto;">
        //     </div> -->
             <?php
        // } else {
        //     echo "";
        // }
        ?>
<input type="file" class="inv_custom_image" name="custom_image_upload" required>
    </div>

    <label for=" theme01_popular_genre">
        <input type="checkbox" id="theme01_popular_genre" name="theme01_popular_genre" value="1" <?php checked($popular, '1'); ?> />
        Mark as Popular
    </label>
    <?php
}
add_action('Genre_edit_form_fields', 'theme01_edit_genre_custom_field');




//save the custom field value for the "Genre" taxonomy
function theme01_save_genre_custom_field($term_id)
{

    if (isset($_POST['theme01_popular_genre'])) {
        update_term_meta($term_id, '_theme01_popular_genre', $_POST['theme01_popular_genre']);
    } else {
        delete_term_meta($term_id, '_theme01_popular_genre');
    }
// Handle the image upload
if (isset($_FILES['custom_image_upload']) && !empty($_FILES['custom_image_upload']['name'])) {
    die('dsfds');
    // Include WordPress file handling functions
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/media.php');
    require_once(ABSPATH . 'wp-admin/includes/image.php');

    // Handle the upload
    $upload_overrides = array('test_form' => false);
    $uploaded_file = wp_handle_upload($_FILES['custom_image_upload'], $upload_overrides);

    if ($uploaded_file && !isset($uploaded_file['error'])) {
        // Get the file type
        $file_type = wp_check_filetype(basename($uploaded_file['file']), null);
        // Prepare the attachment data
        $attachment_data = array(
            'guid'           => $uploaded_file['url'],
            'post_mime_type' => $file_type['type'],
            'post_title'     => sanitize_file_name(basename($uploaded_file['file'])),
            'post_content'   => '',
            'post_status'    => 'inherit'
        );
        // Insert the attachment
        $attachment_id = wp_insert_attachment($attachment_data, $uploaded_file['file']);
        // Save the attachment ID as term meta
        update_term_meta($term_id, '_theme01_taxonomy_image_id', $attachment_id);
    } else {
        // Handle error during upload
        echo "Error uploading image: " . $uploaded_file['error'];
    }
}
    }


add_action('edited_Genre', 'theme01_save_genre_custom_field');
// add_action('created_Genre', 'theme01_save_genre_custom_field');