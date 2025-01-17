<?php

wp_head();

?>

<div class="tous-photos">
    <?php
    // Nouvelle requête pour récupérer les articles
    // on récupere les taxonomie selon le name pour stocker dans arguments args
    $taxonomie = get_queried_object();

    // Debugging : Affiche l'objet récupéré
    /*echo '<pre>';
        print_r($taxonomie);
        echo '</pre>';*/

    // Vérification de l'objet récupéré pour construire $args
    if (!empty($taxonomie) && isset($taxonomie->slug)) {
        if ($taxonomie->taxonomy === 'category') {
            // Si la catégorie est présente
            $args = array(
                'post_type' => 'photo',
                'category_name' => $taxonomie->slug,
            );
        } elseif ($taxonomie->taxonomy === 'format') {
            // Si la taxonomie "format" est présente
            $args = array(
                'post_type' => 'photo',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'format',
                        'field'    => 'slug',
                        'terms'    => $taxonomie->slug,
                    ),
                ),
            );
        } else {
            // Si aucune catégorie ni format n'est trouvé
            $args = array(
                'post_type' => 'photo',
            );
        }
    } else {
        // Si aucun objet n'est récupéré ou pas de slug
        $args = array(
            'post_type' => 'photo',
        );
    }

    // Debugging : Affiche les arguments utilisés dans la requête
    /*echo '<pre>';
    print_r($args);
    echo '</pre>';*/
    // Nouvelle instance de WP_Query
    $query = new WP_Query($args);
    /*echo '<pre>';
        print_r($query);
        echo '</pre>';*/

    //var_dump($query);
    // Vérifier si la requête contient des articles
    ?>

    <?php require('templates_parts/view/card-view.php') ?>
    <?php get_template_part('templates_parts/lightbox-template') ?>

</div>

<?php

wp_footer();

?>