<?php $session = $this->request->session(); ?>
<div class="header">
	<div class="wrapper">
		<div class="brand">
			<a href="/">
				<img class="logo-img" src="/assets/img/black-sheep.png" alt="logo" />
				<span id="logo-literal"><?=$this->element('Guests/title')?></span>
			</a>
		</div>
		<nav class="navigation-items">
			<div class="wrapper">
				<ul class="user-area">
					<?php if ( !$session->check('Auth.User') ): ?>
						<li><a href="/Users/login">Sign In</a></li>
						<li><a href="/Users/register"><strong>Register</strong></a></li>
					<?php else: ?>
						<li><a href="/Users/profile"><b>Profile</b></a></li>
						<li><a href="/Users/logout">Sign Out</a></li>
					<?php endif; ?>
				</ul>
			</div>
		</nav>
	</div>
</div>	