<div class="map-canvas list-width-40">
	<div class="map">
		<div id="map" class="has-parallax"></div>
	</div>
	<div id="json-search-results">
		<?=json_encode($search_results);?>
	</div>
	<div class="search-filters-container">
		<span class="search-filter search-filter-active" name="distance">Near me</span>
		<span class="search-filter" name="price">Price</span>
		<span class="search-filter" name="rating">Rating</span>
	</div>	
	<div class="items-list">
		<div class="inner results-wrap">
			<div class="scroll">
				<ul class="results list"></ul>
			</div>
		</div>
	</div>
</div>

<?= $this->element('Guests/four_actions') ?>

<?= $this->element('Guests/featured') ?>

<?= $this->element('Guests/popular') ?>

<?= $this->element('Guests/various') ?>

<?= $this->element('Guests/footer') ?>

<input type="hidden" id="lat" name="lat" value="<?=$latitude ?>" />
<input type="hidden" id="lon" name="lon" value="<?=$longitude ?>" />