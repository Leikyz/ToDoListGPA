<div class="col-md-6 col-md-offset-3 col-centered">
  <form action="" method="post">
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
      <select  class="form-control" name="service" id="exampleFormControlSelect" required>
      <?php  foreach($service as $ligne) : ?>
              <option value="<?= $ligne['service_id']?>"><?= $ligne['service_nom']?></option>
          <?php endforeach ?>
      </select>
    </div>
    <div class="form-group">
      <label for="exampleFormControlSelects2">Choix du personnel concerner</label>
      <select  class="form-control" name="intervenant" id="exampleFormControlSelect2" required>
            <?php  foreach($intervenants as $perso) : ?>
                <option  value="<?= $perso['personnel_id']?>"><?= $perso['personnel_nom']?> <?= $perso['personnel_prenom']?></option>
            <?php endforeach ?>
      </select>
    </div>
    <div class="form-group">
      <label for="exampleFormControlTextarea1">Note</label>
      <textarea  placeholder="<?=$task->tache_commentaire?>" class="form-control" name="note" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <div class="col-md-2 col-md-offset-5 col-centered background-color #00C0EF">
        <button type="submit" class="btn btn-primary btn-lg btn-block">Modifier</button>
    </div>
  </form>
</div>