<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class m_usagers extends CI_Model {
    
     public function __construct() {
        parent::__construct();
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');
    }

    /**
     * Récupère les données d'un usager 
     * @param string    $champs         Liste des champs nécessaires
     * @return array                    Un tableau avec les usagers
    **/
    public function getUsager($id,$champs = NULL)
    {
        if(empty($champs))
        {
            $champs = '*';
        }
        $this->db->select($champs);
        $this->db->from('enfant');
        $this->db->join('enfant_details', 'enfant_id = enfant_details_enfant_id', 'left');
        $this->db->join('enfant_medical', 'enfant_id = enfant_medical_enfant_id', 'left');
        $this->db->where('enfant_id', $id);
        $query = $this->db->get()->row();
        //echo $this->db->last_query();
        return $query;
    }

    /**
     * Liste des usagers non cloturé, de leurs responsables et leurs consentements 
     * 
     * @return array  Un tableau avec les usagers, les responsables et leurs consentements
    **/
    public function getUsagersAvecResponsables()
    {
        $this->db->select('
                    enfant_id,enfant_nom,enfant_prenom,enfant_courrier,enfant_mail,enfant_sms,enfant_courrier_refus,enfant_mail_refus,enfant_sms_refus,
                    service_id,service_nom,
                    mere_id,mere_civilite,mere_nom,mere_prenom,mere_mail,mere_sms,mere_courrier_refus,mere_mail_refus,mere_sms_refus,
                    pere_id,pere_civilite,pere_nom,pere_prenom,pere_mail,pere_sms,pere_courrier_refus,pere_mail_refus,pere_sms_refus,
                    tuteur_id,tuteur_civilite,tuteur_nom,tuteur_prenom,tuteur_mail,tuteur_sms,tuteur_courrier_refus,tuteur_mail_refus,tuteur_sms_refus
                    ');
        $this->db->from('enfant');
        $this->db->join('service', 'service_id = enfant_service_id', 'left');
        $this->db->join('mere', 'mere_enfant_id = enfant_id', 'left');
        $this->db->join('pere', 'pere_enfant_id = enfant_id', 'left');
        $this->db->join('tuteur', 'tuteur_enfant_id = enfant_id', 'left');
        $this->db->where_in('enfant_service_id', explode(",", $_SESSION['services']));
        $this->db->where('enfant_archive <>', 'x');
        $this->db->group_by('enfant_id');
        //$this->db->limit(10);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result();
    }

    /**
     * Liste des usagers non cloturés 
     * @param string    $champs         Liste des champs nécessaires
     * @return array                    Un tableau avec les usagers
    **/
    public function getUsagersNonClos($champs = NULL)
    {
        if(empty($champs))
        {
            $champs = 'enfant_id, enfant_nom, enfant_prenom, service_id, service_nom';
        }
        $this->db->select($champs);
        $this->db->from('enfant');
        $this->db->join('service', 'service_id = enfant_service_id', 'left');
        $this->db->where_in('enfant_service_id', explode(",", $_SESSION['services']));
        $this->db->where('enfant_archive <>', 'x');
        $this->db->group_by('enfant_id');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result();
    }

    

}
?>