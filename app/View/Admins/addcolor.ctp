<?php
echo $this->Form->create('Color');?>
<div class="container">
    <div class="row">
        <div id="error" class="col-sm-6 col-sm-offset-3">
            <?php echo $this->Form->input('name', array('required' => 'true', 'type' => 'text', 'placeholder' => 'Nom de la couleur', 'label' => false, 'class' => 'form-control')); ?>  
        </div>
        <div class="col-sm-6 col-sm-offset-3 text-center">
            <?php
            $options = array(
                'label' => 'Enregistrer',
                'class' => 'btn btn-primary boutton'
                );
                echo $this->Form->end($options); ?>
            </div>
        </div>
    </div>
</div>