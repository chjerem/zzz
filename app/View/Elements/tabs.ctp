<ul class="nav nav-tabs">
	<li role="presentation"><a href="#">Home</a></li>
	<li role="presentation" class="active"><a href="#">Profile</a></li>
	<li role="presentation"><a href="#">Messages</a></li>
	<li role="presentation"><a href="#">Messages</a></li>
	<li role="presentation"><a href="#">Messages</a></li>
	<li role="presentation"><a href="#">Messages</a></li>
	<li role="presentation"><a href="#">Messages</a></li>
	<li role="presentation"><a href="#">Messages</a></li>
	<li role="presentation"><a href="#">Messages</a></li>
	<li role="presentation"><a href="#">Messages</a></li>
	<li role="presentation"><a href="#">Messages</a></li>
	<li role="presentation"><a href="#">Messages</a></li>
	<li role="presentation"><a href="#">Messages</a></li>
	<li role="presentation"><a href="#">Messages</a></li>
	<li role="presentation"><a href="#">Messages</a></li>
	<li role="presentation"><a href="#">Messages</a></li>
	<li role="presentation" class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
			Dropdown <span class="caret"></span>
		</a>
		<ul class="dropdown-menu">
			<li><a href="#">Action</a></li>
			<li><a href="#">Another action</a></li>
			<li><a href="#">Something else here</a></li>
			<li role="separator" class="divider"></li>
			<li><a href="#">Separated link</a></li>
		</ul>
	</li>
	<li role="presentation"><a href="#">Messages</a></li>
	<?php
	if(null !== $this->Session->read('Auth.User.id')) {
		?>
		<li role="presentation"><a href="#">Admin</a></li>
		<?php
	}
	?>
</ul>