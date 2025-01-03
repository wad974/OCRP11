

<?php
// Header
get_header();
?>

<!-- Body -->
<h1>index</h1>
<?php if (have_posts()) : ?>

    <?php if (trim(get_the_content()) !== '') : ?>
        <!-- Contenu de la page modifié avec Gutenberg -->
        <div class="page-content">
            <?php the_content(); ?>
        </div>

    <?php endif; ?>

<?php endif; ?>
<?php
// Footer
get_footer();
?>