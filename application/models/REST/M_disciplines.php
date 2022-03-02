<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class m_disciplines extends CI_Model {
    
     public function __construct() {
        parent::__construct();
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');
    }
    
    public function getDisciplines($archive = NULL) {

        $this->db->select('*');
        $this->db->from('discipline');
        if(empty($archive))
        {
            $this->db->where('discipline_archive', '');
        }else{
            $this->db->where('discipline_archive <> ', '');
        }
        $this->db->where('discipline_famille <> ', 'Statut Enfant');
        $this->db->order_by('discipline_libelle');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
       
    }


    

}
?>