<h1>Liste des détails de la demande</h1>

<table id="tableview" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Nom du détail de la demande</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($details as $detail) { ?>
        <tr>
            <td class="text-center"><?php echo current($detail['Detail']); ?></td>
            <td><?php echo $detail['Detail']['name']; ?></td>
            <td>
                <?php echo $this->Html->link(
                    $this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-pencil text-center', 'alt' => 'Editer')),
                    array('action' => 'editdetail', $detail['Detail']['id']),
                    array('escape' => false)
                ); ?>
                <?php echo $this->Html->link(
                    $this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-remove text-center', 'alt' => 'Suppression')),
                    array('action' => 'deletedetail', $detail['Detail']['id']),
                    array('escape' => false)
                ); ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>