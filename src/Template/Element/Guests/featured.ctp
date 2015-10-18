<section id="featured" class="block background-color-grey-dark equal-height">
	<div class="container">
		<header class="header-literal"><h2>Featured</h2></header>
		<div class="row">
		<?php foreach($featured as $v): ?>
			<div class="col-md-3 col-sm-3">
				<div class="item featured">
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
							<img class="main-image" src="<?="/files/item_images/".$v['item_images'][0]['image']?>" alt="" />
						</a>
					</div>
					<div class="wrapper">
						<a class="item-name" href="/place?item=<?=$v['id']?>"><h3><?=$v['name']?></h3></a>
						<figure class="item-address"><?=$v['address']?></figure>
						<div class="info">
							<div class="type">
								<i><img src="/assets/icons/<?=$v['item_main_category']['icon']?>" alt=""></i>
								<span class="item-main-category"><?=$v['item_main_category']['name']?></span>
							</div>
							<div class="rating" data-rating="4"></div>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
		</div>
	</div>
</section>