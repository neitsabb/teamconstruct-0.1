<?php
$area = 150;
$bedrooms = 3;
$bathrooms = 2;

$title = $args['title'] ?? 'Filtres';
$request = get_query_var('request');

$styles = get_terms([
	'taxonomy' => 'estate_styles',
	'hide_empty' => false,
]);

$types = get_terms([
	'taxonomy' => 'estate_types',
	'hide_empty' => false,
]);
?>

<div class="space-y-6 md:sticky top-6 w-full md:w-80 lg:w-96">
	<div class="card shrink-0 w-full">
		<h2 class="flex items-center justify-between">
			<?= $title; ?>
			<button class="md:hidden transform " id="filter-toggle">
				<i class="fa-solid fa-caret-down"></i>
			</button>
		</h2>
		<form id="filter-estate" method="GET" action="<?php echo esc_url(get_post_type_archive_link('estates')); ?>">
			<div class="space-y-3 mt-3">
				<?php
				get_template_part('template-parts/components/form-field', args: [
					'field' => 'select',
					'name' => 'type_offer',
					'choices' => [
						['value' => 'buy', 'label' => '&Agrave; vendre'],
						['value' => 'rent', 'label' => 'En location'],
					],
					'placeholder' => 'Types d\'offres',
					'required' => true,
					'selected' => $request['type_offer'] ?? '',
				]);

				get_template_part('template-parts/components/form-field', args: [
					'field' => 'select',
					'name' => 'type_estate',
					'choices' => array_map(function ($type) {
						return [
							'value' => $type->slug,
							'label' => $type->name,
						];
					}, $types),
					'placeholder' => 'Types de biens',
					'required' => true,
					'selected' => $request['type_estate'] ?? '',
				]);

				get_template_part('template-parts/components/form-field', args: [
					'field' => 'select',
					'name' => 'styles',
					'choices' => array_map(function ($style) {
						return [
							'value' => $style->slug,
							'label' => $style->name,
						];
					}, $styles),
					'placeholder' => 'Styles',
					'required' => true,
					'selected' => $request['styles'] ?? '',
				]);

				get_template_part('template-parts/components/form-field', args: [
					'field' => 'select',
					'name' => 'bedrooms',
					'choices' => [
						['value' => '1', 'label' => '1 chambre'],
						['value' => '2', 'label' => '2 chambres'],
						['value' => '3', 'label' => '3 chambres'],
						['value' => '4', 'label' => '4 chambres'],
						['value' => '5', 'label' => '5 chambres'],
						['value' => '6', 'label' => '6 chambres'],
						['value' => '7', 'label' => '7 chambres'],
						['value' => '8', 'label' => '8 chambres'],
						['value' => '9', 'label' => '9 chambres'],
						['value' => '10', 'label' => '10 chambres'],
					],
					'placeholder' => 'Chambres',
					'required' => true,
					'selected' => $request['bedrooms'] ?? '',
				]);

				get_template_part('template-parts/components/form-field', args: [
					'field' => 'select',
					'name' => 'bathrooms',
					'choices' => [
						['value' => '1', 'label' => '1 salle de bain'],
						['value' => '2', 'label' => '2 salles de bain'],
						['value' => '3', 'label' => '3 salles de bain'],
						['value' => '4', 'label' => '4 salles de bain'],
						['value' => '5', 'label' => '5 salles de bain'],
						['value' => '6', 'label' => '6 salles de bain'],
						['value' => '7', 'label' => '7 salles de bain'],
						['value' => '8', 'label' => '8 salles de bain'],
						['value' => '9', 'label' => '9 salles de bain'],
						['value' => '10', 'label' => '10 salles de bain'],
					],
					'placeholder' => 'Salles de bains',
					'required' => true,
					'selected' => $request['bathrooms'] ?? '',
				]);
				?>
			</div>
			<div class="space-y-3 my-4">
				<?php
				get_template_part('template-parts/components/form-field', args: [
					'field' => 'range',
					'name' => 'price',
					'label' => 'Prix HTVA',
					'text' => '€',
					'value' => $request['price']['min'] ?? 0,
					'min' => 1000,
					'max' => 1000000,
					'step' => 1000,
					'minValue' => $request['price']['min'] ?? 0,
					'maxValue' => $request['price']['max'] ?? 1000000,
				]);

				get_template_part('template-parts/components/form-field', args: [
					'field' => 'range',
					'label' => 'Superficie',
					'name' => 'area',
					'text' => 'm²',
					'value' => $request['area']['min'] ?? 0,
					'min' => 0,
					'max' => 200,
					'step' => 1,
					'minValue' => $request['area']['min'] ?? 0,
					'maxValue' => $request['area']['max'] ?? 200,
				]);
				?>
			</div>

			<?php
			get_template_part('template-parts/components/button', args: [
				'text' => 'Trouver des biens',
				'variant' => 'primary',
				'cn' => 'w-full',
				'type' => 'submit',
			]);
			?>
		</form>
	</div>

	<div class="hidden md:block ">
		<h2>Derniers biens</h2>
		<div class="flex flex-col gap-y-4 divide-y">
			<div class="flex items-center gap-x-3 w-full pt-4">
				<div class="w-24 shrink-0">
					<img src="https://via.placeholder.com/112" alt="Image de bien" class="w-full rounded-xl">
				</div>
				<div class="space-y-3 w-full">
					<div class="space-y-1">
						<h3 class="text-sm">Argay Terrace Portland</h3>
						<div class="flex justify-between text-xs">
							<?= $area ? render_icon_with_text('fa-solid fa-ruler', $area, 'm²', 'w-1/3 text-left') : null ?>
							<?= $bedrooms ? render_icon_with_text('fa fa-bed', $bedrooms, 'ch.', 'w-1/3 justify-center') : null ?>
							<?= $bathrooms ? render_icon_with_text('fa fa-sink', $bathrooms, 'sdb.', 'w-1/3 justify-end') : null ?>
						</div>
					</div>
					<span class="font-bold block">130 000€</span>
				</div>
			</div>
			<div class="flex items-center gap-x-3 w-full pt-4">
				<div class="w-24 shrink-0">
					<img src="https://via.placeholder.com/112" alt="Image de bien" class="w-full rounded-xl">
				</div>
				<div class="space-y-3 w-full">
					<div class="space-y-1">
						<h3 class="text-sm">Argay Terrace Portland</h3>
						<div class="flex justify-between text-xs">
							<?= $area ? render_icon_with_text('fa-solid fa-ruler', $area, 'm²', 'w-1/3 text-left') : null ?>
							<?= $bedrooms ? render_icon_with_text('fa fa-bed', $bedrooms, 'ch.', 'w-1/3 justify-center') : null ?>
							<?= $bathrooms ? render_icon_with_text('fa fa-sink', $bathrooms, 'sdb.', 'w-1/3 justify-end') : null ?>
						</div>
					</div>
					<span class="font-bold block">130 000€</span>
				</div>
			</div>
		</div>
	</div>
</div>