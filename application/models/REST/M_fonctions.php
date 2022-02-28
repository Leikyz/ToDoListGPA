<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class m_fonctions extends CI_Model {
    
    public function __construct() 
    {
        parent::__construct();
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');
    }
    
    public function getFonctions($archive = NULL) 
    {
        $this->db->select('*');
        $this->db->from('liste_fonctions');
        if(empty($archive))
        {
            $this->db->where('liste_fonctions_archive', '');
        }else{
            $this->db->where('liste_fonctions_archive <> ', '');
        }
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function getFonction($id) 
    {
        $this->db->select('*');
        $this->db->from('liste_fonctions');
        $this->db->where('liste_fonctions_id', $id);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    public function updateFonction($id,$libelle,$regroupement,$archive,$disciplines) 
    {
        $data = array(
            'liste_fonctions_libelle' => $libelle,
            'liste_fonctions_regroupement' => $regroupement,
            'liste_fonctions_archive' => $archive,
            'liste_fonctions_disciplines' => $disciplines,
        );
        $this->db->where('liste_fonctions_id', $id);
        $this->db->update('liste_fonctions', $data);
    }

    

}
?>