<section id="photo" class="photo">
    <div class="tous-photos">
        <?php
        // Nouvelle requête pour récupérer les articles
        // on récupere les taxonomie selon le name pour stocker dans arguments args
        $taxonomie = get_queried_object();

        /*echo '<pre>';
print_r($taxonomie);
echo '</pre>';*/

        $args = array(
            'post_type' => 'photo',
        );

        // Nouvelle instance de WP_Query
        $query = new WP_Query($args);
        //var_dump($query);
        // Vérifier si la requête contient des articles
        ?>

        <?php require('view/card-view.php') ?>
    </div>
</section>