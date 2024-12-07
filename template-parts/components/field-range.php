<?php

/**
 * Component: Field Range
 * Arguments: $label, $value, $min, $max, $cn
 */

$label = $args['label'] ?? null;
$text = $args['text'] ?? '';
$name = $args['name'] ?? null;
$min = $args['min'] ?? 0;
$max = $args['max'] ?? 100;
$step = $args['step'] ?? 1;
$minValue = $args['minValue'] ?? 20;
$maxValue = $args['maxValue'] ?? 80;

$baseCn = 'px-4 py-2 border text-gray-900 rounded-full text-sm appearance-none';
$additionalCn = $args['cn'] ?? '';
$cn = trim("$baseCn $additionalCn");
?>
<div id="range-container">
	<div class="relative w-full">
		<!-- Barre de fond -->
		<div class="absolute inset-0 bg-gray-200 h-1 rounded-full"></div>

		<!-- Barre active entre les deux curseurs -->
		<div id="range-progress" class="absolute bg-primary h-1 rounded-full"></div>

		<!-- Premier curseur -->
		<input
			type="range"
			id="range-min"
			name="<?= esc_attr($name); ?>[min]"
			min="<?= esc_attr($min); ?>"
			max="<?= esc_attr($max); ?>"
			value="<?= esc_attr($minValue); ?>"
			step="<?= esc_attr($step); ?>"
			class="absolute -top-2 w-full appearance-none bg-transparent pointer-events-none range-slider" />

		<!-- Deuxième curseur -->
		<input
			type="range"
			id="range-max"
			name="<?= esc_attr($name); ?>[max]"
			min="<?= esc_attr($min); ?>"
			max="<?= esc_attr($max); ?>"
			value="<?= esc_attr($maxValue); ?>"
			step="<?= esc_attr($step); ?>"
			class="absolute -top-2 w-full appearance-none bg-transparent pointer-events-none range-slider" />
	</div>
	<p class="mt-4 flex justify-between items-center text-xs">
		<span>min: <b><span id="min-value"><?= esc_attr($minValue); ?></span><?= esc_attr($text); ?></b></span>
		<span>max: <b><span id="max-value"><?= esc_attr($maxValue); ?></span><?= esc_attr($text); ?></b></span>
	</p>
</div>