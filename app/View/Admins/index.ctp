Voici les différentes méthodes :
<ul>
	<?php foreach($controllers as $controller) {
		foreach($controller as $method) {
			?>
			<li>
				<?= $this->Html->link($method, array('action' => $method)); ?>
			</li>
			<?php
		}
	}
	?>
</ul>

<p><?= $this->Html->link('Faire une demande', array('controller' => 'requests', 'action' => 'add')) ?></p>
<p><?= $this->Html->link('/projects/', array('controller' => 'projects')) ?></p>