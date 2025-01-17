<?php

wp_head();

?>

<div class="tous-photos nouveau">
    <?php
    // Nouvelle requête pour récupérer tous les articles page initiale de HOME.PHP
    // on récupere les taxonomie selon le name pour stocker dans arguments args
    $taxonomie = get_queried_object();

    /*echo '<pre>';
print_r($taxonomie);
echo '</pre>';*/
    if (isset($_GET['order'])) {
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
            'posts_per_page' => -1,
            'meta_query' => array(
                array(
                    'key' => 'reference',
                ),
            ),
        );
    }

    // Nouvelle instance de WP_Query
    $query = new WP_Query($args);
    //var_dump($query);
    // Vérifier si la requête contient des articles
    ?>



    <?php require('templates_parts/view/card-view.php') ?>

    <a href=" <?php echo home_url() ?>" class="bouton">
        Charger plus
    </a>


    <?php get_template_part('templates_parts/lightbox-template') ?>

</div>

<?php

wp_footer();

?>