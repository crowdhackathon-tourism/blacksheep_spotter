<?= $this->Form->create($user) ?>
<div id="page-content">
	<section class="container">
		<div class="block">
			<div class="row">
				<div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
					<header>
						<h1 class="page-title">Register</h1>
					</header>
					<hr>
					<form role="form" id="form-register" method="post" action="?">
						<div class="form-group">
							 <?= $this->Form->input('email') ?>
						</div>
						<div class="form-group">
							<?= $this->Form->input('password') ?>
						</div>
						<div class="form-group clearfix">
							<?= $this->Form->button(__('Register'), ['class' => 'pull-right btn btn-default']); ?>
						</div>
					</form>
					<hr>
					<div class="center">
						<figure class="note" align="left">By clicking the "Register" button you agree with our <a href="#" class="link">Terms and conditions</a></figure>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?= $this->Form->end() ?>