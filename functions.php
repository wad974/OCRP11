<?php

/** REGISTER THEME SUPPORT */
add_action('after_setup_theme', 'mon_theme_support');
function mon_theme_support()
{

    /*on active title tag*/
    add_theme_support('title_tag');

    /*LOGO DU SITE*/
    add_theme_support('custom-logo');

    /*on active l'ajoute des images dans articles*/
    add_theme_support('post-thumbnails');

    /*GESTION DES MENU*/
    add_theme_support('menus');
    register_nav_menu('header', 'header-menu');
    register_nav_menu('footer', 'footer-menu');
}

/*STYLE CSS*/

add_action('wp_enqueue_scripts', 'mon_style_support');
function mon_style_support()
{
    /*conditions version si dev ou prod*/
    $theme   = wp_get_theme('nathaliamota');
    $version = (defined('WP_DEBUG') && WP_DEBUG)
        ?  filemtime(get_stylesheet_directory() . '/style.css')
        :  $theme->get('Version');

    /*STYLE CSS*/
    wp_deregister_style('parent_style');
    wp_register_style(
        'parent_style',
        get_stylesheet_directory_uri() . '/style.css',
        array(),
        filemtime(get_stylesheet_directory() . '/style.css')
    );
    wp_enqueue_style('parent_style');
    /*ANIMATION CSS*/
    wp_enqueue_style(
        'animation_style',
        get_stylesheet_directory_uri() . '/assets/css/animation.css',
        array(),
        filemtime(get_stylesheet_directory() . '/assets/css/animation.css')
    );
    /*MEDIA CSS*/
    wp_enqueue_style(
        'media_style',
        get_stylesheet_directory_uri() . '/assets/css/media.css',
        array(),
        filemtime(get_stylesheet_directory() . '/assets/css/media.css')
    );

    /*JAVASCRIPT*/
    /*INDEX.JS*/
    wp_enqueue_script(
        'index_script',
        get_stylesheet_directory_uri() . '/assets/js/index.js',
        array(),
        filemtime(get_stylesheet_directory() . '/assets/js/index.js'),
        true
    );
}


/**
 * FILTRE MENU ITEMPS
 */
add_filter('nav_menu_css_class', 'mon_theme_menu_css');
function mon_theme_menu_css(array $classes)
{
    //funciton pour voir se qu'il y a dans add filter nav_menu_css_class 
    /*echo '<pre>';
    print_r(func_get_args());
    echo '</pre>';
    //var_dump(func_get_args());*/

    $classes[] = 'sous-menu';
    return $classes;
}

add_filter('nav_menu_link_attributes', 'mon_theme_menu_link');
function mon_theme_menu_link($attrs)
{

    $attrs['class'] = 'sous-menu-link';
    return $attrs;
}
