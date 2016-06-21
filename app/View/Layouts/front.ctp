<?php echo $this->Html->docType('html5'); ?>
<html>
<head><?php echo $this->element('head'); ?></head>
<body>
	<header><?php echo $this->element('header'); ?></header>
	<div class="clear"></div>
	<div id="tabs"><?php echo $this->element('tabs'); ?></div>
	<div class="clear"></div>
	<div id="content"><?php echo $this->element('content'); ?></div>
	<footer><?php echo $this->element('footer'); ?></footer>
	<!-- DEBUT JS -->
	<?php echo $this->element('js'); ?>
	<!-- FIN JS -->
</div>
</body>
</html>
