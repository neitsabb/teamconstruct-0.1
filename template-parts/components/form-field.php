<?php

/**
 * Component: Form Field
 * Arguments: $label, $type, $value, $choices, $placeholder, $cn
 */

$label = $args['label'] ?? null;
$field = $args['field'] ?? 'input';
$name = $args['name'] ?? null;
$type = $args['type'] ?? 'text';
$value = $args['value'] ?? null;
$placeholder = $args['placeholder'] ?? null;
$required = $args['required'] ?? false;
$choices = $args['choices'] ?? [];
$cn = $args['cn'] ?? '';
?>

<div class="space-y-3 flex flex-col">
	<?php if ($field !== 'checkbox' && $label) : ?>
		<label for="<?= esc_attr($label); ?>"><?= esc_html($label); ?></label>
	<?php endif; ?>
	<?php
	match ($field) {
		'input' => get_template_part('template-parts/components/field-input', args: [
			'type' => 'text',
			'placeholder' => $placeholder,
			'name' => $name,
			'value' => $value,
		]),
		'textarea' => get_template_part('template-parts/components/field-textarea', args: [
			'placeholder' => $placeholder,
			'name' => $name,
			'value' => $value,
		]),
		'select' => get_template_part('template-parts/components/field-select', args: [
			'choices' => $choices,
			'placeholder' => $placeholder,
			'name' => $name,
			'value' => $value,
			'selected' => $args['selected'],
			'cn' => $cn,
		]),
		'checkbox' => get_template_part('template-parts/components/field-checkbox', args: [
			'label' => $label,
			'value' => $value,
			'name' => $name,
		]),
		'range' => get_template_part('template-parts/components/field-range', args: [
			'label' => $label,
			'value' => $value,
			'name' => $name,
			'text' => $args['text'],
			'min' => $args['min'],
			'max' => $args['max'],
			'step' => $args['step'] ?? 1,
			'minValue' => $args['minValue'],
			'maxValue' => $args['maxValue'],
		]),
	}
	?>
</div>