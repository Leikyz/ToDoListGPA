<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_usagers_accompagnement extends CI_Model {
    	
	
    public function Liste_Accompagnement($id_enfant) {
		
		$where = array('activite_enfant_id'=>$id_enfant, 'discipline_aupres_enfant'=>'oui', 'discipline_id > '=>'5900');
		
        $this->db->select('activite_discipline_id, discipline_libelle, MIN(activite_date_debut) as DD, MAX(activite_date_fin) as DF, activite_therapeute');
        $this->db->from('activite');
		$this->db->join('discipline', 'discipline_id = activite_discipline_id');
        $this->db->where($where);
        $this->db->group_start();
            $this->db->where('activite_absence','');
            $this->db->or_where('activite_absence',NULL);
        $this->db->group_end();
		$this->db->group_by('activite_therapeute, activite_discipline_id');
        $this->db->order_by('activite_date_fin', 'desc');
        $query = $this->db->get();
        //echo $this->db->last_query();
		$results=$query->result_array();
		return ($results) ? $results : NULL;
		
    }
	

}

