<?php

require_once get_template_directory() . '/utils.php';

function teamconstruct_scripts(): void
{
	wp_register_style(
		handle: 'teamconstruct-style',
		src: get_template_directory_uri() . "/assets/css/app.css",
		deps: [],
		ver: '1.0',
		media: 'all'
	);
	wp_enqueue_style('teamconstruct-style');

	wp_register_script(
		handle: 'teamconstruct-script',
		src: get_template_directory_uri() . "/assets/js/app.js",
		deps: [],
		ver: '1.0',
	);
	wp_enqueue_script(handle: 'teamconstruct-script');
}
add_action(
	hook_name: 'wp_enqueue_scripts',
	callback: 'teamconstruct_scripts'
);

/** 
 * Add theme support
 */
function teamconstruct_theme_support(): void
{
	add_theme_support(feature: 'title-tag');
	add_theme_support(feature: 'post-thumbnails');
	add_theme_support(
		feature: 'html5',
		args: [
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		]
	);
	add_theme_support(feature: 'menus');
	add_theme_support('custom-logo',  [
		'height' => 100,
		'width' => 400,
		'flex-height' => true,
		'flex-width' => true,
		'header-text' => ['site-title', 'site-description'],
	]);
}
add_action(
	hook_name: 'after_setup_theme',
	callback: 'teamconstruct_theme_support'
);

/**
 * Register menus
 */
function teamconstruct_register_menus(): void
{
	register_nav_menus(locations: [
		'top-menu' => 'Top Menu Location',
	]);
}

/**
 * Register custom post types
 */
function teamconstruct_register_post_types(): void
{
	register_post_type(
		'estates',
		[
			'labels' => [
				'name'                     => 'Biens',
				'singular_name'            => 'Bien',
				'menu_name'                => 'Biens',
				'name_admin_bar'           => 'Bien',
				'add_new'                  => 'Ajouter un bien',
				'add_new_item'             => 'Ajouter un nouveau bien',
				'edit_item'                => 'Modifier le bien',
				'new_item'                 => 'Nouveau bien',
				'view_item'                => 'Voir le bien',
				'view_items'               => 'Voir les biens',
				'search_items'             => 'Rechercher des biens',
				'not_found'                => 'Aucun bien trouvé',
				'not_found_in_trash'       => 'Aucun bien trouvé dans la corbeille',
				'all_items'                => 'Tous les biens',
				'archives'                 => 'Archives des biens',
				'attributes'               => 'Attributs du bien',
				'insert_into_item'         => 'Insérer dans un bien',
				'uploaded_to_this_item'    => 'Téléversé dans ce bien',
				'filter_items_list'        => 'Filtrer la liste des biens',
				'items_list_navigation'    => 'Navigation de la liste des biens',
				'items_list'               => 'Liste des biens',
				'item_published'           => 'Bien publié',
				'item_published_privately' => 'Bien publié en privé',
				'item_reverted_to_draft'   => 'Bien remis en brouillon',
				'item_scheduled'           => 'Bien planifié',
				'item_updated'             => 'Bien mis à jour',
			],
			'public' => true,
			'has_archive' => true,
			'supports' => ['title', 'editor', 'thumbnail'],
			'show_in_rest' => true,
		]
	);
}
add_action(
	hook_name: 'init',
	callback: 'teamconstruct_register_post_types'
);


function teamconstruct_register_taxonomies(): void
{
	register_taxonomy(
		'estate_styles',
		'estates',
		[
			'label' => 'Styles',
			'public' => true,
			'hierarchical' => true,
		]
	);

	register_taxonomy(
		'estate_types',
		'estates',
		[
			'label' => 'Types',
			'public' => true,
			'hierarchical' => true,
		]
	);
}
add_action(
	hook_name: 'init',
	callback: 'teamconstruct_register_taxonomies'
);

function teamconstruct_register_blocks(): void
{
	acf_register_block_type([
		'name' => 'Paragraphe',
		'title' => 'Paragraphe',
		'render_template' => 'template-parts/blocks/paragraph.php',
		'category' => 'text',
		'icon' => 'admin-comments',
		'keywords' => ['paragraphe', 'texte'],
		'supports' => [
			'align' => true,
			'mode' => true
		],
		'enqueue_assets' => function () {
			wp_enqueue_style(
				handle: 'teamconstruct-block-paragraph',
				src: get_template_directory_uri() . "/assets/css/app.css",
				deps: ['teamconstruct-style'],
				ver: '1.0',
				media: 'all'
			);
		}
	]);
}
add_action(
	hook_name: 'acf/init',
	callback: 'teamconstruct_register_blocks'
);

function teamconstruct_create_acf_pages()
{
	if (function_exists('acf_add_options_page')) {
		acf_add_options_sub_page(page: array(
			'page_title'      => 'Paramètres de la page d\'archive',
			'parent_slug'     => 'edit.php?post_type=estates',
			'capability' => 'manage_options'
		));
	}
}
add_action(hook_name: 'init', callback: 'teamconstruct_create_acf_pages');

function teamconstruct_register_api_routes(): void
{
	register_rest_route(
		route_namespace: 'api',
		route: '/estates',
		args: [
			'methods' => 'GET',
			'callback' => 'teamconstruct_get_estates',
		]
	);

	// all users
	register_rest_route(
		route_namespace: 'api',
		route: '/users',
		args: [
			'methods' => 'GET',
			'callback' => 'teamconstruct_get_users',
		]
	);

	function teamconstruct_get_users(WP_REST_Request $request): WP_REST_Response
	{
		$users = get_users();
		return new WP_REST_Response($users, 200);
	}

	function teamconstruct_get_estates(WP_REST_Request $request): WP_REST_Response
	{
		$estates = get_posts([
			'post_type' => 'estates',
			'posts_per_page' => -1,
		]);
		return new WP_REST_Response($estates, 200);
	}
}
add_action(
	hook_name: 'rest_api_init',
	callback: 'teamconstruct_register_api_routes'
);
