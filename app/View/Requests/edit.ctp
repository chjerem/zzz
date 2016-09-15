<h1>Editer une demande</h1>

<?php echo $this->Form->create('Request', array('class' => 'col-sm-4', 'type' => 'file')); ?>

<h2>Nom du projet</h2>
<?php echo $this->Form->input('projectName', array('label' => false, 'type' => 'text', 'class' => 'form-control', 'div' => 'form-group', 'required' => true, 'after' => '(ne mettre que le nom du projet en lui-meme, ex : Open, Elipi, Suivi de commande)')); ?>

<h2>Couleur</h2>
<?php echo $this->Form->input('Color.id', array('label' => false, 'options' => $coloroption, 'div' => 'form-group', 'required' => true)); ?>

<?php echo $this->Form->input('Scope.id', array('label' => 'Périmètre', 'options' => $scopeoption, 'default' => $this->Session->read('Auth.User.scope_id'), 'div' => 'form-group', 'required' => true)); ?>

<?php echo $this->Form->input('Type.id', array('label' => 'Type de la demande', 'options' => $typeoption, 'div' => 'form-group', 'required' => true)); ?>

<?php echo $this->Form->input('Detail.id', array('label' => 'Détail de la demande', 'options' => $detailoption, 'div' => 'form-group', 'required' => true)); ?>

<?php echo $this->Form->input('moreDetails', array('type' => 'textarea', 'label' => 'Détails supplémentaires à propos de la demande', 'div' => 'form-group', 'class' => 'col-sm-12')); ?>

<h2>Annexe</h2>
<div class="form-group">
	<input type="file" multiple="true" class="form-control" name="data[File][upload2][]">
	<?php echo $this->Form->unlockField('File.upload2'); ?>
</div>

<h2>Mise en production</h2>
<?php echo $this->Form->input('onlinedate', array('label' => false, 'div' => 'form-group', 'class' => 'form-control datepicker')); ?>

<h2>Recette</h2>
<?php echo $this->Form->input('testdate', array('label' => false, 'div' => 'form-group', 'class' => 'form-control datepicker')); ?>

<?php
$options = array('label' => 'Enregistrer', 'class' => 'btn btn-primary boutton mgt10');
echo $this->Form->end($options);
?>