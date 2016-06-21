<ul class="nav nav-tabs">
	<li role="presentation" <?php echo ($where === '') ? 'class="active"' : ''; ?>><?php echo $this->Html->link('Accueil', array('controller' => 'home', 'action' => 'index')) ?></li>
	<li role="presentation"><a href="#">Profile</a></li>
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
		<li role="presentation" <?php echo ($where === 'Admins') ? 'class="active"' : ''; ?>><?php echo $this->Html->link('Admin', array('controller' => 'admins', 'action' => 'index')); ?></li>
		<?php
	}
	?>
</ul>