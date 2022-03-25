
<?php
echo form_open('');
    ?>
    <div class="form-group">
    <?php
    echo form_label('Nom de la tâche', 'tache_nom_label');
    echo form_input('tache_titre', '',  'class="form-control"');
    ?>
    </div>

    <div class="form-group">
    <?php
    echo form_label('Description de la tâche', 'tache_description_label');
    echo form_input('tache_description', '',  'class="form-control"');
    ?>
    </div>
    <div class="form-group">
    <?php
    echo form_label('Listes des intervenants', 'tache_intervenant_label');
    echo form_multiselect('intervenant[]',  $list_intervenant, "", 'class="form-control select2"');
    ?>
    </div>
    <div class="form-group">
    <?php
    echo form_label('Listes des services', 'tache_services_id');
    echo form_dropdown('service',  $service, "", 'class="form-control select2"');
    ?>
    </div>
    <div class="form-group">
    <?php
    echo form_label('Date échéance', 'tache_date_echeance_label');
    echo form_input('tache_date_echeance', '',  'class="form-control datepicker"');
    ?>
    </div>
    <?php
    echo form_submit('envoi', 'Envoyer', 'class="btn btn-primary"');
    echo form_close();
    ?>
<script>
$(document).ready(function(){
	$('.search').select2()
});
</script>
