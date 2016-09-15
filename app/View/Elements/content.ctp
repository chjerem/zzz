<div class="container-fluid">
	<div class="row">
		<ol class="breadcrumb mgt10"><?php echo $this->element('breadcrumb'); ?></ol>
	</div>
	<div class="row">
		<div class="col-sm-4">
			<?php echo $this->Flash->render(); //à mieux caler mais ça suffira pr l'instant ?>
		</div>
	</div>
	<div class="content">
		<?php echo $this->fetch('content'); ?>
	</div>
</div>