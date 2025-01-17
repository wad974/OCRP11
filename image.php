<?php
// pagination
$prev = get_previous_post();
$next = get_next_post();
?>
<div id="diapo" class="lightbox">
    <button class="lightbox__close">Fermer</button>
    <button href="<?php echo get_permalink($next->ID) ?>" class="lightbox__next">Suivant</button>
    <button href="<?php echo get_permalink($prev->ID) ?>" class="lightbox__prev">Precedent</button>
    <div class="lightbox__container">
        <?php $image_size = apply_filters('wporg_attachment_size', 'large',); ?>
        <img <?php echo wp_get_attachment_image(get_the_ID(), $image_size); ?>>
    </div>
</div>