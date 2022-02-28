<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class m_liste_generale extends CI_Model {
    
     public function __construct() {
        parent::__construct();
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');
    }

    /**
     * Liste par type 
     *
     * @param string    $listeGeneraleType     Le type de la liste
     * @param boolean   $archive               Par défaut : non archivé 
     * @param string    $orderBy               Par défaut : liste_generale_libelle
     * 
     * @return array    Un tableau des éléments en fonction du type
    **/
    public function listeByType($listeGeneraleType, $archive = NULL, $orderBy = 'liste_generale_libelle') {

        $this->db->select('*');
        $this->db->from('liste_generale');
        $this->db->where('liste_generale_type',$listeGeneraleType);
        if($archive == NULL)
        {
            $this->db->where(' (liste_generale_archive IS NULL OR liste_generale_archive <> 1) ');
        }else{
            $this->db->where('liste_generale_archive',1);
        }
        $this->db->order_by($orderBy);
        $query = $this->db->get();
        $result = $query->result_array();
        //echo $this->db->last_query();
        return $result;
       
    }

    /**
     * Récupère l'élément par l'ID 
     *
     * @param int       $id     l'ID de l'élément
     * 
     * @return array    Un tableau de l'élément
    **/
    public function getByID($id) {

        $this->db->select('*');
        $this->db->from('liste_generale');
        $this->db->where('liste_generale_id',$id);
        $query = $this->db->get();
        $result = $query->result_array();
        //echo $this->db->last_query();
        return $result;
       
    }

    /**
     * Retourne le libelle par l'ID 
     *
     * @param int       $id     l'ID de l'élément
     * 
     * @return string   Le libelle de l'élément
    **/
    public function getLibelleByID($id) {

        $this->db->select('liste_generale_libelle');
        $this->db->from('liste_generale');
        $this->db->where('liste_generale_id',$id);
        $query = $this->db->get();
        $result = $query->result_array();
        //echo $this->db->last_query();
        return $result['liste_generale_libelle'];
       
    }


}
?>