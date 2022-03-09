<form action="" method="post">
    <?php var_dump($task) ?>
  <div class="form-group">
    <label for="exampleFormControlInput1">Nom de la tâche</label>
    <input type="text" name="titre" placeholder="<?=$task->tache_titre?>" class="form-control" id="exampleFormControlInput1">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Description de la tâche</label>
    <input type="text" name="description"  placeholder="<?=$task->tache_contenu?>" class="form-control" id="exampleFormControlInput1">
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect2">Choix des services</label>
    <select multiple class="form-control" name="service[]" id="exampleFormControlSelect2">
        <?php  foreach($service as $ligne) : ?>
            <option><?= $ligne['service_nom']?></option>
        <?php endforeach ?>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelects2">Choix du personnel concerner</label>
    <select multiple class="form-control" name="intervenant[]" id="exampleFormControlSelects2">
        <?php  foreach($intervenants as $perso) : ?>
            <option><?= $perso['personnel_nom']?></option>
        <?php endforeach ?>
    </select>
  </div>
  <input type="submit" value="Subscribe!">
</form>