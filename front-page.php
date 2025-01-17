<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

// Arguments pour WP_Query
$random_args = array(
	'post_type' => 'photo', // Spécifiez le type de contenu que vous souhaitez récupérer
	'orderby'        => 'rand',
	'posts_per_page' => 1,
	'meta_query' => array(
		array(
			'key' => 'reference',
		),
	),
);

$query_random = new WP_Query($random_args);

get_header();

/**BODY */
?>

<div class="page-content">
	<div class="bloc-image-accueil">
		<?php if ($query_random->have_posts()) : ?>
			<?php while ($query_random->have_posts()) : $query_random->the_post(); ?>
				<?php the_post_thumbnail('full'); ?>
			<?php endwhile; ?>
		<?php endif; ?>

	</div>
	<div class="bloc-titre-image-accueil">
		<h1>PHOTOGRAPHE EVENT</h1>
	</div>
</div>

<!-- Template pour filtre categorie galerie photo ecran accueil -->
<?php get_template_part('./templates_parts/filtre-categorie-template'); ?>

<!-- PHOTO -->
<section id="photo" class="photo">
	<div class="tous-photos grid">
		<?php
		// Nouvelle instance de WP_Query
		
		$args = array(
			'post_type' => 'photo',
			'posts_per_page' => 8,
			'meta_query' => array(
				array(
					'key' => 'reference',
				),
			),
		);


		$query = new WP_Query($args);

		//var_dump($query);

		?>

		<?php require('templates_parts/view/card-view.php') ?>


		<?php
		wp_reset_postdata(); // Réinitialiser la requête globale

		?>

		<a href=" <?php echo home_url() . '/tous-les-photos' ?>" class="bouton">
			Charger plus
		</a>
	</div>
</section>

<?php
/**FIN BODY */

get_footer();
