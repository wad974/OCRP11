<?php

/**STYLE CSS**/
add_action('wp_enqueue_scripts', 'theme_styles');
function theme_styles()
{
    //CSS
    //wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

    wp_enqueue_style(
        'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array(),
        filemtime(get_stylesheet_directory() . '/style.css')
    );

    /**FONTS CSS */
    wp_enqueue_style(
        'Fonts-style',
        get_stylesheet_directory_uri() . '/assets/css/fonts.css',
        array(),
        filemtime(get_stylesheet_directory() . '/assets/css/fonts.css')
    );

    /**LIGHTBOX */
    wp_enqueue_style(
        'lightbox-style',
        get_stylesheet_directory_uri() . '/assets/css/lightbox.css',
        array(),
        filemtime(get_stylesheet_directory() . '/assets/css/lightbox.css')
    );
    wp_enqueue_script(
        'lightbox-script',
        get_stylesheet_directory_uri() . '/assets/js/lightbox.js',
        array(),
        filemtime(get_stylesheet_directory() . '/assets/js/lightbox.js'),
        true
    );

    /**MEDIA QUERIE CSS */
    wp_enqueue_style(
        'media-style',
        get_stylesheet_directory_uri() . '/assets/css/media.css',
        array(),
        filemtime(get_stylesheet_directory() . '/assets/css/media.css')
    );

    //SCRIPT FUNCTION
    wp_enqueue_script(
        'function-script',
        get_stylesheet_directory_uri() . '/assets/js/function.js',
        array(),
        filemtime(get_stylesheet_directory() . '/assets/js/function.js'),
        true
    );
    wp_enqueue_script(
        'index-script',
        get_stylesheet_directory_uri() . '/assets/js/index.js',
        array(),
        filemtime(get_stylesheet_directory() . '/assets/js/index.js'),
        true
    );

    /*BURGER UNIQUEMENT*/
    wp_enqueue_script(
        'burger-script',
        get_stylesheet_directory_uri() . '/assets/js/burger.js',
        array(),
        filemtime(get_stylesheet_directory() . '/assets/js/burger.js'),
        true
    );
}

function capitaine_assets()
{

    // …

    // Charger notre script
    wp_enqueue_script(
        'capitaine',
        get_stylesheet_directory_uri() . '/assets/js/script.js',
        ['jquery'],
        filemtime(get_stylesheet_directory() . '/assets/js/script.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'capitaine_assets');

/** REGISTER THEME SUPPORT */
add_action('after_setup_theme', 'mon_theme_support');
function mon_theme_support()
{
    /*GESTION DES MENU*/
    add_theme_support('menus');
    register_nav_menu('header', 'header-menu');
    register_nav_menu('footer', 'footer-menu');
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


add_action('wp_ajax_capitaine_load_comments', 'capitaine_load_comments');
add_action('wp_ajax_nopriv_capitaine_load_comments', 'capitaine_load_comments');

function capitaine_load_comments()
{

    // Vérification de sécurité
    if (
        ! isset($_REQUEST['nonce']) or
        ! wp_verify_nonce($_REQUEST['nonce'], 'capitaine_load_comments')
    ) {
        wp_send_json_error("Vous n’avez pas l’autorisation d’effectuer cette action.", 403);
    }

    // On vérifie que l'identifiant a bien été envoyé
    if (! isset($_POST['postid'])) {
        wp_send_json_error("L'identifiant de l'article est manquant.", 400);
    }

    // Récupération des données du formulaire
    $post_id = intval($_POST['postid']);

    // Répondre avec l'URL de la page d'archive
    wp_send_json_success(array(
        'archiveUrl' => get_post_type_archive_link('photo'), // Remplacez 'post' par votre type de post si nécessaire
    ));
}

add_action('wp_ajax_lightbox', 'lightbox');
add_action('wp_ajax_nopriv_lightbox', 'lightbox');

function lightbox()
{


    // Vérification de sécurité
    if (
        ! isset($_REQUEST['nonce']) or
        ! wp_verify_nonce($_REQUEST['nonce'], 'lightbox')
    ) {
        wp_send_json_error("Vous n’avez pas l’autorisation d’effectuer cette action.", 403);
    }

    // On vérifie que l'identifiant a bien été envoyé
    if (! isset($_POST['postid'])) {
        wp_send_json_error("L'identifiant de l'article est manquant.", 400);
    }

    // on verifie si dans post il y a bien les contenus
    $reference = $_POST['reference'];
    $cat = $_POST['category'];


    /*echo '<pre>';
    echo print_r($reference, $cat);
    echo '</pre>';*/

    // Récupération des données du formulaire
    $post_id = intval($_POST['postid']);


    // Récupération de l'image à la une
    if (has_post_thumbnail($post_id)) {
        //$image_url[] = get_the_post_thumbnail_url($post_id, 'full'); // Récupérer l'URL de l'image à la une
        $image_url = array(
            'image'     => get_the_post_thumbnail_url($post_id, 'full'),
            'reference' => $reference, // Exemple : récupérer le titre comme "référence"
            'categorie' => $cat, // Combine les catégories en une chaîne
        );
    } else {
        wp_send_json_error("Aucune image trouvée pour cet article.", 404);
    }

    // Répondre avec l'URL de l'image
    wp_send_json_success(['image_url' => $image_url]);
}
