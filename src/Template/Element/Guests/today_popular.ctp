<section>
	<h2>Today's popular</h2>
	<?php foreach($today_popular as $k=>$v): 
			if ( $k < 2 ):
	?>
		<a href="/place?item=<?=$v['id']?>" class="item-horizontal small">
			<h3><?=$v['name']?></h3>
			<figure><?=$v['address']?></figure>
			<div class="wrapper">
				<div class="image">
					<img class="tiny-image" src="<?="/files/item_images/".$v['item_images'][0]['image']?>" alt="" />
				</div>
				<div class="info">
					<div class="type">
						<i><img src="/assets/icons/<?=$v['item_main_category']['icon']?>" alt="" /></i>
						<span>Restaurant</span>
					</div>
					<div class="rating" data-rating="4"></div>
				</div>
			</div>
		</a>
	<?php endif; endforeach; ?>
</section>