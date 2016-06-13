<h1>Liste des couleurs</h1>

<table id="tableview" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Nom de la couleur</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($colors as $color) { ?>
        <tr>
            <td class="text-center"><?php echo current($color['Color']); ?></td>
            <td><?php echo $color['Color']['name']; ?></td>
            <td>
                <?php echo $this->Html->link(
                    $this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-pencil text-center', 'alt' => 'Editer')),
                    array('action' => 'editcolor', $color['Color']['id']),
                    array('escape' => false)
                ); ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>