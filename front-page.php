<?php get_header(); ?>

<section class="w-full h-[70vh] md:h-[682px] " style="background-image: url('<?= get_field('hero')['image']; ?>')">
	<div class="h-full container-large flex flex-col justify-center text-white space-y-4">
		<h1 class="text-2xl md:text-6xl font-bold text-white"><?= get_field('hero')['title']; ?></h1>
		<p class="text-lg"><?= get_field('hero')['description']; ?></p>
		<div class="flex flex-col md:flex-row items-center gap-4">
			<a href="/contact" class="text-sm px-4 py-2 bg-black/30 rounded-full font-medium flex items-center gap-2">
				<i class="fa-solid fa-house text-xs"></i>
				Appartements
			</a>
			<a href="/contact" class="text-sm px-4 py-2 bg-black/30 rounded-full font-medium flex items-center gap-2">
				<i class="fa-solid fa-house-chimney text-xs"></i>
				Maisons
			</a>
			<a href="/contact" class="text-sm px-4 py-2 bg-black/30 rounded-full font-medium flex items-center gap-2">
				<i class="fa-solid fa-building text-xs"></i>
				Immeubles
			</a>
		</div>
	</div>
</section>
<?php
$informations = get_field('informations');
?>
<section class="container-large py-16 flex flex-col-reverse md:flex-row items-center gap-20">
	<div class="shrink-0 grow-0 w-44">
		<img src="<?= $informations['image']; ?>" alt="Image de présentation" class="w-full h-auto" />
	</div>
	<div class="space-y-2">
		<h2><?= $informations['title']; ?></h2>
		<p>
			<?= $informations['paragraph']; ?>
		</p>
		<?php
		get_template_part('template-parts/components/button', args: [
			'text' => 'Voir le catalogue',
			'variant' => 'primary',
			'cn' => '!mt-4'
		])
		?>
	</div>
</section>
<?php get_footer(); ?>