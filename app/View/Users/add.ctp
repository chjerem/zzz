<h1>Créer un compte</h1>

<?php echo $this->Form->create('User', array('class' => 'col-sm-4', 'inputDefaults' => array('label' => false, 'div' => 'form-group', 'class' => 'form-control', 'required' => true, 'type' => 'text'))); ?>
<?php echo $this->Form->input('lastname', array('placeholder' => 'Nom de famille')); ?>
<?php echo $this->Form->input('firstname', array('placeholder' => 'Prénom')); ?>
<?php echo $this->Form->input('email', array('placeholder' => 'Adresse email', 'type' => 'email')); ?>
<?php echo $this->Form->input('password', array('placeholder' => 'Mot de passe', 'type' => 'password')); ?>
<?php echo $this->Form->input('passwordconfirm', array('placeholder' => 'Confirmation', 'type' => 'password')); ?>
<?php echo $this->Form->input('scope_id', array('label' => 'Périmètre', 'options' => $scopeoption, 'type' => null)); ?>
<?php echo $this->Form->input('job', array('label' => 'Métier', 'options' => array('MOA' => 'MOA', 'Métier' => 'Métier', 'MOE' => 'MOE'), 'type' => null)); ?>
<?php
$options = array('label' => 'Enregistrer', 'class' => 'btn btn-primary boutton mgt10');
echo $this->Form->end($options);
?>