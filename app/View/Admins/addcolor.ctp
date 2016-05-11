<?php
echo $this->Form->create('Color');?>
<div class="container" id="tk0036_add">
    <div class="row">
        <!-- Nom de la couleur -->
        <div id="error" class="col-sm-6 col-sm-offset-3">
            <?php echo $this->Form->input('name', array('required' => 'true', 'type' => 'text', 'placeholder' => 'Nom de la couleur', 'label' => false, 'class' => 'form-control')); ?>  
        </div>
        <!-- Bouton submit -->
        <div class="col-sm-6 col-sm-offset-3 text-center">
            <!--Affiche le label du bouton et les classes à appliquer-->
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