<section class="hero-image search-form">
	<div class="inner row">
		<div class="row search-container">
			<h1 class="header-main-title col-xs-10 col-xs-offset-1 col-sm-7 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-8 col-lg-offset-2">Discover your place</h1>
			<div class="search-bar horizontal">
				<form class="main-search" role="form" method="post" action="search">
					<div class="input-row">
						<!--  
						<div class="form-group col-xs-12 col-sm-3 col-md-3">
							<input type="text" class="form-control" name="keyword" id="keyword" placeholder="Enter Keyword">
						</div> 
						-->
						<div class="form-group col-xs-8 col-sm-9 col-md-9">
							<div class="input-group location">
								<input type="text" class="form-control" id="location" name="location" placeholder="Enter Location" autocomplete="off">
								<span class="input-group-addon">
									<i class="fa fa-map-marker geolocation" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Find my position"></i>
								</span>
							</div>
						</div>
						<!--  
						<div class="form-group select-category col-xs-12 col-sm-3 col-md-3">
							<select name="category" multiple="" title="Select Category">
								<option value="1">Stay</option>
								<option value="2" class="sub-category">Hotels</option>
								<option value="3" class="sub-category">Appartments</option>
								<option value="4">Eat</option>
								<option value="5">Restaurants &amp; Bars</option>
								<option value="6" class="sub-category">Vegetarian</option>
								<option value="70">Move</option>
								<option value="8" class="sub-category">Taxi</option>
								<option value="9" class="sub-category">Public transporation</option>
								<option value="10">Recreation</option>
								<option value="11" class="sub-category">Water sports</option>
								<option value="12" class="sub-category">Beaches</option>
							</select> 
						</div> 
						-->
						<div class="form-group col-xs-4 col-sm-3 col-md-3 submit-wrap">
							<button id="search-submit" name="search-submit" type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
						</div>
					</div>
					<input type="hidden" id="lat" name="lat" />
					<input type="hidden" id="lon" name="lon" />
					<input type="hidden" id="action" name="action" />
				</form>
			</div>
			<?= $this->Flash->render('no_results'); ?>
		</div>
	</div>
</section>
