<h1>Liste des demandes ouvertes non assignées</h1>

<table id="tableview" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Scope</th>
            <th>Projet</th>
            <th>Demandeur</th>
            <th>Détail</th>
            <th>Création</th>
            <th>Assignation</th>
            <th>Mise en Prod</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i=0;
        foreach($requests as $request) {
            $i++;

            ?>
            <tr>
                <td class="text-center"><?php echo $i; ?></td>
                <td><?php echo $request['ScopeTo']['name']; ?></td>
                <td><?php echo $request['Request']['projectName']; ?></td>
                <td><?php echo $request['Asker']['email']; ?></td>
                <td><?php echo $request['DetailsAre']['name']; ?></td>
                <td>
                    <?php
                    if(strtotime($request['Request']['creationDate']) < strtotime($request['Request']['lastModified'])) {
                        echo date('d-m-Y', strtotime($request['Request']['creationDate'])); ?>
                        (Dernière modification : <?php echo date('d-m-Y', strtotime($request['Request']['lastModified'])).')';
                    } else {
                        echo date('d-m-Y', strtotime($request['Request']['creationDate']));
                    } ?>
                </td>
                <td>
                    <?php
                    if($request['Request']['is_assigned']) {
                        echo 'à faire :) :)';
                    } else {
                        echo 'Demande non traitée';
                    } ?>
                </td>
                <td><?php echo date('d-m-Y', strtotime($request['Request']['onlineDate']));?></td>
                <td>
                    <?php
                        echo $this->Html->link(
                        $this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-pencil text-center', 'alt' => 'View')),
                        array('action' => 'view', $request['Request']['id']),
                        array('escape' => false)
                        );
                    ?>
                    <?php echo $this->Html->link(
                        $this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-remove text-center', 'alt' => 'Suppression')),
                        array('action' => 'delete', $request['Request']['id']),
                        array('escape' => false)
                        );
                    ?>
                </td>
            </tr>
            <?php
        } ?>
    </tbody>
</table>