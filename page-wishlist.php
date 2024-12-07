<?php
get_header();

get_template_part('template-parts/partials/breadcrumbs');
?>

<div class="container-large space-y-6 divide-y">
	<div class="space-y-2 pb-2">
		<h1>Mes coups de coeurs</h1>
		<p>Votre sélection des meilleures réalisations TeamConstruct se trouve ici. </p>
	</div>

	<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 pb-3 w-full pt-6" id="estates-grid">

		<?php
		if (isset($_COOKIE['wishlist'])) {
			$wishlist = json_decode(stripslashes($_COOKIE['wishlist']), true);

			if ($wishlist) {
				$args = array(
					'post_type' => 'estates',
					'post__in' => $wishlist,
					'posts_per_page' => -1
				);
				$query = new WP_Query($args);

				if ($query->have_posts()) {
					while ($query->have_posts()) {
						$query->the_post();
						get_template_part(
							slug: 'template-parts/components/card',
							name: 'estate',
							args: [
								'image_id' => get_post_thumbnail_id(),
								'href' => get_the_permalink(),
								'title' => get_the_title(),
								'price' => get_field('price'),
								'area' => get_field('area'),
								'bedrooms' => get_field('bedrooms_count'),
								'bathrooms' => get_field('bathrooms_count'),
								'catchphrase' => get_field('catchphrase'),
								'type_offer' => get_field('type_offer'),
								'type_estate' => get_field('type_estate'),
								'in_wishlist' => rand(0, 1)
							]
						);
					}
					wp_reset_postdata();
				} else {
					echo 'Votre liste de coups de coeur est vide.';
				}
			} else {
				echo 'Votre liste de coups de coeur est vide.';
			}
		} else {
			echo 'Votre liste de coups de coeur est vide.';
		}
		?>
	</div>

</div>

<?php get_footer(); ?>