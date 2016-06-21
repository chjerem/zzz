<?php echo $this->Form->create(); ?>
	<div class="form-group">
		<?php echo $this->Form->input('email', array('type'=>'email','class' => 'form-control', 'label' =>'Adresse mail', 'placeholder' => 'Email')); ?>
	</div>
	<div class="form-group">
		<?php echo $this->Form->input('password', array('type'=>'password','class' => 'form-control', 'label' =>'Mot de passe', 'placeholder' => 'Mot de passe')); ?>
	</div>
</div>
<div class="text-center">
	<?php echo $this->Form->button('Se connecter', array('class' => 'btn btn-primary')); ?>
</div>
<?php echo $this->Form->end(); ?>