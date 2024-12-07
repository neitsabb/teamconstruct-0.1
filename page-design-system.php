<?php
/*
Template Name: Design System
*/
get_header(); ?>

<div class="container-large py-6">
	<h1>Design System</h1>
	<p>Ceci est la page du Design System.</p>

	<h2>Exemple de titre H2</h2>
	<h3>Titres</h3>
	<h1>H1 - Titre Principal</h1>
	<h2>H2 - Sous-titre</h2>
	<h3>H3 - Titre de section</h3>
	<h4>H4 - Sous-section</h4>
	<h5>H5 - Titre mineur</h5>
	<h6>H6 - Titre le plus petit</h6>

	<h3>Paragraphes</h3>
	<p>Voici un exemple de paragraphe. Il devrait refléter la police et la taille définies pour les textes du site.</p>

	<h3>Liens</h3>
	<p><a href="#">Ceci est un lien de test</a></p>

	<h3>Listes</h3>
	<ul>
		<li>Premier élément de la liste</li>
		<li>Deuxième élément de la liste</li>
		<li>Troisième élément de la liste</li>
	</ul>

	<ol>
		<li>Premier élément de liste ordonnée</li>
		<li>Deuxième élément de liste ordonnée</li>
		<li>Troisième élément de liste ordonnée</li>
	</ol>

	<h3>Buttons</h3>
	<?php get_template_part('template-parts/components/button', args: [
		'text' => 'Button primary',
		'type' => 'button',
		'variant' => 'primary',
		'cn' => 'ml-4',
	]); ?>

	<h3>Form Fields</h3>
	<h4>Inputs</h4>
	<?php
	get_template_part('template-parts/components/form-field', args: [
		'label' => 'Nom',
		'field' => 'input',
		'required' => true,
	]); ?>
	<h4>Textarea</h4>
	<?php
	get_template_part('template-parts/components/form-field', args: [
		'label' => 'Description',
		'field' => 'textarea',
		'required' => true,
	]); ?>

	<h4>Select</h4>
	<?php
	get_template_part('template-parts/components/form-field', args: [
		'label' => 'Choix',
		'field' => 'select',
		'choices' => [
			['value' => '1', 'label' => 'Choix 1'],
			['value' => '2', 'label' => 'Choix 2'],
			['value' => '3', 'label' => 'Choix 3'],
		],
		'placeholder' => 'Choisissez une option',
		'required' => true,
	]); ?>

	<h4>Checkbox</h4>
	<?php
	get_template_part('template-parts/components/form-field', args: [
		'label' => 'Accepter les conditions',
		'field' => 'checkbox',
		'required' => true,
	]); ?>






</div>

<?php get_footer(); ?>