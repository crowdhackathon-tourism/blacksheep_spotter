<section class="new-items-container col-xs-12 col-lg-8 col-lg-offset-2">
	<?= $this->element('Users/header') ?>
	<div class="row">
		<div class="col-md-8">
			<form id="form-submit" role="form" method="post" action="" enctype="multipart/form-data">
			
				<section class="item-tags">
				<h3><b>What type of business do you own</b></h3>
					<div class="main-category-tag-wrap">
						<?php foreach($main_categories as $cat): ?>
							<span data-parent="<?=$cat['id']?>" class="category-tag"><?=$cat['name']?><i class="fa fa-check-square tag-inactive"></i></span>
						<?php endforeach; ?>
					</div>
					<hr/>
					<div class="sub-category-tag-wrap">
						<?php foreach($sub_categories as $cat): ?>
							<span class="sub-category-tag" data-parent="<?=$cat['parent_category']?>"><?=$cat['name']?><i class="fa fa-check-square tag-inactive"></i></span>
						<?php endforeach; ?>
					</div>
					
				</section>
				
				<section>
					<div class="form-group large">
						<label for="title">Title</label>
						<input type="text" class="form-control" id="title" name="title">
					</div>
				</section>
				
				<section>
					<h3>Location & Contact</h3>
					<div class="row">
						<div class="col-md-4 col-sm-4">
							<div class="form-group">
								<label for="state">Country</label>
								<?=$this->element('Guests/countries')?>
							</div>
						</div>
						<div class="col-md-4 col-sm-4">
							<div class="row">
								<div class="col-md-8 col-sm-8">
									<div class="form-group">
										<label for="city">City</label>
										<input type="text" class="form-control" id="city" name="city">
									</div>
								</div>
								<div class="col-md-4 col-sm-4">
									<div class="form-group">
										<label for="zip">Postal</label>
										<input type="text" class="form-control" id="zip" name="zip" pattern="\d*">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-4">
							<div class="form-group">
								<label for="street">Street</label>
								<input type="text" class="form-control" id="street" name="street">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 col-sm-4">
							<div class="form-group">
								<label for="phone-number">Phone Number</label>
								<input type="text" class="form-control" id="phone-number" name="phone-number" pattern="\d*">
							</div>
						</div>
						<div class="col-md-4 col-sm-4">
							<div class="form-group">
								<label for="email">E-mail</label>
								<input type="email" class="form-control" id="email" name="email">
							</div>
						</div>
						<div class="col-md-4 col-sm-4">
							<div class="form-group">
								<label for="website">Website</label>
								<input type="text" class="form-control" id="website" name="website">
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-4 col-sm-4">
							<div class="form-group">
								<label for="mobile">Mobile Number</label>
								<input type="text" class="form-control" id="mobile" name="mobile">
							</div>
						</div>
						
						<div class="col-md-4 col-sm-4">
							<div class="form-group">
								<label for="facebook">Facebook Page</label>
								<input type="text" class="form-control" id="facebook" name="facebook">
							</div>
						</div>
					</div>
					
					
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
							<label for="website">Describe your business</label>
								<textarea class="form-control" rows="4" cols="8"></textarea>
							</div>
						</div>
					</div>
					
				</section>
				
				<section>
					<h3><b>Where is your business located</b></h3>
					<div id="map-simple"></div>
				</section>
				<section>
					<h3><b>Gallery</b></h3>
					<div id="file-submit" class="dropzone">
						<input name="file" type="file" multiple>
						<div class="dz-default dz-message"><span>Click or Drop Images Here</span></div>
					</div>
				</section>
				<section>
					<h3><b>Opening Hours</b></h3>
					<div class="opening-hours">
						<div class="table-responsive">
							<table class="table">
								<tbody>
								<tr class="day">
									<td class="day-name">Monday</td>
									<td class="from"><input class="oh-timepicker" type="text" placeholder="From" name="open-hour-from[]"></td>
									<td class="to"><input class="oh-timepicker" type="text" placeholder="To" name="open-hour-to[]"></td>
									<td class="non-stop"><div class="checkbox">
										<label>
											<input type="checkbox">Non-stop
										</label>
									</div>
									</td>
								</tr>
								<tr class="day">
									<td class="day-name">Tuesday</td>
									<td class="from"><input class="oh-timepicker" type="text" placeholder="From" name="open-hour-from[]"></td>
									<td class="to"><input class="oh-timepicker" type="text" placeholder="To" name="open-hour-to[]"></td>
									<td class="non-stop"><div class="checkbox">
										<label>
											<input type="checkbox">Non-stop
										</label>
									</div>
									</td>
								</tr>
								<tr class="day">
									<td class="day-name">Wednesday</td>
									<td class="from"><input class="oh-timepicker" type="text" placeholder="From" name="open-hour-from[]"></td>
									<td class="to"><input class="oh-timepicker" type="text" placeholder="To" name="open-hour-to[]"></td>
									<td class="non-stop"><div class="checkbox">
										<label>
											<input type="checkbox">Non-stop
										</label>
									</div>
									</td>
								</tr>
								<tr class="day">
									<td class="day-name">Thursday</td>
									<td class="from"><input class="oh-timepicker" type="text" placeholder="From" name="open-hour-from[]"></td>
									<td class="to"><input class="oh-timepicker" type="text" placeholder="To" name="open-hour-to[]"></td>
									<td class="non-stop"><div class="checkbox">
										<label>
											<input type="checkbox">Non-stop
										</label>
									</div>
									</td>
								</tr>
								<tr class="day">
									<td class="day-name">Friday</td>
									<td class="from"><input class="oh-timepicker" type="text" placeholder="From" name="open-hour-from[]"></td>
									<td class="to"><input class="oh-timepicker" type="text" placeholder="To" name="open-hour-to[]"></td>
									<td class="non-stop"><div class="checkbox">
										<label>
											<input type="checkbox">Non-stop
										</label>
									</div>
									</td>
								</tr>
								<tr class="day weekend">
									<td class="day-name">Saturday</td>
									<td class="from"><input class="oh-timepicker" type="text" placeholder="From" name="open-hour-from[]"></td>
									<td class="to"><input class="oh-timepicker" type="text" placeholder="To" name="open-hour-to[]"></td>
									<td class="non-stop"><div class="checkbox">
										<label>
											<input type="checkbox">Non-stop
										</label>
									</div>
									</td>
								</tr>
								<tr class="day weekend">
									<td class="day-name">Sunday</td>
									<td class="from"><input class="oh-timepicker" type="text" placeholder="From" name="open-hour-from[]"></td>
									<td class="to"><input class="oh-timepicker" type="text" placeholder="To" name="open-hour-to[]"></td>
									<td class="non-stop"><div class="checkbox">
										<label>
											<input type="checkbox">Non-stop
										</label>
									</div>
									</td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
				</section>
				<hr>
				<section>
					<figure class="pull-left margin-top-15">
						<p>By clicking "Submit & Pay" button you agree with <a href="#" class="link">Terms & Conditions</a></p>
					</figure>
					<div class="form-group">
						<button type="submit" class="btn btn-default pull-right" disabled="disabled" id="submit">Submit & Pay</button>
					</div>
				</section>
			</form>
		</div>
		
		<div class="col-md-4 integration-sidebar">
			<aside id="sidebar">
				<div class="sidebar-box">
					<h3>Integration</h3>
					<ul class="bullets">
						<?php foreach($main_categories as $v): ?>
							<li><b><?=$v['name']?></b></li>
							<ul class="squares">
								<?php foreach($v['integration'] as $i): ?>
									<li><?=$i['bname']?></li>
								<?php endforeach; ?>
							</ul>
						<?php endforeach; ?>
					</ul>
				</div>
			</aside>
		</div>
		
		<div class="col-md-4 payment-package-sidebar">
			<aside id="sidebar">
				<div class="sidebar-box">
					<h3>Payment</h3>
					<div class="form-group">
						<label for="package">Your Package</label>
						<select name="package" id="package" class="framed">
							<option value="">Select your package</option>
							<option value="1">Free</option>
							<option value="2">Silver</option>
							<option value="3">Gold</option>
							<option value="4">Platinum</option>
						</select>
					</div>
					<h4>This package includes</h4>
					<ul class="bullets">
						<li>1 Property</li>
						<li>1 Agent Profile</li>
						<li class="disabled">Agency Profile</li>
						<li class="disabled">Featured Properties</li>
					</ul>
				</div>
			</aside>
		</div>
	</div>
</section>