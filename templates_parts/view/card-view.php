<?php if ($query->have_posts()) : ?>
    <?php while ($query->have_posts()) : $query->the_post(); ?>
        <figure class="flex-photo">
            <!-- Vérifier qu'il y a une image à la une -->
            <?php if (has_post_thumbnail()) : ?>


                <a class="link-flex-photo" href='<?php echo the_permalink(); ?>'>
                    <?php the_post_thumbnail('post-thumbnail', ['class' => 'img-responsive', 'title' => 'Nathalia Mota']); ?>
                    <!-- HIDDEN CARD -->
                    <div class="card-photo">
                        <?php

                        $reference = get_post_meta(get_the_ID(), 'reference', true);
                        $taxonomie = get_terms();
                        $name_tax = '';
                        foreach ($taxonomie as $tax) {

                            $name_tax = $tax->taxonomy;
                        }

                        $categories = get_the_terms(get_the_ID(), $name_tax);


                        if ($categories && !is_wp_error($categories)) {
                            foreach ($categories as $category) {
                                $cat = $category->name;
                            }
                        } else {
                            $cat =  'Non défini';
                        }

                        ?>
                        <img class="card-photo-eye" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/Icon_eye.png' ?>" alt="">

                        <!--LIEN JS AJAX FULL IMAGE SEUL-->
                        <form
                            action="<?php echo admin_url('admin-ajax.php'); ?>"
                            method="post"
                            class="js-load-lightbox">
                            <input
                                type="hidden"
                                name="postid"
                                value="<?php echo get_the_ID() ?>">
                            <input
                                type="hidden"
                                name="nonce"
                                value="<?php echo wp_create_nonce('lightbox'); ?>">
                            <!-- ou : wp_nonce_field( 'capitaine_load_comments' ); -->
                            <input
                                type="hidden"
                                name="action"
                                value="lightbox">

                            <!-- REFERENCE & CATEGORIE -->
                            <input
                                type="hidden"
                                name="reference"
                                value="<?php echo $reference ?>">
                            <input
                                type="hidden"
                                name="category"
                                value="<?php echo $cat ?>">

                            <button type="submit" class="image-link comments-load-button">
                                <img class="card-photo-lightbox" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/Icon_fullscreen.png' ?>" alt="">
                            </button>
                        </form>

                        <div class="card-photo-footer">

                            <span><?php echo $reference ?></span>

                            <span><?php echo $cat ?></span>

                        </div>
                    </div>
                </a>

            <?php endif; ?>
        </figure>
    <?php endwhile;

else : ?>
    <p>Aucun article trouvé.</p>

<?php endif; ?>


