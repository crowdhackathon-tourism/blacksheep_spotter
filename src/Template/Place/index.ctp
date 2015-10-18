<div id="json-item">
	<?=json_encode($item);?>
</div>

<div id="map-detail"></div>
<section class="container">
	<div class="row">
		<div class="col-md-9">
			<section class="block" id="main-content">
				<header class="page-title">
					<div class="title">
						<h1><?=$item['name']?></h1>
					</div>
					<div class="info">
						<div class="type">
							<i><img src="<?=$item['type_icon']?>" alt=""></i>
							<span><?=$item['category']?></span>
						</div>
					</div>
				</header>
				<div class="row">
					<aside class="col-md-4 col-sm-4" id="detail-sidebar">
						<section>
							<header><h3>Contact</h3></header>
							<address>
								<div><?=$item['address']?></div>
								<figure>
								<?php if ( strlen($item['tel']) > 9 ): ?>
									<div class="info">
										<i class="fa fa-phone"></i>
										<span><?=$item['tel']?></span>
									</div>
								<?php endif; ?>
								<?php if ( strlen($item['website']) > 9 ): ?>
									<div class="info website">
										<i class="fa fa-globe"></i>
										<a href="<?=$item['website']?>" target="_blank"><?=substr($item['website'], 0, 25)?>...</a>
									</div>
								<?php endif; ?>
								</figure>
							</address>
						</section>
						<section class="clearfix">
							<header class="pull-left"><a href="#reviews" class="roll"><h3>Rating</h3></a></header>
							<figure class="rating big pull-right" data-rating="<?=$item['item_review'][0]['rating']?>"></figure>
						</section>
						<section>
							<header><h3>Contact Form</h3></header>
							<figure>
								<form id="item-detail-form" role="form" method="post" action="?">
									<div class="form-group">
										<label for="item-detail-name">Name</label>
										<input type="text" class="form-control framed" id="item-detail-name" name="item-detail-name" required="">
									</div>
									<div class="form-group">
										<label for="item-detail-email">Email</label>
										<input type="email" class="form-control framed" id="item-detail-email" name="item-detail-email" required="">
									</div>
									<div class="form-group">
										<label for="item-detail-message">Message</label>
										<textarea class="form-control framed" id="item-detail-message" name="item-detail-message"  rows="3" required=""></textarea>
									</div>
									<div class="form-group">
										<button type="submit" class="btn framed icon">Send<i class="fa fa-angle-right"></i></button>
									</div>
								</form>
							</figure>
						</section>
					</aside>
					<div class="col-md-8 col-sm-8">
						<section>
							<article class="item-gallery">
								<div class="owl-carousel item-slider">
<div class="slide"><img src="/files/item_images/<?=$item['item_images'][0]['image']?>" data-hash="1" alt=""></div>
									<div class="slide"><img src="/assets/img/items/2.jpg" data-hash="2" alt=""></div>
									<div class="slide"><img src="/assets/img/items/3.jpg" data-hash="3" alt=""></div>
									<div class="slide"><img src="/assets/img/items/4.jpg" data-hash="4" alt=""></div>
									<div class="slide"><img src="/assets/img/items/5.jpg" data-hash="5" alt=""></div>
									<div class="slide"><img src="/assets/img/items/6.jpg" data-hash="6" alt=""></div>
									<div class="slide"><img src="/assets/img/items/7.jpg" data-hash="7" alt=""></div>
								</div>
								<div class="thumbnails">
									<span class="expand-content btn framed icon" data-expand="#gallery-thumbnails">More<i class="fa fa-plus"></i></span>
									<div class="expandable-content height collapsed show-70" id="gallery-thumbnails">
										<div class="content">
											<a href="#1" id="thumbnail-1" class="active"><img src="assets/img/items/1.jpg" alt=""></a>
											<a href="#2" id="thumbnail-2"><img src="/assets/img/items/2.jpg" alt=""></a>
											<a href="#3" id="thumbnail-3"><img src="/assets/img/items/3.jpg" alt=""></a>
											<a href="#4" id="thumbnail-4"><img src="/assets/img/items/4.jpg" alt=""></a>
											<a href="#5" id="thumbnail-5"><img src="/assets/img/items/5.jpg" alt=""></a>
											<a href="#6" id="thumbnail-6"><img src="/assets/img/items/6.jpg" alt=""></a>
											<a href="#7" id="thumbnail-7"><img src="/assets/img/items/7.jpg" alt=""></a>
										</div>
									</div>
								</div>
							</article>
							<article class="block">
								<header><h2>Description</h2></header>
								<p>
									<?php if ( !empty($item['description']) ){
										echo $item['description'];
									}?>
								</p>
							</article>
							<!-- /.block -->
							<article class="block">
								<header><h2>Daily Menu</h2></header>
								<div class="list-slider owl-carousel">
									<div class="slide">
										<header>
											<h3><i class="fa fa-calendar"></i>Monday (today)</h3>
										</header>
										<div class="list-item">
											<div class="left">
												<h4>Sunbed</h4>
												<figure>Book a Luxurious Sunbed</figure>
											</div>
											<div class="right">$10.50</div>
										</div>
										<!-- /.list-item -->
										<div class="list-item">
											<div class="left">
												<h4>Sunbed with a towel</h4>
												<figure>Book a luxurious Sunbed with a fresh towel</figure>
											</div>
											<div class="right">$3.60</div>
										</div>
										<!-- /.list-item -->
										<div class="list-item">
											<div class="left">
												<h4>Coffee Espresso</h4>
												<figure>One hell of a Espresso </figure>
											</div>
											<div class="right">$3.20</div>
										</div>
										<!-- /.list-item -->
									</div>
									<!-- /.slide -->
									<div class="slide">
										<header>
											<h3><i class="fa fa-calendar"></i>Tuesday</h3>
										</header>
										<div class="list-item">
											<div class="left">
												<h4>Chicken wings</h4>
												<figure>Curabitur odio nibh, luctus non pulvinar</figure>
											</div>
											<div class="right">$4.50</div>
										</div>
										<!-- /.list-item -->
										<div class="list-item">
											<div class="left">
												<h4>SunBed with Woven Towel</h4>
												<figure>Donec a odio rutrum, hendrerit sapien</figure>
											</div>
											<div class="right">$3.60</div>
										</div>
										<!-- /.list-item -->
										<div class="list-item">
											<div class="left">
												<h4>Nice salad with tuna, beans and hard-boiled egg</h4>
												<figure>Urabitur suscipit, justo eu dignissim lacinia </figure>
											</div>
											<div class="right">$1.20</div>
										</div>
										<!-- /.list-item -->
									</div>
									<!-- /.slide -->
								</div>
								<!-- /.list-slider -->
							</article>
							<!-- /.block -->
							<article class="block">
								<header><h2>Features</h2></header>
								<ul class="bullets">
									<li>Free Parking</li>
									<li>Cards Accepted</li>
									<li>Wi-Fi</li>
									<li>Air Condition</li>
									<li>Reservations</li>
									<li>Teambuildings</li>
									<li>Places to seat</li>
									<li>Winery</li>
									<li>Draft Beer</li>
									<li>LCD</li>
									<li>Saloon</li>
									<li>Free Access</li>
									<li>Terrace</li>
									<li>Minigolf</li>
								</ul>
							</article>
							<!-- /.block -->
							<article class="block">
								<header><h2>Opening Hours</h2></header>
								<dl class="lines">
									<dt>Monday</dt>
									<dd>08:00 am - 11:00 pm</dd>
									<dt>Tuesday</dt>
									<dd>08:00 am - 11:00 pm</dd>
									<dt>Wednesday</dt>
									<dd>08:00 am - 11:00 pm</dd>
									<dt>Thursday</dt>
									<dd>08:00 am - 11:00 pm</dd>
									<dt>Friday</dt>
									<dd>08:00 am - 11:00 pm</dd>
									<dt>Saturday</dt>
									<dd>08:00 am - 11:00 pm</dd>
								</dl>
							</article>
							<!-- /.block -->
						</section>
						<!--Reviews-->
						<section class="block" id="reviews">
							<header class="clearfix">
								<h2 class="pull-left">Reviews</h2>
								<a href="#write-review" class="btn framed icon pull-right">Write a review <i class="fa fa-pencil"></i></a>
							</header>
							<article class="clearfix overall-rating">
								<strong class="pull-left">Over Rating</strong>
								<figure class="rating big color pull-right" data-rating="4"></figure>
							</article>
							<section class="reviews">
								<article class="review">
									<figure class="author">
										<img src="assets/img/default-avatar.png" alt="">
										<div class="date">12.05.2014</div>
									</figure>
									<!-- /.author-->
									<div class="wrapper">
										<h5>Catherine Brown</h5>
										<figure class="rating big color" data-rating="4"></figure>
										<p>
											Amazing Service. Very good place. We have wonderful time.
										</p>
										<div class="individual-rating">
											<span>Value</span>
											<figure class="rating" data-rating="4"></figure>
										</div>
										<!-- /.user-rating -->
										<div class="individual-rating">
											<span>Service</span>
											<figure class="rating" data-rating="4"></figure>
										</div>
										<!-- /.user-rating -->
									</div>
									<!-- /.wrapper-->
								</article>
								<!-- /.review -->
								<article class="review">
									<figure class="author">
										<img src="assets/img/default-avatar.png" alt="">
										<div class="date">10.05.2014</div>
									</figure>
									<!-- /.author-->
									<div class="wrapper">
										<h5>John Doe</h5>
										<figure class="rating big color" data-rating="5"></figure>
										<p>
											This place is one of the best I have ever visited in my life.
											The service is remarkable and we are very satsfied with them.
										</p>
										<div class="individual-rating">
											<span>Value</span>
											<figure class="rating" data-rating="5"></figure>
										</div>
										<!-- /.user-rating -->
										<div class="individual-rating">
											<span>Service</span>
											<figure class="rating" data-rating="5"></figure>
										</div>
										<!-- /.user-rating -->
									</div>
									<!-- /.wrapper-->
								</article>
								<!-- /.review -->
							</section>
							<!-- /.reviews-->
						</section>
					</div>
				</div>
			</section>
		</div>
		<div class="col-md-3">
			<aside id="sidebar">
				<section>
					<header><h2>Categories</h2></header>
					<ul class="bullets">
						<li><a href="#" >Restaurant</a></li>
						<li><a href="#" >Steak House & Grill</a></li>
						<li><a href="#" >Fast Food</a></li>
						<li><a href="#" >Breakfast</a></li>
						<li><a href="#" >Winery</a></li>
						<li><a href="#" >Bar & Lounge</a></li>
						<li><a href="#" >Pub</a></li>
					</ul>
				</section>
				<section>
					<header><h2>Special Actions</h2></header>
					<div class="form-group">
						 <ul class="bullets special-actions">
                            <?php if ( $item['category'] == 'Hotel' ): ?>
                            	<li><a href="http://54.149.218.100/WebBooking/iraHotel">Book a Room</a></li>
                            
                             <?php elseif ( $item['category'] == 'Restaurant' ): ?>
                            	<li><a href="#">Book a Table</a></li>
                            	<li><a href="#">Delivery</a></li>
                            
                            <?php elseif ( $item['category'] == 'Restaurant' ): ?>
                            	<li><a href="#">Book a Table</a></li>
                            	<li><a href="#">Delivery</a></li>
                            	
                              <?php elseif ( $item['category'] == 'Transporation' ): ?>
                            	<li><a href="#">Book a Taxi</a></li>
                           	 	<li><a href="#">Book a Shuttle Bus</a></li>
                           	 	
                           	 <?php elseif ( $item['category'] == 'Recreation' ): ?>
                            	<li><a href="/Place/watersport1">Book a Water Sport</a></li>
                            	<li><a href="/Place/sunbed1">Book a Sunbed</a></li>
                            	<li><a href="#">Book a Ticket</a></li>
                            
                            <?php endif; ?>
                        </ul>
					</div>
				</section>
			</aside>
		</div>
	</div>
</section>

<input type="hidden" id="lat" name="lat" value="<?=$item['lat'] ?>" />
<input type="hidden" id="lon" name="lon" value="<?=$item['lon'] ?>" />
