
<?php
echo form_open('');
    ?>
    <div class="form-group">
    <?php
    echo form_label('Nom de la tâche', 'tache_nom_label');
    echo form_input('tache_titre', $task->tache_titre,  'class="form-control"');
    ?>
    </div>

    <div class="form-group">
    <?php
    echo form_label('Description de la tâche', 'tache_description_label');
    echo form_input('tache_contenu', $task->tache_contenu,  'class="form-control"');
    ?>
    </div>
    <div class="form-group">
    <?php
    echo form_label('Listes des intervenants', 'tache_intervenant_label');
    echo form_dropdown('tache_intervenant_id', $list_intervenant,  $task->tache_intervenant_id, 'class="form-control select2"');
    ?>
    </div>
    <div class="form-group">
    <?php
    echo form_label('Listes des services', 'tache_services_id');
    echo form_dropdown('tache_service_id',  $service, $task->tache_service_id, 'class="form-control select2"');
    ?>
    </div>
    <div class="form-group">
    <?php
    echo form_label('Modifier le status', 'tache_status_id');
    echo form_dropdown('tache_status_id',  $status, "", 'class="form-control select2"');
    ?>
    </div>
    <div class="form-group">
    <?php
    echo form_label('Modifier la note', 'tache_status_id');
    echo form_textarea('tache_commentaire', $task->tache_commentaire,  'class="form-control"');
    ?>
    </div>
    <?php
    echo form_submit('envoi', 'Envoyer', 'class="btn btn-primary"');
    echo form_close();
    ?>