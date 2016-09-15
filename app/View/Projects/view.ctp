<h1>Détails de la demande n°<?php echo $request['Request']['id'];?></h1>

<h2>Etat de la demande</h2>

<div class="mgt30"></div>

<div class="row row-centered">
	<div class="col-sm-2 col-centered<?php echo (!$is_assigned && !$is_closed && !$is_blocked && !$was_blocked) ? ' projectactive' : ''; ?>">Demande ouverte</div>
	<div class="col-sm-2 col-centered<?php echo (!$is_closed && $is_blocked) ? ' projectactive' : ''; ?>">Demande bloquée</div>
	<div class="col-sm-2 col-centered<?php echo (!$is_assigned && !$is_closed && !$is_blocked && $was_blocked) ? ' projectactive' : ''; ?>">Demande éditée</div>
	<div class="col-sm-2 col-centered<?php echo ($is_assigned && !$is_closed && !$is_blocked) ? ' projectactive' : ''; ?>">Demande en traitement</div>
	<div class="col-sm-2 col-centered<?php echo ($is_closed) ? ' projectactive' : ''; ?>">Demande terminée</div>
</div>

<div class="mgt50"></div>

<h2>Informations à propos de la demande</h2>

<div class="mgt30"></div>

<div class="row">
	<div class="col-sm-3 col-centered-noborder"><strong>Demandeur :</strong> <?php echo $request['Asker']['email']; ?></div>
	<div class="col-sm-3 col-centered-noborder"><strong>Scope concerné :</strong> <?php echo $request['ScopeTo']['name']; ?></div>
	<div class="col-sm-3 col-centered-noborder"><strong>Couleur :</strong> <?php echo $request['ColorIs']['name']; ?></div>
	<div class="col-sm-3 col-centered-noborder"><strong>Catégorie :</strong> <?php echo $request['DetailsAre']['name']; ?></div>
</div>

<div class="mgt20"></div>

<div class="row">
	<div class="col-sm-3 col-centered-noborder"><strong>Date de création :</strong> <?php echo date('d/m/Y', strtotime($creationDate)); ?></div>
	<?php if(strtotime($creationDate) < strtotime($lastModified)) { ?>
		<div class="col-sm-3 col-centered-noborder"><strong>Dernière modification :</strong> <?php echo date('d/m/Y', strtotime($lastModified)); ?></div>
		<?php
	} ?>
</div>

<div class="mgt20"></div>

<div class="row">
	<div class="col-sm-3 col-centered-noborder comments"><strong>Commentaires :</strong></div>
	<div class="col-sm-8 col-centered-noborder comments"><?php echo nl2br($request['Request']['moreDetails']); ?></div>	
</div>

<?php if(count($request['Files'])) { ?>
	<div class="mgt20"></div>

	<div class="panel panel-default">
		<div class="panel-heading"><strong>Fichiers associés</strong></div>
		<div class="panel-body">
			Il y a <?php echo count($request['Files']); ?> fichiers associés à ce projet.<br>Il suffit de cliquer sur l'un d'eux pour le télécharger.
		</div>
		<ul class="list-group">
			<?php
			foreach($request['Files'] as $file) {
				echo $this->Html->link($file['name'], array('action' => 'download', $file['id']), array('class' => 'list-group-item'));
			} ?>
		</ul>
	</div>
	<?php
} ?>

<div class="mgt50"></div>

<h2>Traitement de la demande</h2>

<div class="mgt30"></div>

<?php
if(!$is_closed) {
	if(!$is_assigned && !$is_blocked) {  //Demande nouvelle ou éditée
		echo 'new or edited';
		echo $this->Form->hidden('Treatment.status', array('value' => 1));
	} elseif($is_blocked) { // Demande bloquée
		?>
		<p>
			Cette demande est bloquée pour les raisons suivantes :
			<?php foreach ($changes as $change) {
				?>
				<div class="alert alert-<?php echo ($change['is_zzz']) ? 'danger' : 'success';?>">
					<?php echo $this->Html->para('bck bold', date('d/m/Y', strtotime($change['date']))); ?>
					<br>
					<?php echo nl2br($change['comment']);?>
				</div>
				<?php
			} ?>
		</p>
		<div class="mgt10"></div>
		<?php echo $this->Html->link('Réouverture de la demande',array('action' => 'reopen', $idrequest), array('class' => 'btn btn-primary'));
	} else { //Demande en cours de traitement
		?>
		<p>
			Cette demande est en cours de traitement par :
			<ul class="list-inline">
				<?php
				foreach($assignedto as $assignee) { ?>
					<li><?php echo $assignee['email'];?></li>
					<?php
				} ?>
			</ul>
			Le délai de rendu estimé est de <?php echo $request['Request']['delay']; ?> jours.

			<div class="mgt10"></div>

			<?php echo $this->Form->create('Projects');

			echo $this->Form->input('Changes.comment', array('type' => 'textarea', 'label' => 'A remplir en cas de blocage de la demande. Les raisons seront envoyées par mail au client et historisées pour assurer la continuité :', 'div' => 'form-group', 'rows' => 10, 'class' => 'col-sm-12'));
			echo $this->Form->hidden('Request.id', array('value' => $idrequest));
			echo $this->Form->hidden('Treatment.status', array('value' => 2));
			$options = array('label' => 'Bloquer la demande', 'class' => 'btn btn-primary'); ?>
			
			<div class="clear"></div>
			<div class="mgt10"></div>

			<?php echo $this->Form->end($options); ?>

			<div class="mgt10"></div>

			<?php echo $this->Html->link('Retour aux demandes',array('action' => 'index'), array('class' => 'btn btn-default')); ?>
			<?php echo $this->Html->link('Fermer la demande',array('action' => 'close', $idrequest), array('class' => 'btn btn-danger'));?>
		</p>
		<?php
	}
} else { //Demande termninée
	?>
	<p>
		Cette demande est terminée.
		<div class="mgt10"></div>
		<?php echo $this->Html->link('Retour aux demandes',array('action' => 'index'), array('class' => 'btn btn-default')); ?>
		<?php echo $this->Html->link('Réouverture de la demande',array('action' => 'reopen', $idrequest), array('class' => 'btn btn-primary')); ?>
	</p>
	<?php
}
?>





















<!--
	<?php
	if($request['Request']['is_assigned']) {
		?>
		La demande est assignée à :
		<?php foreach($request['AssignedTo'] as $userAssigned) { ?>
			<?php echo $userAssigned['email'];?>
			<?php
		}
		?>
		Elle correspond à une demande de <?php echo $request['Type']['name'];
	} else {
		?>
		<h3>Cette demande est à traiter.</h3>
		<?php
		echo $this->Form->create('Request', array('class' => 'col-sm-12'));

		echo $this->Form->input('status', array(
			'label' => array('text' => 'Status de la demande', 'class' => 'col-sm-12'),
			'options' => array(1 => 'Demande refusée',2 => 'Demande acceptée'),
			'empty' => '','div' => 'form-group col-sm-12','required' => true));

		echo $this->Form->input('Request.why', array(
			'type' => 'textarea',
			'label' => array('text' => 'Raison du refus de traitement de la demande', 'class' => 'col-sm-12 hidden'),
			'div' => 'form-group col-sm-12', 'class' => 'col-sm-12 hidden'));

		echo $this->Form->input('Request.delay', array(
			'type' => 'number',
			'label' => array('text' => 'Temps estimé pour faire la tache (en jours)', 'class' => 'col-sm-12 hidden'),
			'div' => 'form-group col-sm-12', 'class' => 'hidden'));

		echo $this->Form->input('Request.who', array(
			'label' => array('text' => 'Le ZZZ en charge de cette demande', 'class' => 'col-sm-12 hidden'),
			'options' => $zzz, 'default' => $this->Session->read('Auth.User.id'),
			'div' => 'form-group', 'class' => 'hidden', 'multiple'));

		echo $this->Html->link('Retour aux demandes',array('action' => 'index'), array('class' => 'button btn btn-default'));

		$options = array('label' => 'Enregistrer', 'class' => 'btn btn-primary');
		echo $this->Form->end($options);
	}
	?>-->