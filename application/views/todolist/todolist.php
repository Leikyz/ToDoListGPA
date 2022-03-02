
    <p class="h1 fs-1 text-center">To-Do List</p>
    <br><br>
    <table class="datatable table table-striped" style="width: 100%"">
        <thead>
            <tr>
                <th>ID</th> 
                <th>Titre</th>
                <th>Contenu</th>
                <th>Date Création</th>
                <th>Service ID</th>
                <th>Intervenant ID</th> 
            </tr>
        </thead>
        <tbody>

<?php 
foreach($task as $ligne)
{ 
?>

            <tr>
                <td><?php echo $ligne['id'];?></td>
                <td><?php echo $ligne['titre'];?></td>
                <td><?php echo $ligne['contenu'];?></td>
                <td><?php echo Conv_Date($ligne['dateCreation'],'EN-FR');?></td>
                <td><?php echo $ligne['intervenant'];?></td>
                <td><?php echo $ligne['service'];?></td>
            </tr>
        </tbody>
<?php
}
?>	
    </table>


<?php
//http://localhost/codeigniter/index.php/todolist/C_todolist
?>


