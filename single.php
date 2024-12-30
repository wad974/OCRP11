<!-- header -->
<?php get_header() ?>
<!-- body -->
<section id="photo" class="photo">
    <div class="single-photo">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post() ?>
                <div class="single-photo-titre">
                    <h1>
                        <?php the_title() ?>
                    </h1>
                    <p>
                        <?php the_excerpt(); ?>
                    </p>
                </div>
                <figure class="single-photo-image">
                    <!-- on verifie qu'il y a une image dans l'url -->
                    <img src="<?php the_post_thumbnail_url() ?>" alt="">
                </figure>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="flex-photo">
                <p>Aucun article trouvé.</p>
            </div>

        <?php endif; ?>
    </div>
</section>
<!-- footer -->
<?php get_footer() ?>
