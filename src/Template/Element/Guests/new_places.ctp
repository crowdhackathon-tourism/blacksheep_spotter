<section id="new-places">
	<header><h2>New Places</h2></header>
	<?php foreach($new_items as $v): ?>
	<a href="/place?item=<?=$v['id']?>" class="item-horizontal small">
		<h3><?=$v['name']?></h3>
		<figure><?=$v['description']?></figure>
		<div class="wrapper">
			<div class="image"><img src="/assets/img/items/1.jpg" alt=""></div>
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