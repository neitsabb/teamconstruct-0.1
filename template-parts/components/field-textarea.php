<?php

/**
 * Component: Field Textarea
 * Arguments: $value, $placeholder, $cn
 */

$value = $args['value'] ?? null;
$placeholder = $args['placeholder'] ?? null;

$baseCn = 'px-4 py-2 bg-gray-200 h-full max-h-48 ';
$additionalCn = $args['cn'] ?? '';
$cn = trim("$baseCn $additionalCn");
?>

<textarea class="<?= esc_attr($cn); ?>" placeholder="<?= esc_attr($placeholder); ?>"><?= esc_html($value); ?></textarea>