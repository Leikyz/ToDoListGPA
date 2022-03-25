<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class m_todolist extends CI_Model {
    
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
    public function getTaskStatus() {
        $this->db->select('*');
        $this->db->from('tache_status');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function getActualTaskStatus() {
        $this->db->select('tache_status');
        $this->db->from('tache');
        $this->db->join('tache_status', 'status_id = tache_status_id');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function getIntervenantsNomById($id) 
    {
        $this->db->select('personnel_nom');
        $this->db->from('personnel');
        $this->db->join('tache', 'tache.tache_id = personnel.personnel_id');
        $this->db->where('personnel_id', $id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function insertTask($data, $intervenant) {
        $datetime = date('Y-m-d H:i:s');
        $data = array(
            'tache_titre' => $data['tache_titre'],
            'tache_contenu' => $data['tache_description'],
            'tache_creation_intervenant_id' => 1,
            'tache_service_id' => $data['service'],
            'tache_echeance_date' => date('Y-m-d', strtotime(str_replace('-', '/', $data['last']))),
            'tache_creation_date' => $datetime,
            'tache_intervenant_id' => $intervenant,
            'tache_status' => 1
        );
        $result = $this->db->insert('tache', $data);
        return $result;
    }
   // Mettre en archive

    public function updateTask($data, $taskid) 
    {  
        $tab = array(
            'tache_titre' => $data['tache_titre'],
            'tache_contenu' => $data['tache_contenu'],
            'tache_intervenant_id' => $data['tache_intervenant_id'],
            'tache_service_id' => $data['tache_service_id'],
            'tache_status_id' => $data['tache_status_id'],
            'tache_commentaire' => $data['tache_commentaire'],
        );
        $this->db->where('tache_id', $taskid);
        $result = $this->db->update('tache', $tab);
        redirect('/todolist/C_todolist');
        return $result;
    }
    
    public function listTask() {
        $this->db->select('tache_id, tache_titre, tache_contenu, tache_creation_date, personnel_prenom, tache_service_id, personnel_nom, service_nom, tache_echeance_date, status_nom, tache_commentaire');
        $this->db->from('tache');
        $this->db->join('personnel', 'personnel_id = tache_intervenant_id');
        $this->db->join('tache_status', 'status_id = tache_status_id');
        $this->db->join('service', 'service_id = tache_service_id');
         $this->db->where('tache_status_id <> 4');
        $query = $this->db->get();
        $result = $query->result();
        //echo $this->db->last_query();
        return $result;
    }
    public function listTaskArchive() {
        $this->db->select('tache_id, tache_titre, tache_contenu, tache_creation_date, personnel_prenom, tache_service_id, personnel_nom, service_nom, tache_echeance_date, status_nom, tache_commentaire');
        $this->db->from('tache');
        $this->db->join('personnel', 'personnel_id = tache_intervenant_id');
        $this->db->join('tache_status', 'status_id = tache_status_id');
        $this->db->join('service', 'service_id = tache_service_id');
         $this->db->where('tache_status_id', 4);
        $query = $this->db->get();
        $result = $query->result();
        //echo $this->db->last_query();
        return $result;
    }
    public function getTaskInfos($id) {
        $this->db->select('tache_id, tache_titre,tache_intervenant_id, tache_contenu, personnel_prenom, tache_service_id, personnel_nom, service_nom, tache_echeance_date, status_nom, tache_commentaire');
        $this->db->from('tache');
        $this->db->join('personnel', 'personnel_id = tache_intervenant_id');
        $this->db->join('tache_status', 'status_id = tache_status_id');
        $this->db->join('service', 'service_id = tache_service_id');
        $this->db->where('tache_id', $id);
        $query = $this->db->get();
        $result = $query->row();
        //echo $this->db->last_query();
        return $result;
    }
}
?>
