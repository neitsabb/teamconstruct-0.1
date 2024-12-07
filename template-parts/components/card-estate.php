<?php

$estateId = get_the_ID();

// Récupérer le cookie de la wishlist
$wishlist = isset($_COOKIE['wishlist']) ? json_decode(stripslashes($_COOKIE['wishlist']), true) : [];

// Vérifier si l'ID du bien est dans la wishlist
$inWishlist = in_array($estateId, $wishlist);

// Initialisation des variables avec des valeurs par défaut
$imageId    = $args['image_id'] ?? null;
$description = $args['description'] ?? null;
$title       = $args['title'] ?? null;
$price       = isset($args['price']) ? number_format($args['price'], 0, ',', '.') : null;
$area        = $args['area'] ?? null;
$bedrooms    = $args['bedrooms'] ?? null;
$bathrooms   = $args['bathrooms'] ?? null;
$href        = $args['href'] ?? null;
$catchphrase = $args['catchphrase'] ?? null;
$typeOffer = $args['type_offer'] ?? null;
$typeEstate = $args['type_estate'] ?? null;
?>

<a href="<?= $href; ?>" class="overflow-hidden group cursor-pointer" id="card-estate">
	<!-- Image Section -->
	<div class="relative w-full rounded-t-xl overflow-hidden transition-all duration-300">
		<div class="h-48 w-full ">
			<?php if ($imageId) : ?>
				<?= wp_get_attachment_image($imageId, 'large', false, ['class' => 'group-hover:scale-105 transition-transform duration-300 w-full h-full object-cover']) ?>
			<?php endif; ?>
		</div>

		<!-- Overlay -->
		<div class="bg-black/15 group-hover:bg-black/40 absolute inset-0 z-10"></div>

		<!-- Badge -->
		<div class="absolute top-3 left-3 z-20 bg-black/50 text-white text-xs px-3 py-1.5 rounded-full ">
			<?= $typeOffer === 'buy' ? 'En vente' : 'En location'; ?>
		</div>

		<!-- Catchphrase -->
		<?php ?>
		<div class="absolute top-0 left-0 w-full h-full flex items-center justify-center z-20 text-xs text-white px-4 text-center opacity-0 group-hover:opacity-100 transition-all duration-300 leading-relaxed">
			<?= esc_html($catchphrase); ?>
		</div>
		<?php  ?>

		<!-- Wishlist Button -->
		<?php
		get_template_part(
			'template-parts/components/button',
			args: [
				'text'    => $inWishlist ? '<i class="fa-solid fa-heart"></i>' : '<i class="fa-regular fa-heart"></i>',
				'href'    => '#',
				'cn' 		=> 'absolute top-3 right-3 z-20 bg-black/50 text-white text-xs w-6 aspect-square grid place-content-center !rounded-full hover:bg-black/60 z-20',
				'id' => 'wishlist-button',
				'data-estate-id' => $estateId,
			]
		);
		?>
	</div>

	<!-- Content Section -->
	<div class="p-3 pt-4 space-y-4 border rounded-b-xl bg-white drop-shadow-sm">
		<!-- Title -->
		<h3 class="font-semibold hover:text-primary"><?= esc_html($title); ?></h3>

		<!-- Details -->
		<div class="flex justify-between text-sm">
			<?= $area ? render_icon_with_text('fa-solid fa-ruler', $area, 'm²', 'w-1/3 text-left') : null ?>
			<?= $bedrooms ? render_icon_with_text('fa fa-bed', $bedrooms, 'ch.', 'w-1/3 justify-center') : null ?>
			<?= $bathrooms ? render_icon_with_text('fa fa-sink', $bathrooms, 'sdb.', 'w-1/3 justify-end') : null ?>
		</div>

		<!-- Footer Section -->
		<div class="pt-3 flex items-center justify-between border-t">
			<!-- Wishlist Button -->
			<?php
			get_template_part(
				'template-parts/components/button',
				args: [
					'text' => 'Voir plus',
					'variant' => 'primary',
				]
			);
			?>

			<!-- Price -->
			<span class="font-bold text-lg"><?= esc_html($price); ?> €</span>
		</div>
	</div>
</a>