<section id="place-experience">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="experience-title">Discover ΠΑΤΜΟΣ</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-9 col-lg-6">
		  <ul class="nav nav-tabs nav-tabs-responsive" role="tablist">
		  	<?php foreach($place_descriptions as $k=>$v):
		  		$class = '';
		  		if ( $k == 0 ){
		  			$class = 'active';
		  		}
		  	?>
		    	<li role="presentation" class="<?=$class?>">
		    		<a href="<?='#'.$v['section_alias']?>" aria-controls="<?=$v['section_alias']?>" role="tab" data-toggle="tab"><?=$v['section']?></a>
		    	</li>
		    <?php endforeach; ?>
			  <li role="presentation">
			  	<a href="#paths" aria-controls="paths" role="tab" data-toggle="tab">Μονοπάτια</a>
			  </li>
		  </ul>
		  <div class="tab-content">
			  	<?php foreach($place_descriptions as $k=>$v):
				  	$class = '';
				  	if ( $k == 0 ){
				  		$class = 'in active';
				  	}
			  	?>
		    	<div role="tabpanel" class="col-xs-12 tab-pane fade <?=$class?>" id="<?=$v['section_alias']?>"><?=$v['description']?></div>
		  		<?php endforeach; ?>
		  		<div role="tabpanel" class="col-xs-12 tab-pane fade" id="paths">
			  		<div class="row routes-wrap">
						<?php foreach($place_paths as $k=>$v): 
							$src = '/files/place_images/'.$v['place_id'].'/'.$v['image'];
						?>
						<div class="col-xs-6 paths-wrap">
							<a href="/Guests/pathMaps?path=<?=$v['id']?>">
								<h2 class="path-description"><?=$v['description']?></h2>
								<img class="path-image" src="<?=$src?>" />
							</a>
						</div>
						<?php endforeach; ?>
					</div>
		  	</div>
		  </div>
		</div>
	</div>
</section>





