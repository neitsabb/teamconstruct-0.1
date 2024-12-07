<?php

/**
 * Component: Field Input
 * Arguments: $label, $type, $placeholder, $cn
 */

$type = $args['type'] ?? 'text';
$name = $args['name'] ?? null;
$placeholder = $args['placeholder'] ?? null;

$baseCn = 'px-4 py-2 bg-gray-200';
$additionalCn = $args['cn'] ?? '';
$cn = trim("$baseCn $additionalCn");
?>

<input name="<?= esc_attr($name); ?>" class="<?= esc_attr($cn); ?>" type="<?= esc_attr($type); ?>" placeholder="<?= esc_attr($placeholder); ?>">