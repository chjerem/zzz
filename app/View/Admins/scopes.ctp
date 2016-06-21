<h1>Liste des périmètres</h1>

<table id="tableview" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Nom du périmètre</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($scopes as $scope) { ?>
        <tr>
            <td class="text-center"><?php echo current($scope['Scope']); ?></td>
            <td><?php echo $scope['Scope']['name']; ?></td>
            <td>
                <?php echo $this->Html->link(
                    $this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-pencil text-center', 'alt' => 'Editer')),
                    array('action' => 'editscope', $scope['Scope']['id']),
                    array('escape' => false)
                ); ?>
                <?php echo $this->Html->link(
                    $this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-remove text-center', 'alt' => 'Suppression')),
                    array('action' => 'deletescope', $scope['Scope']['id']),
                    array('escape' => false)
                ); ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>