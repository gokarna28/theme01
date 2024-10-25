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

    // single-page-sidebar
    register_sidebar(
        array(
            'name' => 'Single Page Sidebar',
            'id' => 'sidebar-2',
            'description' => 'This is the sidebar for the single page.',
        )
    );

}

add_action('widgets_init', 'my_custom_sidebars');


// add the background option in the apperence to the admin
add_theme_support('custom-background');