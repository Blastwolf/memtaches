<table>
    <thead>
        <tr>
            <th>Taches</th>
            <th>Date de Début</th>
            <th>Date de Fin</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($tasks as $task){ ?>
            <tr>
                <th><?=$task['task']?></th>
                <th><?=$task['datedebut']?></th>
                <th><?=$task['datefin']?></th>
            </tr>
       <?php }?>
    </tbody>
</table>
<div>
</div>