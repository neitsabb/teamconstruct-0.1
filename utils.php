<?php
if (!function_exists('render_icon_with_text')) {
	/**
	 * Renders an icon with accompanying text.
	 *
	 * @param string $icon CSS class for the icon.
	 * @param string|null $value The bold value to display.
	 * @param string|null $text Text to display next to the value.
	 * @param string $classes Additional CSS classes for the wrapper.
	 * @return string HTML output.
	 */
	function render_icon_with_text($icon, $value, $text, $classes = '')
	{
		return sprintf(
			'<span class="flex items-center gap-x-1 %s"><i class="%s"></i> <b>%s</b> %s</span>',
			esc_attr($classes),
			esc_attr($icon),
			esc_html($value),
			esc_html($text)
		);
	}
}

if (!function_exists('dd')) {
	function dd(array $data)
	{
		echo '<pre>';
		print_r($data);
		echo '</pre>';
		// die();
	}
}

function get_sanitized($key, $sanitize_func = 'sanitize_text_field')
{
	if (isset($_GET[$key])) {
		return $sanitize_func($_GET[$key]);
	}
}
