<section class="block equal-height background-color-grey-light">
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				
				<?= $this->element('Guests/popular_listings') ?>	
			
				<?= $this->element('Guests/recent') ?>	
			
			</div>
			
			<div class="col-md-3">
				<aside id="sidebar">
					<?= $this->element('Guests/new_places') ?>	
					
					<?= $this->element('Guests/side_categories') ?>	
					
					<section id="location-experience">
						<header><h2>Experience</h2></header>
						<div class="form-group">
							<select class="framed" name="events">
								<option value="">Select Your City</option>
								<option value="1">Patmos</option>
							</select>
						</div>
					</section>
				</aside>
			</div>
		</div>
	</div>
</section>

<?= $this->element('Guests/subscribe') ?>	