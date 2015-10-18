<section>
	<h2>Recent Reviews</h2>
	<?php foreach($recent_review_items as $v): ?>
	<a href="/place?item=<?=$v['id']?>" class="review small">
		<h3><?=$v['name']?></h3>
		<figure><?=$v['address']?></figure>
		<div class="info">
			<div class="rating" data-rating="<?=$v['item_review'][0]['rating']?>"></div>
			<div class="type">
				<i><img src="/assets/icons/<?=$v['item_main_category']['icon']?>" alt=""></i>
				<span><?=$v['item_main_category']['name']?></span>
			</div>
		</div>
		<p><?=$v['description']?></p>
	</a>
<?php endforeach; ?>
</section>