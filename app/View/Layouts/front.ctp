<?php echo $this->Html->docType('html5'); ?>
<html>
<head><?php echo $this->element('head'); ?></head>
<body>
	<div id="container">
		<header><?php echo $this->element('header'); ?></header>
		<div id="sidebar"><?php echo $this->element('sidebar'); ?></div>
		<div id="container">
			<?php echo $this->Flash->render(); //à mieux caler mais ça suffira pr l'instant ?>
			<?php echo $this->fetch('content'); ?>
		</div>
		<footer><?php echo $this->element('footer'); ?></footer>
		<!-- DEBUT JS -->
		<?php echo $this->Html->script(array('jquery.min','bootstrap.min')); ?>
		<!-- FIN JS -->
	</div>
</body>
</html>
