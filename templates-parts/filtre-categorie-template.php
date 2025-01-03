<?php
// on recuperer tous les taxo

$photo = get_terms(array(
    'hide_empty' => false,
));


/*echo '<pre>';
print_r($photo);
echo '</pre>';
foreach ($photo as $cat) {

    echo '<pre>';
    print_r(get_term_link($cat));
    echo '</pre>';
}*/

?>
<section id="filtre" class="filtre">
    <!-- FILTRE -->
    <div class="categorie">
        <form id="ajax-form">
            <!-- categorie -->

            <select class="select-categorie select-1" name="choix" id="choix">
                <option value="" selected>CATEGORIES</option>
                <?php foreach ($photo as $cat): ?>
                    <?php if ($cat->taxonomy === 'category' && $cat->name !== 'Non classé'): ?>
                        <option value="<?php echo get_term_link($cat) ?>">
                            <?php echo $cat->name ?>
                        </option>
                    <?php endif; ?>
                <?php endforeach; ?>

            </select>
            <select class="select-categorie select-format" name="choix" id="choix">
                <option value="" selected>FORMAT</option>
                <?php foreach ($photo as $format): ?>
                    <?php if ($format->taxonomy === 'format'): ?>
                        <option value="<?php echo get_term_link($format) ?>">
                            <?php echo $format->name ?>
                        </option>
                    <?php endif; ?>
                <?php endforeach; ?>


            </select>
            <select class="select-categorie select-trie" name="choix" id="choix">
                <optgroup label="TRIER PAR">
                    <option value="">Desc</option>
                    <option value="">Asc</option>
                </optgroup>
            </select>
        </form>
    </div>
</section>