<footer id="site-footer" class="header-footer-group">

    <div class="section-inner">

        <div class="footer-credits wrapper">

            <?php
            $args = array(
                'theme_location' => 'footer', // Nom de l'emplacement du menu défini dans functions.php
                'container'      =>  'ul',
                'menu_class'  => 'footer-menu' // Désactive le conteneur par défaut <div> en <ul>
            );
            wp_nav_menu($args);
            ?>

        </div>

    </div><!-- .section-inner -->

    <!--on affiche contact-->
    <?php get_template_part('templates_parts/contact-template') ?>

    <!--on affiche lightbox-->
    <?php get_template_part('templates_parts/lightbox-template') ?>


</footer><!-- #site-footer -->

<?php wp_footer(); ?>

</body>

</html>