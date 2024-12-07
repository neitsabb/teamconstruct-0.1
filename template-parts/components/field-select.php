<?php

/**
 * Component: Field Select
 * Arguments: $choices, $placeholder, $cn
 */

$choices = $args['choices'] ?? [];
$placeholder = $args['placeholder'] ?? null;
$name = $args['name'] ?? null;
$selected = $args['selected'] ?? null; // Ajouter la valeur sélectionnée

$baseCn = 'px-4 py-2 border rounded-full text-sm appearance-none';
$additionalCn = $args['cn'] ?? '';
$cn = trim("$baseCn $additionalCn");

?>

<select class="<?= esc_attr($cn); ?>" name="<?= esc_attr($name); ?>">
	<?php if ($placeholder) : ?>
		<option value="" class="" <?= empty($selected) ? 'selected' : ''; ?>><?= esc_html($placeholder); ?></option>
	<?php endif; ?>

	<?php foreach ($choices as $choice) : ?>
		<option value="<?= esc_attr($choice['value']); ?>" <?= ($choice['value'] == $selected) ? 'selected' : ''; ?>>
			<?= esc_html($choice['label']); ?>
		</option>
	<?php endforeach; ?>
</select>