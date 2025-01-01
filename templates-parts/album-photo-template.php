<section id="photo" class="photo">
    <div class="tous-photos">
        <?php
        // Nouvelle requête pour récupérer les articles
        $args = array(
            'post_type'      => array('photo', 'post', 'blog'),   // Type de contenu : articles
            'posts_per_page' => 8,        // Limite à 8 articles
            'orderby'        => 'date',   // Trier par date
            'order'          => 'DESC',   // Du plus récent au plus ancien
        );
        

        $query = new WP_Query($args);
        //echo '<pre>';
    //print_r($query );
    //echo '</pre>';
        //var_dump($query);
        // Vérifier si la requête contient des articles
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post(); ?>
                <figure class="flex-photo">
                    <!-- Vérifier qu'il y a une image à la une -->
                    <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('post-thumbnail'); ?>
                        </a>
                    <?php endif; ?>
                </figure>
            <?php endwhile;
            wp_reset_postdata(); // Réinitialiser la requête globale
        else : ?>
            <p>Aucun article trouvé.</p>
        <?php endif; ?>
    </div>
</section>