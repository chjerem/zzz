<?php echo $this->Html->script(array('jquery.min', 'jquery-ui.min', 'bootstrap.min', 'jquery.dataTables.min')); ?>

<!--Loading dynamic tables-->
<script>
	$(document).ready(function() {
		$('table[id*="tableview"]').DataTable();
	});
</script>

<!--Datepicker-->
<script>
	$(function() {
		$('.datepicker').datepicker({
			minDate: 0,
			beforeShowDay: $.datepicker.noWeekends,
			firstDay: 1
		});
	});
</script>

<!-- Request status -->
<script>
	$('#RequestStatus').on('change', function(){
		var selectedvalue = $(this).val();
		
		if(selectedvalue == 1) { //Demande refusée
			$('#RequestWhy').removeClass('hidden');
			$('label[for="RequestWhy"]').removeClass('hidden');

			$('#RequestDelay').addClass('hidden');
			$('label[for="RequestDelay"]').addClass('hidden');

			$('#RequestWho').addClass('hidden');
			$('label[for="RequestWho"]').addClass('hidden');
		} else if(selectedvalue == 2) { //Demande acceptée
			$('#RequestWhy').addClass('hidden');
			$('label[for="RequestWhy"]').addClass('hidden');

			$('#RequestDelay').removeClass('hidden');
			$('label[for="RequestDelay"]').removeClass('hidden');

			$('#RequestWho').removeClass('hidden');
			$('label[for="RequestWho"]').removeClass('hidden');
		} else {
			//On cache si l'utilisateur retourne sur la case vide (et autres éventuelles exceptions inhabituelles)
			//Motif de refus
			$('#RequestWhy').addClass('hidden');
			$('label[for="RequestWhy"]').addClass('hidden');
			//Délai de rendu
			$('#RequestDelay').addClass('hidden');
			$('label[for="RequestDelay"]').addClass('hidden');
			//Le ZZZ qui sera chargé de la demande
			$('#RequestWho').addClass('hidden');
			$('label[for="RequestWho"]').addClass('hidden');
		}
	});
</script>