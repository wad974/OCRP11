<?php

//$args pour image
$args_image = array(
    'post_type' => 'photo',
    'posts_per_page' => -1,
);

// la requete 
$query = new WP_Query($args_image);
$image_url = [];

if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        // Utiliser get_the_post_thumbnail_url() pour récupérer l'URL sans l'afficher
        $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
        if ($thumbnail_url) {
            $image_url[] = array('image' => $thumbnail_url);
        }
    }
}

wp_reset_postdata(); // Réinitialiser la requête globale


$image = json_encode($image_url);
//var_dump($image);
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
                    <p>REFERENCE</p>
                    <p>CATEGORIE</p>
                </div>
            </div>
            <button class="lightbox__next arrow_right arrow">Suivant</button>
        </div>
    </div>
</div>
<script>
    const slides = <?php echo json_encode($image_url); ?>;
</script>