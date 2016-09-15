<div class="container-fluid">
	<div class="row">
		<!--Logo Orange-->
		<div class="col-sm-3">
			<?php echo $this->Html->image('layout/logoZZZ.png', array('alt' => 'Logo Orange', 'class' => 'img-responsive'));?>
		</div>
		<!--Statistiques-->
		<div class="col-sm-offset-6 col-sm-3" style="float:right;">
			<dl>
				<?php if($this->Session->read('Auth.User.id')) { ?>
					<dt><?php echo $lastname.' '.$firstname; ?> | <?php echo $this->Html->link('Se déconnecter', array('controller' => 'users', 'action' => 'logout'));?></dt>
					<dd><?php echo $scopeuser; ?> (<?php echo $job; ?>) | <?php echo $email; ?></dd>
					<dd>Statistique 2</dd>
					<dd>Statistique 3</dd>
					<?php
				} else { ?>
					<?php echo $this->Html->link('Se connecter', array('controller' => 'users', 'action' => 'login'));
				} ?>
			</dl>
		</div>
	</div>
</div>