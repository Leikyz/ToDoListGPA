<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class todolist extends CI_Model {
    
     public function __construct() {
        parent::__construct();
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');
    }
    
    public function getTask($id) {
        $this->db->select('*');
        $this->db->from('tache');
        $this->db->where('tache_id', $id);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    public function listTask($tacheId) {
        $donnees = $data = NULL;

        $this->db->select('*');
        $this->db->from('tache');
        $this->db->join('liste_generale as type', 'dipc_type = type.liste_generale_id', 'left');
        $this->db->join('liste_generale as statut', 'dipc_statut = statut.liste_generale_id', 'left');
        $this->db->where('tache_id', $tacheId);
        $query = $this->db->get();
        $result = $query->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    public function insertDipc($data) {
        $data = array(
            'dipc_enfant_id' => $data['dipc_enfant_id'],
            'dipc_date_debut' => Conv_Date($data['dipc_date_debut'],'FR-EN'),
            'dipc_date_fin' => Conv_Date($data['dipc_date_fin'],'FR-EN'),
            'dipc_document' => $data['dipc_document'],
            'dipc_type' => $data['dipc_type'],
            'dipc_statut' => $data['dipc_statut']
        );
        $result = $this->db->insert('dipc', $data);
        if($result)
        {
            logs("Ajout DIPC (ID ".$this->db->insert_id().")" , 'enfant', $data['dipc_enfant_id']);
        }
        return $result;
    }

    public function updateDipc($data) {
        $tab = array(
            'dipc_enfant_id' => $data['dipc_enfant_id'],
            'dipc_date_debut' => Conv_Date($data['dipc_date_debut'],'FR-EN'),
            'dipc_date_fin' => Conv_Date($data['dipc_date_fin'],'FR-EN'),
            'dipc_document' => $data['dipc_document'],
            'dipc_type' => $data['dipc_type'],
            'dipc_statut' => $data['dipc_statut']
        );
        $this->db->where('dipc_id', $data['dipc_id']);
        $result = $this->db->update('dipc', $tab);
        if($result)
        {
            logs("Modification DIPC (ID ".$data['dipc_id'].")" , 'enfant', $data['dipc_enfant_id']);
        }
        return $result;
    }

    public function deleteDipc($idDipc,$idUsager) {
        $this->db->where('dipc_id', $idDipc);
        $result = $this->db->delete('dipc');
        if($result)
        {
            logs("Suppression DIPC (ID ".$idDipc.")" , 'enfant', $idUsager);
        }
        return $result;
    }

}
?>