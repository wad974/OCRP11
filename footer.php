<!-- FOOTER -->
<footer>
    <section class="wrapper">
        <?php
        $args = array(
            'theme_location' => 'footer', // Nom de l'emplacement du menu défini dans functions.php
            'container'      =>  'ul',
            'menu_class'  => 'footer-menu' // Désactive le conteneur par défaut <div> en <ul>
        );
        wp_nav_menu($args);
        ?>
    </section>
</footer>
<?php wp_footer() ?>
</div>
</body>

</html>