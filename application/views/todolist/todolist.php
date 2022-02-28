<?php setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1'); 
?>

<div class="panel-body">
    <table  class="datatable table table-striped" style="width: 100%">
        <thead>
            <tr>
                <th>Date d&eacute;but</th> 
                <th>Date Fin</th>
                <th>Type</th>
                <th>Statut</th>
                <th>Document</th>
                <?php if($acces_modif=='ok')
                {
                ?>
                    <th></th>
                <?php 
                }
                ?>   
            </tr>
        </thead>
        <tbody>
<?php 
foreach($liste as $ligne)
{
?>
            <tr>
            <td><?php echo Conv_Date($ligne['dipc_date_debut'],'EN-FR');?></td>
            <td><?php echo Conv_Date($ligne['dipc_date_fin'],'EN-FR');?></td>
            <td><?php echo $ligne['dipc_type'];?></td>
            <td><?php echo $ligne['dipc_statut'];?></td>
            <td>
            <?php 
            if($ligne['dipc_document'])
            {
            ?>
                <a href="<?php echo '../../../../'.$ligne['dipc_document'];?>" target="_blank"><i class="fa fa-file-o" aria-hidden="true"></i> <?php echo basename($ligne['dipc_document']);?></a>
            <?php 
            } 
            ?>
            </td>
            <?php if($acces_modif=='ok')
                {
                ?>
                    <td><a href="<?php echo '/framework/dipc/C_dipc/updateDipc/'.$usager_id."/".$ligne['dipc_id'];?>" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
            <?php 
                }
                ?>  
            </tr>
<?php
}
?>	

        </tbody>
    </table>
</div>