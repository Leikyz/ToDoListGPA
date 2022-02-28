<?php 
setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1'); 

//Scan le dossier de l'usager et récupère les pdf, jpg et gif
function ScanDirectory($Directory,$file_selected){
    $MyDirectory = opendir($Directory) or die('Erreur');
      while($Entry = @readdir($MyDirectory)) {
          if(is_dir($Directory.'/'.$Entry)&& $Entry != '.' && $Entry != '..') 
          {
              ScanDirectory($Directory.'/'.$Entry,$file_selected);
          } else {
              if(substr($Entry,-4) == '.jpg' OR substr($Entry,-4) == '.gif' OR substr($Entry,-4) == '.PDF' OR substr($Entry,-4) == '.pdf')
              {
                  
              ?>
              <option value="<?php echo $Directory; ?>/<?php echo $Entry ;?>" <?php echo ($file_selected==$Entry) ? 'selected' : '';?> >
              <?php echo cleanText($Entry) ;?>
              </option>
              <?php
              }
               }
       }
    closedir($MyDirectory);
}
?>
<div class="container">
    <?php echo form_open(); ?>
    <div class="row">
        <div class="form-group col-md-4">
            <label for="dipc_date_debut">Date de début</label>
            <?php echo form_input('dipc_date_debut', Conv_Date($detailsDipc->dipc_date_debut,'EN-FR'), 'class="form-control datepicker" required');?>  
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label for="dipc_date_fin">Date de fin</label>
            <?php echo form_input('dipc_date_fin', Conv_Date($detailsDipc->dipc_date_fin,'EN-FR'), 'class="form-control datepicker" required');?>  
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label for="dipc_type">Type</label>
            <?php echo form_dropdown('dipc_type', $dipcType, $detailsDipc->dipc_type, 'class="form-control" required');?>  
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label for="dipc_statut">Statut</label>
            <?php echo form_dropdown('dipc_statut', $dipcStatut, $detailsDipc->dipc_statut, 'class="form-control" required');?>  
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="dipc_document">Document</label>
            <?php 
            $dir = '../documents/'.CLIENT.'/'.$usager_id;
            $file_selected = basename($detailsDipc->dipc_document);
            echo "<select name='dipc_document' class='form-control'>"; 
            echo "<option value=''></option>";
            ScanDirectory($dir,$file_selected); 
            echo "</select>";
            ?>
        </div>
    </div>
    <?php 
    echo form_hidden('dipc_enfant_id', $usager_id); 
    

    echo form_submit('envoyer','Envoyer', 'class="btn btn-primary"');

    if($action == 'updateDipc')
    {
        echo form_hidden('dipc_id', $dipc_id);
        echo form_submit('supprimer','Supprimer', 'class="btn btn-danger"');
    }

    echo form_close();
    ?>

</div>




				  

