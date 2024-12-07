<?php get_header(); ?>

<?php

// On récupère les valeurs filtrées à partir de la fonction get_sanitized
$request = [
	'type_offer' => get_sanitized('type_offer'),
	'type_estate' => get_sanitized('type_estate'),
	'bedrooms' => get_sanitized('bedrooms',  'intval'),
	'bathrooms' => get_sanitized('bathrooms', 'intval'),
	'styles' => get_sanitized('styles'),
	'price' => [
		'min' => isset($_GET['price']['min']) ? sanitize_text_field($_GET['price']['min']) : null,
		'max' => isset($_GET['price']['max']) ? sanitize_text_field($_GET['price']['max']) : null,
	],
	'area' => [
		'min' => isset($_GET['area']['min']) ? sanitize_text_field($_GET['area']['min']) : null,
		'max' => isset($_GET['area']['max']) ? sanitize_text_field($_GET['area']['max']) : null,
	],
];

set_query_var('request', $request);

$paged = get_query_var('paged') ? get_query_var('paged') : 1;

$args = [
	'post_type' => 'estates',
	'post_status' => 'publish',
	'paged' => $paged,
	'meta_query' => [
		'relation' => 'AND',
	],
];

// Filtrer par prix
if ($request['price']['min'] && $request['price']['max']) {
	$args['meta_query'][] = [
		'key' => 'price',
		'value' => [$request['price']['min'], $request['price']['max']],
		'compare' => 'BETWEEN',
		'type' => 'NUMERIC',
	];
}

// Filtrer par superficie
if ($request['area']['min'] && $request['area']['max']) {
	$args['meta_query'][] = [
		'key' => 'area',
		'value' => [$request['area']['min'], $request['area']['max']],
		'compare' => 'BETWEEN',
		'type' => 'NUMERIC',
	];
} elseif ($request['area']['min']) {
	$args['meta_query'][] = [
		'key' => 'area',
		'value' => $request['area']['min'],
		'compare' => '>=',
		'type' => 'NUMERIC',
	];
} elseif ($request['area']['max']) {
	$args['meta_query'][] = [
		'key' => 'area',
		'value' => $request['area']['max'],
		'compare' => '<=',
		'type' => 'NUMERIC',
	];
}

// Filtrer par chambres
if ($request['bedrooms']) {
	$args['meta_query'][] = [
		'key' => 'bedrooms_count',
		'value' => $request['bedrooms'],
		'compare' => '=',
		'type' => 'NUMERIC',
	];
}

// Filtrer par salles de bain
if ($request['bathrooms']) {
	$args['meta_query'][] = [
		'key' => 'bathrooms_count',
		'value' => $request['bathrooms'],
		'compare' => '=',
		'type' => 'NUMERIC',
	];
}

// Filtrer par type d'offre
if (!empty($request['type_offer'])) {
	$args['meta_query'][] = [
		'key' => 'type_offer',
		'value' => $request['type_offer'],
		'compare' => '=',
	];
}

if (!empty($request['styles']) || !empty($request['type_estate'])) {
	if (!isset($args['tax_query'])) {
		$args['tax_query'] = [
			'relation' => 'AND',
		];
	}

	// Filtrer par styles de bien (par slug)
	if (!empty($request['styles'])) {
		$args['tax_query'][] = [
			'taxonomy' => 'estate_styles',
			'field' => 'slug',
			'terms' => $request['styles'],
		];
	}

	// Filtrer par type de bien (par slug)
	if (!empty($request['type_estate'])) {
		$args['tax_query'][] = [
			'taxonomy' => 'estate_types',
			'field' => 'slug',
			'terms' => $request['type_estate'],
		];
	}
}


// Ajouter tri si défini
if (isset($_GET['sort'])) {
	$sort = sanitize_text_field($_GET['sort']);
	switch ($sort) {
		case 'sort_price_asc':
			$args['orderby'] = 'meta_value_num';
			$args['meta_key'] = 'price';
			$args['order'] = 'ASC';
			break;
		case 'sort_price_desc':
			$args['orderby'] = 'meta_value_num';
			$args['meta_key'] = 'price';
			$args['order'] = 'DESC';
			break;
		case 'sort_latest':
			$args['orderby'] = 'date';
			$args['order'] = 'DESC';
			break;
		case 'sort_oldest':
			$args['orderby'] = 'date';
			$args['order'] = 'ASC';
			break;
	}
}


$query = new WP_Query($args);
?>
<?php get_template_part('template-parts/partials/breadcrumbs'); ?>
<div class="container-large flex flex-col md:flex-row gap-6 w-full relative items-start">
	<?php
	get_template_part('template-parts/partials/single-sidebar');
	?>
	<div class="flex flex-col gap-2 space-y-4 w-full">
		<div class="flex flex-col md:flex-row gap-2 md:items-center justify-between">
			<div>
				<h1>Liste des biens </h1>
				<p class="text-sm"><?= $query->have_posts() ? "<b>$query->found_posts</b> biens trouvés." : null; ?></p>
			</div>
			<div class="flex items-center gap-2">
				<!-- Select pour trier les biens -->
				<?php
				get_template_part('template-parts/components/form-field', args: [
					'field' => 'select',
					'name' => 'sort',
					'choices' => [
						['value' => 'sort_price_asc', 'label' => 'Trier par prix croissant'],
						['value' => 'sort_price_desc', 'label' => 'Trier par prix décroissant'],
						['value' => 'sort_latest', 'label' => 'Trier par plus récent'],
						['value' => 'sort_oldest', 'label' => 'Trier par plus ancien'],
					],
					'placeholder' => 'Trier par',
					'required' => true,
					'selected' => isset($_GET['sort']) ? sanitize_text_field($_GET['sort']) : '',
					'cn' => 'rounded-lg h-10'
				]);
				?>
			</div>
		</div>
		<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 pb-3 w-full" id="estates-grid">
			<?php
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
						]
					);
				}
				wp_reset_postdata();
			} else {
				echo 'Aucun bien trouvé';
			}
			?>
		</div>

		<?php
		// Pagination
		$links = paginate_links([
			'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
			'format' => '?paged=%#%',
			'current' => max(1, $paged),
			'total' => $query->max_num_pages, // Nombre total de pages basé sur la requête
			'prev_text' => ' ',
			'next_text' => ' ',
			'type' => 'array', // Format de sortie sous forme de tableau
		]);
		?>

		<?php if ($links) : ?>
			<ul class="flex justify-start items-center gap-x-2">
				<?php foreach ($links as $link) : ?>
					<?php if ((trim(strip_tags($link)) !== '')): ?>
						<?php $is_current_page = strpos($link, 'current') !== false; ?>
						<li class="border px-2 py-0.5 font-medium rounded-md <?= $is_current_page ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600' ?> ">
							<?php echo $link; ?>
						</li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</div>
</div>
<div class="container-large border-t pt-12 mt-16  space-y-4">
	<h2 class="mb-8"><?php echo get_field('title', 'option'); ?></h2>
	<div class="[&>p]:mb-4">
		<?php echo get_field('paragraph', 'option'); ?>
	</div>
</div>

<?php get_footer(); ?>