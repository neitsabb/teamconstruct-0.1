<?php
// Inclure WordPress
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');

// Charger FakerPHP
require_once __DIR__ . '/vendor/autoload.php';
$faker = Faker\Factory::create();

// Configuration
$post_type = 'estates'; // Votre Custom Post Type
$num_posts = 0; // Nombre de posts à générer

$names = [
	"Villa Azure",
	"Château du Soleil",
	"Résidence Émeraude",
	"Domaine des Oliviers",
	"Maison Blanche",
	"Penthouse Horizon",
	"Manoir des Étoiles",
	"Cottage Fleuri",
	"Refuge des Pins",
	"Appartement Lumière",
	"Les Jardins d'Éden",
	"Terrasse Céleste",
	"Palais de Verre",
	"Maison du Rivage",
	"Villa Paradisiaque",
];

// Supprimer tous les anciens posts de ce type
$existing_posts = get_posts([
	'post_type'      => $post_type,
	'post_status'    => 'any', // Inclut tous les statuts (publish, draft, etc.)
	'posts_per_page' => -1, // Obtenir tous les posts
	'fields'         => 'ids', // On récupère uniquement les ID des posts
]);

if (!empty($existing_posts)) {
	foreach ($existing_posts as $post_id) {
		wp_delete_post($post_id, true); // Suppression définitive
	}
}

// Récupérer tous les ID des images déjà dans la médiathèque
$existing_images = get_posts([
	'post_type'      => 'attachment',
	'post_mime_type' => 'image',
	'posts_per_page' => -1,
	'fields'         => 'ids', // On récupère uniquement les ID des images,
	'exclude'        => [get_theme_mod('custom_logo')]
]);

if (empty($existing_images)) {
	die('Aucune image trouvée dans la médiathèque. Veuillez en ajouter au moins une avant d’exécuter ce script.');
}

// Boucle pour créer les posts
for ($i = 0; $i < $num_posts; $i++) {
	// Créer un post
	$post_id = wp_insert_post([
		'post_title'   =>  $names[array_rand($names)],
		'post_status'  => 'publish',
		'post_type'    => $post_type,
	]);

	if ($post_id) {
		// Ajouter des champs personnalisés (ACF ou non)
		update_post_meta($post_id, 'price', $faker->numberBetween(100000, 1000000));
		update_post_meta($post_id, 'area', $faker->numberBetween(50, 300));
		update_post_meta($post_id, 'bedrooms_count', $faker->numberBetween(1, 5));
		update_post_meta($post_id, 'bathrooms_count', $faker->numberBetween(1, 3));

		update_post_meta($post_id, 'catchphrase', $faker->sentence($nbWords = 10));

		update_post_meta($post_id, 'type', $faker->randomElement(['À vendre', 'En location']));

		// Sélectionner une image au hasard depuis les images existantes
		$random_image_id = $existing_images[array_rand($existing_images)];

		// Associer cette image au post comme thumbnail
		set_post_thumbnail($post_id, $random_image_id);

		// Ajouter des images supplémentaires
		$additional_images = $faker->randomElements($existing_images, $count = $faker->numberBetween(1, 5), $allowDuplicates = false);
	}
}

echo "Generated $num_posts posts with thumbnails for the '$post_type' post type!";
