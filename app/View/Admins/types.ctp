<h1>Liste des types de demande</h1>

<table id="tableview" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Nom du type de demande</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($types as $type) { ?>
        <tr>
            <td class="text-center"><?php echo current($type['Type']); ?></td>
            <td><?php echo $type['Type']['name']; ?></td>
            <td>
                <?php echo $this->Html->link(
                    $this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-pencil text-center', 'alt' => 'Editer')),
                    array('action' => 'edittype', $type['Type']['id']),
                    array('escape' => false)
                ); ?>
                <?php echo $this->Html->link(
                    $this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-remove text-center', 'alt' => 'Suppression')),
                    array('action' => 'deletetype', $type['Type']['id']),
                    array('escape' => false)
                ); ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>