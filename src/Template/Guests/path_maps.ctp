<section id="place-route">
	<div class="row">
		<div class="col-xs-12">
			<h2 class="path-description"><?=$path['description']?></h2>
			<div data-path="<?=$path['path']?>" class="map-path" id="map-path"></div>
		</div>
	</div>
</section>


<?= $this->element('Guests/featured') ?>

<?= $this->element('Guests/popular') ?>

<?= $this->element('Guests/various') ?>

<?= $this->element('Guests/footer') ?>