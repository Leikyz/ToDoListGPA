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

    public function listTask($usagerId) {
        $this->db->select('tache_id, tache_creation_date, tache_echeance-date, tache_titre, tache_contenu');
        $this->db->from('tache');
        $this->db->where('tache_id', $usagerId);
        $query = $this->db->get();
        $result = $query->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    public function insertTask($data) {
        $data = array(
            'tache_id' => $data['tache_id'],
            'tache_creation_date' => Conv_Date($data['tache_creation_date'],'FR-EN'),
            'tache_echeance-date' => Conv_Date($data['tache_echeance-date'],'FR-EN'),
            'tache_titre' => $data['tache_titre'],
            'tache_contenu' => $data['tache_contenu'],
        );
        $result = $this->db->insert('tache', $data);
        if($result)
        {
            logs("Ajout Tache (ID ".$this->db->insert_id().")" , 'tache_id', $data['tache_id']);
        }
        return $result;
    }

    public function updateTask($data) {
        $tab = array(
            'tache_id' => $data['tache_id'],
            'tache_creation_date' => Conv_Date($data['tache_creation_date'],'FR-EN'),
            'tache_echeance-date' => Conv_Date($data['tache_echeance-date'],'FR-EN'),
            'tache_titre' => $data['tache_titre'],
            'tache_contenu' => $data['tache_contenu'],
        );
        $this->db->where('tache_id', $data['tache_id']);
        $result = $this->db->update('tache', $tab);
        if($result)
        {
            logs("Modification Tache (ID ".$data['tache_id'].")");
        }
        return $result;
    }
}
?>