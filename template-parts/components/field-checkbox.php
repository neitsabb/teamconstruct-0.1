<?php

/**
 * Component: Field Checkbox
 * Arguments: $label, $cn
 */

$label = $args['label'] ?? null;
$value = $args['value'] ?? null;
$name = $args['name'] ?? null;

$baseCn = 'px-4 py-2 bg-gray-200';
$additionalCn = $args['cn'] ?? '';
$cn = trim("$baseCn $additionalCn");
?>
<div class="flex items-center gap-x-3">
	<input

		class="<?= esc_attr($cn); ?>"
		type="checkbox"
		id="<?= esc_attr($label); ?>"
		name="<?= esc_attr($name); ?>" value="<?= esc_attr($type); ?>">
	<label for="<?= esc_attr($label); ?>"><?= esc_html($label); ?></label>
</div>