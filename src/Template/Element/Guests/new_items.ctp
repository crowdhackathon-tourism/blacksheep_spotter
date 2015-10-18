<section>
	<h2>New Items</h2>
	<?php foreach($new_items as $v): ?>
		<a href="/place?item=<?=$v['id']?>" class="item-horizontal small">
			<h3><?=$v['name']?></h3>
			<figure><?=$v['address']?></figure>
			<div class="wrapper">
				<div class="image">
					<img class="tiny-image" src="<?="/files/item_images/".$v['item_images'][0]['image']?>" alt="" />
				</div>
				<div class="info">
					<div class="type">
						<i><img src="/assets/icons/<?=$v['item_main_category']['icon']?>" alt=""></i>
						<span><?=$v['item_main_category']['name']?></span>
					</div>
					<div class="rating" data-rating="4"></div>
				</div>
			</div>
		</a>
	<?php endforeach; ?>
</section>