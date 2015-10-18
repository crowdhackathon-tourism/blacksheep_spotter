<header class="header-literal"><h2>Popular Listings</h2></header>
<div class="row">
	<?php foreach($popular_listings as $v): ?>
		<div class="col-md-4 col-sm-4">
			<div class="item">
				<div class="image">
					<div class="quick-view"><i class="fa fa-eye"></i><span>Quick View</span></div>
					<a href="/place?item=<?=$v['id']?>">
						<div class="overlay">
							<div class="inner">
								<div class="content">
									<h4>Description</h4>
									<p class="item-description"><?=$v['description']?></p>
								</div>
							</div>
						</div>
						<div class="item-specific">
							<span title="Bedrooms"><img src="/assets/img/bedrooms.png" alt="">2</span>
							<span title="Bathrooms"><img src="/assets/img/bathrooms.png" alt="">2</span>
							<span title="Area"><img src="/assets/img/area.png" alt="">240m<sup>2</sup></span>
							<span title="Garages"><img src="/assets/img/garages.png" alt="">1</span>
						</div>
						<div class="icon">
							<i class="fa fa-thumbs-up"></i>
						</div>
						<img class="main-image" src="<?="/files/item_images/".$v['item_images'][0]['image']?>" alt="" />
					</a>
				</div>
				<div class="wrapper">
					<a href="/place?item=<?=$v['id']?>"><h3 class="item-name"><?=$v['name']?></h3></a>
					<figure class="item-address"><?=$v['address']?></figure>
					<div class="info">
						<div class="type">
							<i><img src="/assets/icons/<?=$v['item_main_category']['icon']?>" alt=""></i>
							<span>Restaurant</span>
						</div>
						<div class="rating" data-rating="4"></div>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>