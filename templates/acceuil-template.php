<?php

/**
 * Template Name: Template Page Accueil
 */


?>

<?php
// Header
get_header();
?>

<!-- Body -->
<h1>template</h1>
<?php if (have_posts()) : ?>

    <?php if (trim(get_the_content()) !== '') : ?>
        <!-- Contenu de la page modifié avec Gutenberg -->
        <div class="page-content">
            <?php the_content(); ?>
        </div>

        <!-- Template pour filtre categorie galerie photo ecran accueil -->
        <?php get_template_part('./templates-parts/filtre-categorie-template'); ?>

        <!-- TEMPLATE ALBUM PHOTO -->
        <?php get_template_part('./templates-parts/album-photo-template'); ?>

    <?php endif; ?>

<?php endif; ?>

<?php
// Footer
get_footer();
?>