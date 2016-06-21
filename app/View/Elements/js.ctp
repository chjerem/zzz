<?php echo $this->Html->script(array('jquery.min','bootstrap.min', 'jquery.dataTables.min')); ?>

<!--Loading dynamic tables-->
<script>
$(document).ready(function() {
    $('#tableview').DataTable();
});
</script>