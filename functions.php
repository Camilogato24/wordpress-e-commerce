<?php
// This function enqueues the Normalize.css for use. The first parameter is a name for the stylesheet, the second is the URL. Here we
// use an online version of the css file.
function add_CSS() {
    wp_enqueue_style('normalize', get_template_directory_uri() . '/assets/css/normalize.css', array(), '7.0.0');
    wp_enqueue_style('all', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0.0');
}
add_action('wp_enqueue_scripts', 'add_CSS');

// Register a new sidebar simply named 'sidebar'
function add_widget_support() {
    register_sidebar( array(
                    'name'          => 'Sidebar',
                    'id'            => 'sidebar',
                    'before_widget' => '<div>',
                    'after_widget'  => '</div>',
                    'before_title'  => '<h2>',
                    'after_title'   => '</h2>',
    ) );
}
// Hook the widget initiation and run our function
add_action( 'widgets_init', 'add_widget_support' );

// Register a new navigation menu
function register_my_menus() {
    register_nav_menus(
        array(
            'primary' => __('Primary Menu', 'theme-slug'),
        )
    );
}
// Hook to the init action hook, run our navigation menu function
add_action('init', 'register_my_menus');

// En functions.php o tu archivo del tema
function agregar_menu_personalizado($items, $args) {
    if ($args->theme_location == 'primary') {
        // Agrega el enlace de cambio de tema
        $theme_switcher = '<li class="menu-item menu-item-theme-switcher">';
        $theme_switcher .= '<a href="#" id="theme-switcher">Cambiar Tema</a>';
        $theme_switcher .= '</li>';

        // Agrega el enlace al final de los elementos del menú
        $items .= $theme_switcher;
    }
    return $items;
}

add_filter('wp_nav_menu_items', 'agregar_menu_personalizado', 10, 2);

add_filter('show_admin_bar', '__return_false');

function agregar_mi_script() {
    // Registra el script
    wp_register_script('mi-script', get_template_directory_uri() . '/assets/js/header-sticky.js', array(), '1.0', true);

    // Enqueue el script
    wp_enqueue_script('mi-script');
}
add_action('wp_enqueue_scripts', 'agregar_mi_script');



// Incluir archivo de tipos de publicación personalizados
require_once get_template_directory() . '/helpers/custom-post-types.php';
require_once get_template_directory() . '/helpers/add-script-ajax.php';
require_once get_template_directory() . '/helpers/add-anuncio.php';
require_once get_template_directory() . '/helpers/anuncios-page.php';

add_theme_support('post-thumbnails');
