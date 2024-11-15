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



// Register the custom post type movies
function theme01_custom_post_type()
{
    register_post_type(
        'theme01_movies',
        array(
            'labels' => array(
                'name' => __('Movies', 'textdomain'),
                'singular_name' => __('Movie', 'textdomain'),
                'menu_name' => __('Movies', 'text_domain'),

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



//Registr the custom post type products
function theme01_custom_post_type_products()
{
    register_post_type(
        'products',
        array(
            'labels' => array(
                'name' => _x('Products', 'products', 'text_domain'),
                'singular_name' => _x('Product', 'product', 'text_domain'),
                'menu_name' => __('Products', 'text_domain'),
                'name_admin_bar' => __('Post Type', 'text_domain'),
                'archives' => __('Product Archives', 'text_domain'),
                'attributes' => __('Product Attributes', 'text_domain'),
                'parent_item_colon' => __('Parent Product:', 'text_domain'),
                'all_items' => __('All Products', 'text_domain'),
                'add_new_item' => __('Add New Products', 'text_domain'),
                'add_new' => __('Add New', 'text_domain'),
                'new_item' => __('New Product', 'text_domain'),
                'edit_item' => __('Edit Product', 'text_domain'),
                'update_item' => __('Update Product', 'text_domain'),
                'view_item' => __('View Product', 'text_domain'),
                'view_items' => __('View Product', 'text_domain'),
                'search_items' => __('Search Product', 'text_domain'),
                'not_found' => __('Not found', 'text_domain'),
                'not_found_in_trash' => __('Not found in Trash', 'text_domain'),
                'featured_image' => __('Featured Image', 'text_domain'),
                'set_featured_image' => __('Set featured image', 'text_domain'),
                'remove_featured_image' => __('Remove featured image', 'text_domain'),
                'use_featured_image' => __('Use as featured image', 'text_domain'),
                'insert_into_item' => __('Insert into Product', 'text_domain'),
                'uploaded_to_this_item' => __('Uploaded to this Product', 'text_domain'),
                'items_list' => __('Products list', 'text_domain'),
                'items_list_navigation' => __('Products list navigation', 'text_domain'),
                'filter_items_list' => __('Filter Products list', 'text_domain'),
            ),
            'hierarchical' => true,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'capability_type' => 'page',
            'show_in_admin' => true,
            'rewrite' => array('slug' => 'products'), // my custom slug
            'supports' => array('title', 'editor', 'thumbnail'),

        )
    );
}
add_action('init', 'theme01_custom_post_type_products');



//add the cusotm field to products 
function themne01_products_custom_field_price()
{
    add_meta_box(
        'product_details',
        'Product Detauls',
        'themne01_products_custom_fields_callback',
        'products',
        'normal',
        'high',
        null,
    );
}
add_action('add_meta_boxes', 'themne01_products_custom_field_price');


//add custom  field to products callback
function themne01_products_custom_fields_callback($post)
{
    //Retrive existing values form the database, if available
    $product_price = get_post_meta($post->ID, '_theme01_product_price', true);
    $product_discount_price = get_post_meta($post->ID, '_theme01_product_discount_price', true);
    $product_discreption = get_post_meta($post->ID, '_theme01_product_discreption', true);

    ?>
    <div style="display:flex; gap:10px; margin-bottom:10px">
        <div style="width:100%">
            <lable for="product price">Product Price</lable>
            <input type="number" name="theme01_product_price" placeholder="Enter the product price"
                value="<?php echo $product_price ?>" style="width:100%;" />
        </div>
        <div style="width:100%">
            <lable for="allowed discount">Allowed Discount</lable>
            <input type="number" name="theme01_product_discount_price" placeholder="Enter the discount price allowed"
                value="<?php echo $product_discount_price ?>" style="width:100%;" />
        </div>
    </div>
    <div style="width:100%">
        <label for="product discreption">Product discreption</label>
        <textarea style="width:100%; height:100px;" name="theme01_product_discription"
            placeholder="Enter the product discreption..">
                        <?php echo trim($product_discreption); ?>
                    </textarea>
    </div>
    <?php
}

//save the custom fields 
function theme01_products_custom_fields_save($product_id)
{
    // Update the fields price  
    if (isset($_POST['theme01_product_price'])) {
        // Save the movie review
        update_post_meta($product_id, '_theme01_product_price', sanitize_textarea_field($_POST['theme01_product_price']));
    }

    //update the fields discount price
    if (isset($_POST['theme01_product_discount_price'])) {
        // Save the movie review
        update_post_meta($product_id, '_theme01_product_discount_price', sanitize_textarea_field($_POST['theme01_product_discount_price']));
    }

    //update the fields product discription
    if (isset($_POST['theme01_product_discription'])) {
        // Save the movie review
        update_post_meta($product_id, '_theme01_product_discreption', sanitize_textarea_field($_POST['theme01_product_discription']));
    }
}
add_action('save_post', 'theme01_products_custom_fields_save');



// Add the gallery meta box
function theme01_add_gallery_meta_box()
{
    add_meta_box(
        'product_gallery',
        'Product Gallery',
        'theme01_gallery_meta_box_callback',
        'products',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'theme01_add_gallery_meta_box');


// Callback function for the gallery meta box
function theme01_gallery_meta_box_callback($post)
{
    // Retrieve saved gallery images if any
    $gallery = get_post_meta($post->ID, '_product_gallery', true);

    // print_r($gallery);

    ?>
    <div>
        <button type="button" class="button" id="upload_gallery_button">Add Gallery Images</button>
        <ul id="gallery_preview" style="margin-top: 10px;">
            <?php
            if ($gallery) {
                foreach ($gallery as $image_id) {
                    // print_r($image_id);
                    $img_url = wp_get_attachment_image_url($image_id, 'thumbnail');
                    echo '<li style="display: inline-block; margin-right: 10px;">';
                    echo '<img src="' . esc_url($img_url) . '" style="max-width: 100px;" />';
                    echo '<input type="hidden" name="product_gallery[]" value="' . esc_attr($image_id) . '" />';
                    echo '<button type="button" class="remove-image button">Remove</button>';
                    echo '</li>';
                }
            }
            ?>
        </ul>
    </div>
    <script>
        jQuery(document).ready(function ($) {
            let frame;
            $('#upload_gallery_button').on('click', function (e) {
                e.preventDefault();

                if (frame) {
                    frame.open();
                    return;
                }

                frame = wp.media({
                    title: 'Select or Upload Gallery Images',
                    button: {
                        text: 'Add to Gallery'
                    },
                    multiple: true
                });

                frame.on('select', function () {
                    const attachments = frame.state().get('selection').toJSON();
                    attachments.forEach(function (attachment) {
                        $('#gallery_preview').append(`
                                                                <li style="display: inline-block; margin-right: 10px;">
                                                                    <img src="${attachment.sizes.thumbnail.url}" style="max-width: 100px;" />
                                                                    <input type="hidden" name="product_gallery[]" value="${attachment.id}" />
                                                                    <button type="button" class="remove-image button">Remove</button>
                                                                </li>
                                                            `);
                    });
                });

                frame.open();
            });

            // Remove images from gallery preview
            $('#gallery_preview').on('click', '.remove-image', function (e) {
                e.preventDefault();
                $(this).parent().remove();
            });
        });
    </script>


    <?php
}



add_action('save_post', 'set_post_default_category', 10, 3);

function set_post_default_category($post_id, $post, $update)
{
    var_dump($post);
    // Only want to set if this is a new post!
    if (empty($_POST['product_gallery'])) {
        // die('sdflsdhf');

        $gallery_ids = array_map('intval', $_POST['product_gallery']);
        update_post_meta($post_id, '_product_gallery', $gallery_ids);
    } else {
        delete_post_meta($post_id, '_product_gallery');
    }

}




// Register the meta box for Popular Checkbox and Image Upload
function theme01_add_genre_custom_field()
{
    ?>
    <div class="form-field">
        <label for="theme01_taxonomy_image">Genre Image</label>
        <input type="file" name="theme01_taxonomy_image" id="theme01_taxonomy_image" />
    </div>

    <div class="form-field">
        <label for="theme01_popular_genre">
            <input type="checkbox" id="theme01_popular_genre" name="theme01_popular_genre" value="1" />
            Mark as Popular
        </label>
    </div>
    <?php
}
add_action('genre_add_form_fields', 'theme01_add_genre_custom_field');


// add the enctype to the form dynamically
add_action('admin_footer', function () {
    ?>
    <script type="text/javascript">
        window.addEventListener('load', function () {
            const editTagForm = document.querySelector('form#edittag');
            const addTagForm = document.querySelector('form#addtag');
            const postForm = document.querySelector('form#post');

            if (editTagForm) {
                editTagForm.setAttribute('enctype', 'multipart/form-data');
            }

            if (addTagForm) {
                addTagForm.setAttribute('enctype', 'multipart/form-data');
            }

            if (postForm) {
                postForm.setAttribute('enctype', 'multipart/form-data');
            }
        });
    </script>
    <?php
});


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


// Save the custom field value for the "Genre" taxonomy
function theme01_save_genre_custom_field($term_id)
{
    // Update the checkbox field as popular
    if (isset($_POST['theme01_popular_genre'])) {
        update_term_meta($term_id, '_theme01_popular_genre', 1);
    } else {
        delete_term_meta($term_id, '_theme01_popular_genre');
    }


    // Update the input field for image
    if (!empty($_FILES['theme01_taxonomy_image']['name'])) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');
        require_once(ABSPATH . 'wp-admin/includes/image.php');

        // Check for any upload errors
        $attachment_id = media_handle_upload('theme01_taxonomy_image', 0);
        if (is_wp_error($attachment_id)) {
            // Display error message in admin if needed
            wp_die('Error uploading image: ' . $attachment_id->get_error_message());
        } else {
            // Update the term meta with the image ID
            update_term_meta($term_id, '_theme01_taxonomy_image_id', $attachment_id);
        }
    }
}
add_action('edited_genre', 'theme01_save_genre_custom_field');
add_action('created_genre', 'theme01_save_genre_custom_field');


