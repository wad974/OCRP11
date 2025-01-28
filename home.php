<?php

wp_head();

?>

<div class="tous-photos nouveau">
    <?php
    $categorie = isset($_GET['categorie']) ? sanitize_text_field($_GET['categorie']) : '';
    $format = isset($_GET['format']) ? sanitize_text_field($_GET['format']) : '';
    $trierPar = isset($_GET['trierPar']) ? sanitize_text_field($_GET['trierPar']) : 'date';

    // Construire les arguments de WP_Query
    $args = [
        'post_type'      => 'photo',
        'posts_per_page' => -1,
        'order'          => $trierPar, // ou 'DESC' selon les besoins
    ];

    // Ajouter des tax_query si les filtres sont définis
    $tax_query = [];
    if (!empty($categorie)) {
        $tax_query[] = [
            'taxonomy' => 'category', // Nom de la taxonomie
            'field'    => 'slug',
            'terms'    => $categorie,
        ];
    }
    if (!empty($format)) {
        $tax_query[] = [
            'taxonomy' => 'format', // Nom de la taxonomie pour "format"
            'field'    => 'slug',
            'terms'    => $format,
        ];
    }
    if (!empty($tax_query)) {
        $args['tax_query'] = $tax_query;
    }

    // Lancer WP_Query
    $query = new WP_Query($args);

    // Nouvelle requête pour récupérer tous les articles page initiale de HOME.PHP
    // on récupere les taxonomie selon le name pour stocker dans arguments args
    /*$taxonomie = get_queried_object();

    // Contenu dans get pour verifier s'il y $get post_per_page
    if (isset($_GET['nombre'])) {
        $increment_page_per_8 = $_GET['nombre'];
        $nombre = intval($increment_page_per_8);
        $nombre += 8;
    }

    /*echo '<pre>';
print_r($taxonomie);
echo '</pre>';*/
    /*if (isset($_GET['order'])) {
        $order = $_GET['order'];
    }

    //var_dump($order);

    if ($order === 'asc') {
        //  var_dump($order);

        $args = array(
            'post_type' => 'photo',
            'order'        => 'ASC',
            'posts_per_page' => -1,
            'meta_query' => array(
                array(
                    'key' => 'reference',
                ),
            ),
        );
    } else if ($order === 'desc') {
        //var_dump($order);

        $args = array(
            'post_type' => 'photo',
            'order'    => 'DESC',
            'posts_per_page' => -1,
            'meta_query' => array(
                array(
                    'key' => 'reference',
                ),
            ),
        );
    } else {
        $args = array(
            'post_type' => 'photo',
            'posts_per_page' =>  $nombre,
            'meta_query' => array(
                array(
                    'key' => 'reference',
                ),
            ),
        );
    }

    // Nouvelle instance de WP_Query
    $query = new WP_Query($args);*/
    //var_dump($query);
    // Vérifier si la requête contient des articles
    ?>



    <?php require('templates_parts/view/card-view.php') ?>

    <?php if (!isset($_GET['categorie']) || !isset($_GET['format']) || !isset($_GET['trierPar'])): ?>
        <div class="mon-bouton-charger-plus">
            <a href="<?php echo home_url() . '/tous-les-photos'; ?>" class="bouton boutonAjax">
                Charger plus
            </a>
        </div>
    <?php endif; ?>


    <?php get_template_part('templates_parts/lightbox-template') ?>

</div>

<?php

wp_footer();

?>