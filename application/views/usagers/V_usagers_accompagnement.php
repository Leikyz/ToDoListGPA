<div class="col-md-6">
  <ul class="list-group">
<?php 
//debug($liste_accompagnement);
if($liste_accompagnement){
	foreach($liste_accompagnement as $accompagnement){
?>
<li class="list-group-item row <?php echo ($accompagnement['DF']>time()) ? 'list-group-item-success' : '' ;?>">
          <div class="col-md-4"><?php echo date('d/m/Y',$accompagnement['DD']).' au '.date('d/m/Y',$accompagnement['DF']); ?></div>
          <div class="col-md-6"><?php echo $accompagnement['libelle']; ?></div>
          <div class="col-md-12"><?php echo trim($accompagnement['intervenants'],', '); ?></div>
</li>
<?php
	}
}else{
	echo 'Pas de résultats.';
}
?>
  </ul>
</div>