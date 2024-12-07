<?php

/**
 * Component: Button
 * Arguments: $text, $type, $variant, $cn
 */


$type = $args['type'] ?? 'button';
$text = $args['text'] ?? null;
$variant = $args['variant'] ?? null;
$id = $args['id'] ?? null;
$dataEstateId = $args['data-estate-id'] ?? null;

$baseCn = 'px-4 py-2 rounded-lg text-sm';

// Gestion des variantes
$variantCn = match ($variant) {
	'primary' => 'bg-primary text-white',
	'secondary' => 'bg-secondary text-black',
	'square' => 'aspect-square border w-10 h-10 grid place-content-center hover:bg-primary hover:text-white transition-all',
	default => '',
};

// Classes supplémentaires via `args['cn']`
$additionalCn = $args['cn'] ?? '';

// Fusion des classes
$cn = trim("$baseCn $variantCn $additionalCn");
?>

<button class="<?= esc_attr($cn); ?>" type="<?= esc_attr($type); ?>" id="<?= $id; ?>" data-id="<?= $dataEstateId; ?>">
	<?= $text; ?>
</button>