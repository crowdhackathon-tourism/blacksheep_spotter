<section id="popular" class="block background-color-white">
	<div class="container">
		<header><h2 class="header-literal">Popular</h2></header>
		<div class="owl-carousel wide carousel">
			<?php foreach($popular as $v): ?>
			<div class="slide">
				<div class="inner">
					<div class="image">
						<div class="item-specific">
							<div class="inner">
								<div class="content">
									<dl>
										<dt>Bedrooms</dt>
										<dd>2</dd>
										<dt>Bathrooms</dt>
										<dd>2</dd>
										<dt>Area</dt>
										<dd>240m<sup>2</sup></dd>
										<dt>Garages</dt>
										<dd>1</dd>
										<dt>Build Year</dt>
										<dd>1990</dd>
									</dl>
								</div>
							</div>
						</div>
						<img class="popular-image" src="<?="/files/item_images/".$v['item_images'][0]['image']?>" alt="" />
					</div>
					<div class="wrapper">
						<a href="/place?item=<?=$v['id']?>"><h3><?=$v['name']?></h3></a>
						<figure>
							<i class="fa fa-map-marker"></i>
							<span><?=$v['address']?></span>
						</figure>
						<div class="info">
							<div class="rating" data-rating="4">
								<aside class="reviews">6 reviews</aside>
							</div>
							<div class="type">
								<i><img src="/assets/icons/<?=$v['item_main_category']['icon']?>" alt=""></i>
								<span><?=$v['item_main_category']['name']?></span>
							</div>
						</div>
						<p><?=$v['description']?>
						</p>
						<a href="/place?item=<?=$v['id']?>" class="read-more icon">Read More</a>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>