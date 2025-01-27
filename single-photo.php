<?php

// First, get the post IDs
$my_ids = get_posts(
    array(
        'post_type' => 'photo',
        'posts_per_page' => -1,
        'fields' => 'ids',
    )
);

// Then pass the the array of IDs to get_terms()
$terms = get_terms(
    array(
        'taxonomy' => 'format',
        'object_ids' => get_the_ID(),
        'hide_empty' => true,
    )
);

/*CATEGORIE*/
$categories = get_terms(
    'category',
    array(
        'object_ids' => get_the_ID(),
        'hide_empty' => true,
    )
);


// on recuperer tous les terms & post meta (ref, cat, format, type, annee)
$ref = get_post_meta(get_the_ID(), 'reference', true);

$type = get_post_meta(get_the_ID(), 'typeType', true);
// pagination
$prev = get_previous_post();
$next = get_next_post();

//*****QUERY RANDOM */
// Arguments pour WP_Query
$random_args = array(
    'post_type' => 'photo', // Spécifiez le type de contenu que vous souhaitez récupérer
    'orderby' => 'rand',
    'posts_per_page' => 2
);

$query = new WP_Query($random_args);


?>


<!-- header -->
<?php get_header() ?>
<!-- body -->
<section id="photo" class="photo">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <!-- haut terms + photo-->
            <div class="terms">
                <div class="terms-data">
                    <div class="terms-data-bas">
                        <!-- Titre -->
                        <h1><?php echo the_title(); ?></h1>

                        <!-- Référence (SCF) -->
                        <p>Référence : <?php echo $ref; ?></p>

                        <!-- Catégorie (Taxonomie) -->
                        <p>Catégorie :
                            <?php foreach ($categories as $categorie): ?>
                                <?php
                                echo esc_html($categorie->name);
                                ?>
                            <?php endforeach; ?>
                        </p>

                        <!-- Format (Taxonomie) -->

                        <p>Format :
                            <?php foreach ($terms as $format): ?>
                                <?php
                                echo esc_html($format->name);
                                ?>
                            <?php endforeach; ?>
                        </p>

                        <!-- Type (SCF) -->
                        <p>Type : <?php echo esc_html($type) ?></p>

                        <!-- Année (SCF) -->
                        <p>Année : <?php echo the_time('Y') ?></p>
                    </div>
                </div>
                <!-- Image principale -->
                <figure class="terms-photo">
                    <img src="<?php the_post_thumbnail_url(); ?>" alt="Image de <?php the_title(); ?>">
                </figure>
            </div>

            <!-- milieu contact + pagination-->
            <div class="pagination">
                <div class="left-pagination">
                    <p>Cette photo vous intéresse ?</p>
                    <button class="boutonContactPageSingle">Contact</button>
                </div>
                <div class="right-pagination">
                    <figure class="photo-right-pagination">
                        <a href="<?php echo get_permalink($prev->ID) ?>">
                            <?php echo $prev ? get_the_post_thumbnail($prev->ID, 'thumbnail', ['class' => 'image-photo-right-pagination img_prev']) : ''; ?>
                            <?php echo $next ? get_the_post_thumbnail($next->ID, 'thumbnail', ['class' => 'image-photo-right-pagination img_next']) : ''; ?>
                        </a>


                        <figcaption>
                            <?php if (!empty($prev)) : ?>
                                <a class="prev" href="<?php echo get_permalink($prev->ID); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Line-6.png" alt=""></a>
                            <?php else: ?>
                            <?php endif; ?>

                            <!-- SEPARATE-->
                            <?php if (!empty($next)) : ?>
                                <a class="next" href="<?php echo get_permalink($next->ID); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Line-7.png" alt=""></a>
                            <?php else: ?>
                            <?php endif; ?>
                        </figcaption>
                    </figure>
                </div>
            </div>

            <!-- bas vous aimerez aussi-->
            <div class="vous-aimerez-aussi">
                <p>
                    Vous aimerez AUSSI
                </p>
                <div class="photo-vous-aimerez-aussi tous-photos">
                    <?php require('templates_parts/view/card-view.php') ?>
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</section>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    $(document).ready(function() {
        $("#email").val("<?php echo $ref ?>");
    });
</script>
<!-- footer -->
<?php get_footer() ?>