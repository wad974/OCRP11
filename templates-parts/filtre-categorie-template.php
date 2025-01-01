<?php
// on recuperer tous les taxo
$photo = get_terms(array(
    'hide_empty' => false,
));

/*
echo '<pre>';
print_r($photo);
echo '</pre>';
*/
?>
<section id="photo" class="photo">
    <!-- FILTRE -->
    <div class="categorie">
        <form action="" method="get">
            <!-- categorie -->

            <select class="select-categorie select-1" name="categorie" id="categorie">
                <option value="">catégories</option>
                <option value=""></option>
                <?php foreach ($photo as $cat): ?>
                    <?php if ($cat->taxonomy === 'category'): ?>
                        <option value="<?php echo get_term_link($cat) ?>">
                            <?php echo $cat->name ?>
                        </option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
            <select class="select-categorie select-format" name="categorie" id="categorie">
                <option value="">FORMATS</option>
                <option value=""></option>
                <?php foreach ($photo as $format): ?>
                    <?php if ($format->taxonomy === 'format'): ?>
                        <option value="<?php echo get_term_link($format) ?>">
                            <?php echo $format->name ?>
                        </option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
            <select class="select-categorie select-trie" name="categorie" id="categorie">
                <option value="">TRIER PAR</option>
                <option value="dog">Dog</option>
                <option value="cat">Cat</option>
                <option value="hamster">Hamster</option>
            </select>
        </form>
    </div>
</section>