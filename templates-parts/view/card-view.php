<?php if ($query->have_posts()) : ?>
    <?php while ($query->have_posts()) : $query->the_post(); ?>
        <figure class="flex-photo">
            <!-- Vérifier qu'il y a une image à la une -->
            <?php if (has_post_thumbnail()) : ?>
                <a class="link-flex-photo" href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('post-thumbnail'); ?>
                    <div class="card-photo">
                        <img class="card-photo-eye" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/Icon_eye.png' ?>" alt="">
                        <img class="card-photo-lightbox" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/Icon_fullscreen.png' ?>" alt="">
                        <div class="card-photo-footer">
                            <span>REFERENCE PHOTO</span>
                            <span>CATEGORIE</span>
                        </div>
                    </div>
                </a>
            <?php endif; ?>
        </figure>
    <?php endwhile;
    wp_reset_postdata(); // Réinitialiser la requête globale
else : ?>
    <p>Aucun article trouvé.</p>
<?php endif; ?>