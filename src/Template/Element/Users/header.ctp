<header>
	<ul class="nav nav-pills">
		<li class="<?=(stripos($this->request->here, 'profile') !== FALSE  ? 'active' : '')?>">
			<a href="/Users/profile"><h1 class="page-title">My Profile</h1></a>
		</li>
		<li class="<?=(stripos($this->request->here, 'businesses') !== FALSE  ? 'active' : '')?>">
			<a href="/Users/businesses"><h1 class="page-title">My Businesses</h1></a>
		</li>
		<li class="<?=(stripos($this->request->here, 'newBusiness') !== FALSE  ? 'active' : '')?>">
			<a href="/Users/newBusiness"><h1 class="page-title">Add a new business</h1></a>
		</li>
	</ul>
</header>