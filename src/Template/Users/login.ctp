<?= $this->Flash->render('auth') ?>
<?= $this->Form->create() ?>
<section class="container">
	<div class="block">
		<div class="row">
			<div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
				<header>
					<h1 class="page-title">Sign In</h1>
				</header>
				<hr>
				<div class="form-group">
					<?= $this->Form->input('email') ?>
				</div>
				<div class="form-group">
					<?= $this->Form->input('password') ?>
				</div>
				<div class="form-group clearfix">
					<?= $this->Form->button(__('Sign In'), ['class'=>'btn btn-default pull-right']); ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?= $this->Form->end() ?>