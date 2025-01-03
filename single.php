<?php
// Récupérer toutes les taxonomies disponibles (pour test ou debug)
$data = get_post_meta(get_the_ID());
/*echo '<pre>';
print_r($data);
echo '</pre>';
*/
$taxonomie = get_terms();
$name_tax = '';
foreach ($taxonomie as $tax) {

    $name_tax = $tax->taxonomy;
}

$categories = get_the_terms(get_the_ID(), $name_tax);
$cat = '';
if ($categories && !is_wp_error($categories)) {
    foreach ($categories as $category) {
        $cat = $category->name;
    }
} else {
    $cat =  'Non défini';
}

$nameFormat = '';
$formats = get_the_terms(get_the_ID(), 'format');
if ($formats && !is_wp_error($formats)) {
    foreach ($formats as $format) {
        $nameFormat = $format->name;
    }
} else {
    $nameFormat = 'Non défini';
}

// on recuperer tous les terms & post meta (ref, cat, format, type, annee)
$ref = get_post_meta(get_the_ID(), 'reference', true);

$type = get_post_meta(get_the_ID(), 'typeType', true);

// pagination
$prev = get_previous_post();
$next = get_next_post();


// Arguments pour WP_Query
$args = array(
    'post_type' => 'photo', // Spécifiez le type de contenu que vous souhaitez récupérer
);

// Nouvelle instance de WP_Query
$query = new WP_Query($args);
/*echo '<pre>';
print_r($query->posts);
echo '</pre>';*/

$ramdomPost = $query->posts;

if ($query->have_posts()) {
    // Compter le nombre de posts
    $totalPosts = count($query->posts);

    $keyPost = random_int(0, $totalPosts - 1);
    $keyPost2 = random_int(0, $totalPosts + 1);
}
// Vérifiez si la requête a des articles

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
                        <p>Référence : <?php echo get_post_meta(get_the_ID(), 'reference', true); ?></p>

                        <!-- Catégorie (Taxonomie) -->
                        <p>Catégorie :
                            <?php

                            echo esc_html($cat);

                            ?>
                        </p>

                        <!-- Format (Taxonomie) -->
                        <p>Format :
                            <?php
                            echo esc_html($nameFormat);

                            ?>
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
                            <?php echo $prev ? get_the_post_thumbnail($prev->ID, 'thumbnail', ['class' => 'image-photo-right-pagination']) : ''; ?>
                        </a>


                        <figcaption>
                            <a href="<?php echo get_permalink($prev->ID); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Line-6.png" alt=""></a>
                            <a href="<?php echo get_permalink($next->ID); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Line-7.png" alt=""></a>
                        </figcaption>
                    </figure>
                </div>
            </div>

            <!-- bas vous aimerez aussi-->
            <div class="vous-aimerez-aussi">
                <p>
                    Vous aimerez AUSSI
                </p>
                <div class="photo-vous-aimerez-aussi">
                    <figure>
                        <a class="link-photo-vous-aimerez-aussi" href="<?php echo get_permalink($ramdomPost[$keyPost]) ?>">
                            <?php echo isset($ramdomPost[$keyPost]) ? get_the_post_thumbnail($ramdomPost[$keyPost], 'full') : '' ?>
                        </a>
                    </figure>
                    <figure>
                        <a class="link-photo-vous-aimerez-aussi" href="<?php echo get_permalink($ramdomPost[$keyPost2]) ?>">
                            <?php echo isset($ramdomPost[$keyPost2]) ? get_the_post_thumbnail($ramdomPost[$keyPost2], 'full') : get_the_post_thumbnail($ramdomPost[0], 'full') ?>
                        </a>
                    </figure>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else : ?>
        <div class="flex-photo">
            <p>Aucun article trouvé.</p>
        </div>
    <?php endif; ?>
</section>

<?php wp_reset_postdata(); ?>

<!-- footer -->
<?php get_footer() ?>