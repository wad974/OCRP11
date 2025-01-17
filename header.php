<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--head wp-->
    <?php wp_head() ?>
    <!--title-->
    <title><?php bloginfo('name') ?></title>
</head>

<body>
    <!-- container -->
    <div class="container">

        <!-- HEADER -->
        <header class="header">
            <section class="wrapper">
                <!-- LOGO -->
                <figure class="logo">
                    <?php if (function_exists('the_custom_logo') && has_custom_logo()) : ?>
                        <!-- Afficher le logo défini dans le personnalisateur -->
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <!-- Afficher le nom du site comme fallback -->
                        <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
                            <?php bloginfo('name'); ?>
                        </a>
                    <?php endif; ?>
                </figure>

                <!-- NAVIGATION -->
                <nav class="nav-menu">
                    <!--TOOGLE-->

                    <button class="burger-bouton">
                        <span class="burger-bouton-trait"></span>
                        <span class="burger-bouton-trait"></span>
                        <span class="burger-bouton-trait"></span>
                    </button>
                    <button class="burger-close">
                        <span class="burger-bouton-trait trait1"></span>
                        <span class="burger-bouton-trait trait2"></span>
                    </button>


                    <!--menu-->
                    <?php
                    $args = array(
                        'theme_location' => 'header', // Nom de l'emplacement du menu défini dans functions.php
                        'container'      =>  'ul',    // Désactive le conteneur par défaut <div> en <ul>
                    );
                    wp_nav_menu($args);
                    ?>


                </nav>
            </section>
        </header>