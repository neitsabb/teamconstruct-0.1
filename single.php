<?php
$estateId = get_the_ID();

$description = get_field('description');
$bedrooms = get_field('bedrooms_count');
$bathrooms = get_field('bathrooms_count');
$price = get_field('price');
$area = get_field('area');

$images = get_field('images');
$video = get_field('video');

// Récupérer le cookie de la wishlist
$wishlist = isset($_COOKIE['wishlist']) ? json_decode(stripslashes($_COOKIE['wishlist']), true) : [];

// Vérifier si l'ID du bien est dans la wishlist
$inWishlist = in_array($estateId, $wishlist);
?>

<?php get_header(); ?>
<?php get_template_part('template-parts/partials/breadcrumbs'); ?>

<div class="container-large divide-y">
	<div class="flex items-center justify-between pb-8">
		<h1><?= the_title(); ?></h1>
		<span class="font-bold text-3xl"><?= get_field('price'); ?> €</span>
	</div>
	<div class="py-6 flex items-center justify-between">


		<p class="text-sm">
			<?= get_field('catchphrase'); ?>
		</p>


		<div class="flex items-center justify-end gap-x-2">
			<?php

			get_template_part(
				'template-parts/components/button',
				args: [
					'text'    => $inWishlist ? '<i class="fa-solid fa-heart"></i>' : '<i class="fa-regular fa-heart"></i>',
					'variant' 		=> 'square',
					'id' => 'wishlist-button',
					'data-estate-id' => get_the_ID(),
				]
			);
			?>
			<?php
			get_template_part('template-parts/components/button', args: [
				'text' => '<i class="fa-solid fa-share"></i>',
				'variant' => 'square',
			]);
			?>
		</div>
	</div>
</div>
<div class="container-large grid grid-cols-1 md:grid-cols-2 gap-4 pb-10">
	<div class="<?= empty($images) ? "col-span-full max-h-96" : "col-span-1" ?>">
		<img src="https://homelengowp.themesflat.com/wp-content/uploads/2024/05/prop-3-min-1.jpg" alt="" class="w-full h-full object-cover rounded-xl" />
	</div>
	<div class="grid grid-cols-2 grid-rows-2 gap-4">
		<?php if (isset($images) && !empty($images)): ?>
			<?php foreach ($images as $image): ?>
				<div>
					<img src="<?= $image['url']; ?>" alt="" class="w-full h-full object-cover rounded-xl" />
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>
<div class="container-large flex flex-col md:flex-row items-start gap-8">
	<div class="w-full divide-y space-y-8">
		<div class="space-y-4">
			<h2>Description</h2>
			<?= $description; ?>
		</div>
		<div class="pt-6 space-y-4">
			<h2>Vue d'ensemble</h2>
			<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
				<div class="flex gap-x-2 items-center">
					<div class="border w-12 h-12 rounded-xl grid place-content-center">
						<i class="fa-solid fa-bed"></i>
					</div>
					<div class="flex flex-col text-sm">
						Chambres:
						<b class="text-base">
							<?= $bedrooms; ?>
						</b>
					</div>
				</div>

				<div class="flex gap-x-2 items-center">
					<div class="border w-12 h-12 rounded-xl grid place-content-center">
						<i class="fa-solid fa-bath"></i>
					</div>
					<div class="flex flex-col text-sm">
						Salles de bains:
						<b class="text-base"><?= $bathrooms; ?></b>
					</div>
				</div>
				<div class="flex gap-x-2 items-center">
					<div class="border w-12 h-12 rounded-xl grid place-content-center">
						<i class="fa-solid fa-ruler"></i>
					</div>
					<div class="flex flex-col text-sm">
						Superficie:
						<b class="text-base"><?= $area; ?> m²</b>
					</div>
				</div>
			</div>
		</div>
		<?php if ($video): ?>
			<div class="pt-6 space-y-4">
				<h2>Vidéo</h2>

				<iframe class="aspect-video w-full" src="<?= $video; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div>
		<?php endif; ?>

	</div>

	<?php
	get_template_part('template-parts/partials/single-sidebar', args: [
		'title' => 'Chercher un bien'
	]);

	?>
</div>



<?php get_footer(); ?>