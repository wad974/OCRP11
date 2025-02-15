<?php
// on recuperer tous les taxo

$photo = get_terms(array(
    'hide_empty' => false,
));

/*
echo '<pre>';
print_r($photo);
echo '</pre>';
foreach ($photo as $cat) {

    echo '<pre>';
    print_r(get_term_link($cat));
    echo '</pre>';
}*/

?>
<section id="filtre" class="filtre">
    <div class="categorie">
        <div class="form">
            <div class="select select-debut">
                <div class="select-titre">Catégories</div>
                <ul class="select-option">
                    <?php foreach ($photo as $cat): ?>
                        <?php if ($cat->taxonomy === 'category' && $cat->name !== 'Non classé'): ?>
                            <li class="option" data-value="<?php echo $cat->name ?>">
                                <?php echo $cat->name ?>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="select">
                <div class="select-titre">FORMAT</div>
                <ul class="select-option">
                    <?php foreach ($photo as $format): ?>
                        <?php if ($format->taxonomy === 'format'): ?>
                            <li class="option" data-value="<?php echo $format->name ?>">
                                <?php echo $format->name ?>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="select select-fin">
                <div class="select-titre">Trier par</div>
                <ul class="select-option">
                    <li class="option" data-value="ASC">A partir des plus récentes</li>
                    <li class="option" data-value="DESC">A partir des plus anciennes</li>
                </ul>
            </div>
        </div>
    </div>

</section>