<div class="container-fluid">
	<div class="row">
		<ol class="breadcrumb mgt10"><?php echo $this->element('breadcrumb'); ?></ol>
	</div>
	<?php echo $this->Flash->render(); //à mieux caler mais ça suffira pr l'instant ?>
	<div class="content">
		<?php echo $this->fetch('content'); ?>
	</div>
</div>