<?php
get_header();

get_template_part('template-parts/partials/breadcrumbs');
?>
<div class="container-large flex">
	<div class="w-full md:w-1/2 space-y-2">
		<h1 class="text-3xl font-bold text-primary">TEAM construct s.a.</h1>
		<p class=""><?= get_field('adress'); ?></p>
		<?php
		if (have_rows('contacts')): ?>
			<ul>
				<?php while (have_rows('contacts')): the_row();
				?>
					<li class="text-primary"><?= get_sub_field('contact'); ?></li>
				<?php
				endwhile;
				?>
			</ul>
		<?php
		endif;
		?>
		<?php
		get_template_part('template-parts/components/button', args: [
			'text' => 'Nous contacter',
			'variant' => 'primary',
			'href' => '/contact',
			'cn' => '!mt-4'
		])
		?>
	</div>
	<div class="w-full md:w-1/2 space-y-2">
		<h2>Horaires d'ouverture:</h2>
		<p>
			<?= get_field('horaires'); ?>
		</p>
		<p>
			N'hésitez pas à nous contacter pour planifier votre visite !
		</p>
	</div>
</div>

<?php
get_footer();
