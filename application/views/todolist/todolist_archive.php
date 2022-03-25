
    <p class="h1 fs-1 text-center">To-Do List</p>
    <br><br>

    <div class="col-md-2 col-md-offset-5 col-centered background-color #00C0EF">
        <a href="http://localhost/codeigniter/index.php/todolist/C_todolist/insertTask/" class="btn btn-info" role="button">Créer une tâche</a>
        <a href="http://localhost/codeigniter/index.php/todolist/C_todolist/" class="btn btn-info" role="button">Tâches en cours</a>
    </div>
    

    <table class="datatable table table-striped" style="width: 100%">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Contenu</th>
                <th>Date Création</th>
                <th>Service</th>
                <th>Intervenant</th> 
                <th>Modifier</th> 
                <th>Désarchiver</th>
            </tr>
        </thead>
        <tbody>

<?php 
foreach($task as $ligne)
{ 
?>            <tr>
                <td><?php echo $ligne['titre'];?></td>
                <td><?php echo $ligne['contenu'];?></td>
                <td><?php echo Conv_Date($ligne['dateCreation'],'EN-FR');?></td>
                <td><?php echo $ligne['service'];?></td>
                <td><?php echo $ligne['intervenant_nom'];?></td>
                <td><a href="http://localhost/codeigniter/index.php/todolist/C_todolist/updateTask/<?=$ligne['id']?>" class="btn btn-info" role="button">Modifier</a></td>
                <td><a href="http://localhost/codeigniter/index.php/todolist/C_todolist/putArchiveTask/<?php echo $ligne['id'];?>/0"><button type="button" class="btn">Désarchiver</button></a></td>
            </tr>
        </tbody>
<?php
}
?>	
    </table>


<?php
//http://localhost/codeigniter/index.php/todolist/C_todolist
?>


