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
                'name' => __('Movies', 'textdomain'),
                'singular_name' => __('Movie', 'textdomain'),
                'menu_name' => __('movies', 'text_domain'),
            ),
            'public' => true,
            'has_archive' => true,
            'show_in_admin_bar' => true,
            'menu_position' => 5,
            'show_in_admin' => true,
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
    <tr class="custom_taxonomy_image">
        <td> <label for="theme01_taxonomy_image">
                <input type="file" name="theme01_taxonomy_image" />
            </label></td>
    </tr>

    <div class="form-field">
         <label for="genere_image"><?php _e('Image', 'textdomain'); ?></label>
         <input type="text" name="genere_image" id="genere_image" value="" />
         <button class="upload_image_button button"><?php _e('Upload/Add image', 'textdomain'); ?></button>
         <p class="description"><?php _e('Upload an image for this genere.', 'textdomain'); ?></p>
     </div>

    <label for="theme01_popular_genre">
        <input type="checkbox" id="theme01_popular_genre" name="theme01_popular_genre" value="1" />
        Mark as Popular
    </label>

    <?php
}
add_action('genre_add_form_fields', 'theme01_add_genre_custom_field');


//For the edit screen    
function theme01_edit_genre_custom_field($term)
{
    //Get the current value of the checkbox field
    $popular = get_term_meta($term->term_id, '_theme01_popular_genre', true);

    //get the current image id and url if available
    $image_id = get_term_meta($term->term_id, '_theme01_taxonomy_image_id', true);
    $image_url = wp_get_attachment_url($image_id);
    ?>

    <!-- input field for image upload -->
    <?php
    if ($image_url) {
        // echo $image_url;
        // echo $image_id;
        ?>
        <tr>
            <td><img src="<?php echo $image_url; ?>" alt="Genre Image" style="max-width: 150px; height: auto;"></td>
        </tr>
        <?php
    }
    ?>

    <tr class="form-field">
        <td>
            <lable for="theme01_taxonomy_image">Upload Imgae:</lable>
            <input type="file" name="theme01_taxonomy_image" />
        </td>
    </tr>


    <!-- input field Checkbox -->
    <tr>
        <td> <label for=" theme01_popular_genre">
                <input type="checkbox" id="theme01_popular_genre" name="theme01_popular_genre" value="1" <?php checked($popular, '1'); ?> />
                Mark as Popular
            </label>
        </td>
    </tr>
    <?php
}
add_action('genre_edit_form_fields', 'theme01_edit_genre_custom_field');




// add the enctype to the form dynamically
add_action('admin_footer', function () {
    ?>
    <script type="text/javascript">
        document.addEventListner("DOMContentLoaded", () => {
            document.querySelector('form#edittag').setAttribute('enctype', 'multipart/form-data');

            document.querySelector('form#addtag').setAttribute('enctype', 'multipart/form-data');
        })


    </script>
    <?php
});


//save the custom field value for the "Genre" taxonomy
function theme01_save_genre_custom_field($term_id)
{
    // echo ' enctype="multipart/form-data"';
    //update the checkbox field as popular
    if (isset($_POST['theme01_popular_genre'])) {
        update_term_meta($term_id, '_theme01_popular_genre', $_POST['theme01_popular_genre']);
    } else {
        delete_term_meta($term_id, '_theme01_popular_genre');
    }

    //die("gkdsfjk");
    //update the input field for image

    if (!empty($_FILES['theme01_taxonomy_image']['name'])) {

        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');
        require_once(ABSPATH . 'wp-admin/includes/image.php');

        $attachment_id = media_handle_upload('theme01_taxonomy_image', 0);
        //update the term meta
        update_term_meta($term_id, '_theme01_taxonomy_image_id', $attachment_id);

    }

}
add_action('edited_genre', 'theme01_save_genre_custom_field');
add_action('created_genre', 'theme01_save_genre_custom_field');












