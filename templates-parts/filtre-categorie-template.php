
<section id="photo" class="photo">
<!-- FILTRE -->
    <div class="categorie">
        <form action="" method="get">
            <select class="select-categorie select-1" name="categorie" id="categorie">
                <option value="">catégories</option>
                <option value="dog">Dog</option>
                <option value="cat">Cat</option>
                <option value="hamster">Hamster</option>
            </select>
            <select class="select-categorie" name="categorie" id="categorie">
                <option value="">FORMATS</option>
                <option value="dog">Dog</option>
                <option value="cat">Cat</option>
                <option value="hamster">Hamster</option>
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

<!-- PHOTO ALBUM DANS ARTICLES -->
<?php get_template_part('home') ?>