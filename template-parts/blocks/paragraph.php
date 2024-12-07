<div class="py-16 flex  gap-8 items-center <?= get_field('align') === 'right' ? 'flex-row-reverse' : 'flex-row' ?> ">
	<div class="w-1/2 grow-0">
		<img src="<?= get_field('image'); ?>" alt="" class="w-full min-h-full" />
	</div>
	<div class="w-1/2 space-y-2">
		<h2 class="text-primary"><?= get_field('title'); ?></h2>
		<p><?= get_field('content'); ?></p>
	</div>
</div>