<section class="container">
	<?= $this->element('Users/header') ?>
	<div class="row">

		<div class="col-sm-2">
			<aside id="sidebar">
				<ul class="navigation-sidebar list-unstyled">
					<li class="active">
						<a href="#">
							<i class="fa fa-folder"></i>
							<span>All Items</span>
						</a>
					</li>
					<li>
						<a href="#">
							<i class="fa fa-eye-slash"></i>
							<span>By Type</span>
						</a>
					</li>
					<li>
						<a href="#">
							<i class="fa fa-check"></i>
							<span>Approved</span>
						</a>
					</li>
					<li>
						<a href="#">
							<i class="fa fa-clock-o"></i>
							<span>In Queue</span>
						</a>
					</li>
				</ul>
			</aside>
		</div>
		<div class="col-sm-10">
			<section id="items">
			<?php foreach($my_items as $k=>$v): ?>
				<div class="item list admin-view">
					<div class="image">
						<div class="quick-view" data-toggle="modal" data-target="#modal-bar"><i class="fa fa-eye"></i><span>Quick View</span></div>
						<?php 
							$link = '#';
							if ($v['main_category'] == 2 ){
								$link = 'http://54.149.218.100/?hackathon';
							}
						?>
						<a target="_blank" href="<?=$link?>">
							<div class="overlay">
								<div class="inner">
									<div class="content">
										<h4>Description</h4>
										<p><?=$v['description']?></p>
									</div>
								</div>
							</div>
							<div class="item-specific">
								<span>Daily menu: <?=($k+1)?> &euro; </span>
							</div>
							<img src="/assets/img/items/2.jpg" alt="">
						</a>
					</div>
					<div class="wrapper">
						<a target="_blank" href="<?=$link?>">
							<h3><?=$v['name']?></h3>
						</a>
						<figure><?=$v['address']?></figure>
						<div class="info">
							<div class="type">
								<i><img src="<?=$v['type_icon']?>" alt=""></i>
								<span><?=$v['category']?></span>
							</div>
							<div class="rating" data-rating="<?=$v['item_review'][0]['rating']?>"></div>
						</div>
					</div>
					<div class="description">
						<ul class="list-unstyled actions">
							<li><a href="#"><i class="fa fa-pencil"></i></a></li>
							<li><a href="#" class="hide-item"><i class="fa fa-eye"></i></a></li>
							<li><a href="#"><i class="fa fa-trash"></i></a></li>
						</ul>
					</div>
					<div class="ribbon in-queue">
						<i class="fa fa-clock-o"></i>
					</div>
				</div>
				<?php endforeach; ?>
			</section>
		</div>
	</div>
</section>
