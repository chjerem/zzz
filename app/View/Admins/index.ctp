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
