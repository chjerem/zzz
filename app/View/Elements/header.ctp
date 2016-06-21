<div class="container-fluid">
	<div class="row">
		<!--Logo Orange-->
		<div class="col-sm-3">
			<?php echo $this->Html->image('layout/orange.jpg', array('alt' => 'Logo Orange', 'width' => 100, 'class' => 'img-responsive'));?>
		</div>
		<!--Statistiques-->
		<div class="col-sm-offset-6 col-sm-2" style="float:right;">
			<dl>
				<?php if($this->Session->read('Auth.User.id')) { ?>
					<dt>Nom Prénom | <?php echo $this->Html->link('Se déconnecter', array('controller' => 'users', 'action' => 'logout'));?></dt>
					<dd>Statistique 1</dd>
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