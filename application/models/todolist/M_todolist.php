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

    public function insertTask($data, $intervenant) {
        $datetime = date('d-m-y h:i:s');
        $timestamp = date('Y-m-d H:i:s',strtotime($datetime));
        $data = array(
            'tache_titre' => $data['titre'],
            'tache_contenu' => $data['description'],
            'tache_creation_intervenant_id' => 1,
            'tache_service_id' => $data['service'],
            'tache_echeance_date' => date('Y-m-d', strtotime(str_replace('-', '/', $data['last']))),
            'tache_creation_date' => preg_replace('#(\d{2})/(\d{2})/(\d{4})\s(.*)#', '$3-$2-$1 $4',  $timestamp),
            'tache_intervenant_id' => $intervenant,
        );
        $result = $this->db->insert('tache', $data);
        redirect('/todolist/C_todolist');
        return $result;
    }
   // Mettre en archive
   public function putArchiveTask($id, $archive){
    $tab = array('tache_archive' => $archive);


    $this->db->where('tache_id', $id);
    $result = $this->db->update('tache', $tab);

    return $result;
}

// Retirer archive
public function outArchiveTask($id, $archive){
    $tab = array('tache_archive' => $archive);


    $this->db->where('tache_id', $id);
    $result = $this->db->update('tache', $tab);

    return $result;
}

    public function updateTask($data, $taskid) 
    {
        $datetime = date('d-m-y h:i:s');
        $timestamp = date('Y-m-d H:i:s',strtotime($datetime));
        $datas = [];
        if ($data['titre'] != null) 
        {
            $datas += array('tache_titre' => $data['titre']);
        }
        if ($data['description'] != null) 
        {
            $datas += array('tache_contenu' => $data['description']);
        }
        if ($data['service'] != null) 
        {
            $datas += array('tache_service_id' => $data['service']);
        } 
        if ($data['intervenant'] != null) 
        {
            $datas += array('tache_intervenant_id' => $data['intervenant']);
        }   
        if ($data['note'] != null) 
        {
            $datas += array('tache_commentaire' => $data['note']);
        }            
                
        $this->db->where('tache_id', $taskid);
        $result = $this->db->update('tache', $datas);
        redirect('/todolist/C_todolist');
        return $result;
    }   
    public function listTask() {
        $this->db->select('tache_id, tache_titre, tache_contenu, tache_creation_date, tache_service_id, tache_intervenant_id, tache_archive');
        $this->db->from('tache');
        $this->db->where('tache_archive', 0);
        $query = $this->db->get();
        $result = $query->result();
        //echo $this->db->last_query();
        return $result;
    }
    public function listTaskArchive() {
        $this->db->select('tache_id, tache_titre, tache_contenu, tache_creation_date, tache_service_id, tache_intervenant_id, tache_archive');
        $this->db->from('tache');
        $this->db->where('tache_archive', 1);
        $query = $this->db->get();
        $result = $query->result();
        //echo $this->db->last_query();
        return $result;
    }
}
?>
