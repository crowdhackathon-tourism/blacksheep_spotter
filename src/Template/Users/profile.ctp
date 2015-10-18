<section class="container">
	<?= $this->element('Users/header') ?>
	<div class="row">
		<div class="col-md-9">
			<?= $this->Form->create() ?>
				<div class="row">
					<div class="col-md-3 col-sm-3">
						<section>
							<h3><i class="fa fa-image"></i>Profile Picture</h3>
							<div id="profile-picture" class="profile-picture dropzone">
								<input name="file" type="file">
								<div class="dz-default dz-message"><span>Click or drop picture here</span></div>
								<img src="/assets/img/member-2.jpg" alt="">
							</div>
						</section>
					</div>
					<div class="col-md-9 col-sm-9">
						<section>
							<h3><i class="fa fa-user"></i>Personal Info</h3>
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label for="name">Name</label>
										<input type="text" class="form-control" id="name" name="name" value="<?=(isset($user['full_name']) ? $user['full_name'] : '')?>" />
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label for="email">Email</label>
										<input type="email" class="form-control" id="email" name="email" value="<?=$user['email']?>" />
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label for="mobile">Mobile</label>
										<input type="text" class="form-control" id="mobile" name="mobile" pattern="\d*" value="<?=(isset($user['mobile']) ? $user['mobile'] : '')?>" />
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label for="phone">Phone</label>
										<input type="text" class="form-control" id="phone" name="phone" pattern="\d*" value="<?=(isset($user['tel']) ? $user['tel'] : '')?>" />
									</div>
								</div>
							</div>
						</section>
						<section>
							<h3><i class="fa fa-map-marker"></i>Location</h3>
							<div class="form-group">
								<label for="address">Address</label>
								<input type="text" class="form-control" id="address" name="address" value="<?=(isset($user['address']) ? $user['address'] : '')?>" />
								
							</div>
							<div class="row">
								<div class="col-md-8 col-sm-8">
									<div class="form-group">
										<label for="city">City</label>
										<input type="text" class="form-control" id="city" name="city" value="<?=(isset($user['city']) ? $user['city'] : '')?>" />
									</div>
								</div>
								<div class="col-md-4 col-sm-4">
									<div class="form-group">
										<label for="zip">Postal</label>
										<input type="text" class="form-control" id="zip" name="zip" pattern="\d*" value="<?=(isset($user['zip']) ? $user['zip'] : '')?>" />
									</div>
								</div>
							</div>
						</section>
						<section>
							<h3><i class="fa fa-info-circle"></i>About Me</h3>
							<div class="form-group">
								<div class="form-group">
									<textarea class="form-control" id="about-me" rows="3" name="about-me" required></textarea>
								</div>
							</div>
						</section>
						<div class="form-group">
							<?= $this->Form->button(__('Save changes'), ['class'=>'btn btn-default', 'disabled'=>'disabled']) ?>
						</div>
					</div>
				</div>
			<?= $this->Form->end() ?>
		</div>
		<div class="col-md-3 col-sm-9">
			<h3><i class="fa fa-asterisk"></i>Password Change</h3>
			<form class="framed" id="form-password" role="form" method="post" action="?" >
				<div class="form-group">
					<label for="current-password">Current Password</label>
					<input type="password" class="form-control" id="current-password" name="current-password">
				</div>
				<div class="form-group">
					<label for="new-password">New Password</label>
					<input type="password" class="form-control" id="new-password" name="new-password">
				</div>
				<div class="form-group">
					<label for="confirm-new-password">Confirm New Password</label>
					<input type="password" class="form-control" id="confirm-new-password" name="confirm-new-password">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-default" disabled="disabled">Change Password</button>
				</div>
			</form>
		</div>
	</div>
</section>