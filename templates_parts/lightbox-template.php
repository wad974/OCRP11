<?php

// $args pour image
$args_image = array(
    'post_type' => 'photo',
    'posts_per_page' => -1,
);

// La requête
$query = new WP_Query($args_image);
$image_url = []; // Tableau pour stocker les images

if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();

        // Récupérer l'URL de l'image
        $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');

        // Récupérer les termes de la taxonomie "category" pour la catégorie
        $terms_categorie = wp_get_post_terms(get_the_ID(), 'category');
        $categories = []; // Stocke les catégories
        if (!empty($terms_categorie) && !is_wp_error($terms_categorie)) {
            foreach ($terms_categorie as $term) {
                $categories[] = $term->name;
            }
        }

        // Récupérer les termes de la taxonomie "format"
        $terms_format = wp_get_post_terms(get_the_ID(), 'format');
        $formats = []; // Stocke les formats
        if (!empty($terms_format) && !is_wp_error($terms_format)) {
            foreach ($terms_format as $term) {
                $formats[] = $term->name;
            }
        }

        // Ajouter les données au tableau JSON
        if ($thumbnail_url) {
            $image_url[] = array(
                'image'     => $thumbnail_url, // URL de l'image
                'reference' => get_post_meta(get_the_ID(), 'reference', true), // Meta "reference"
                'categorie' => implode(', ', $categories), // Catégories (séparées par une virgule si plusieurs)
                'format'    => implode(', ', $formats), // Formats (séparés par une virgule si plusieurs)
            );
        }
    }
}

wp_reset_postdata(); // Réinitialiser la requête globale

$image = json_encode($image_url); // Encode le tableau en JSON pour l'utiliser dans JS
?>



<!-- LIGHTBOX -->
<div id="diapo" class="lightbox">
    <div class="conteneur">
        <div class="top">
            <button id="BoutonCloseLightBox" class="lightbox__close"></button>
        </div>
        <div class="bottom">
            <button class="lightbox__prev arrow_left arrow">Precedent</button>
            <div class="lightbox__container">
                <img class="banner-img" src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full') ?>" alt="Banner Print-it">

                <div class="sous-image">
                    <p class="ref"></p>
                    <p class="cat"></p>
                </div>
            </div>
            <button class="lightbox__next arrow_right arrow">Suivant</button>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script>
    const slides = <?php echo json_encode($image_url); ?>;
    console.log(slides)
</script>