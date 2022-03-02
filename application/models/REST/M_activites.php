<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class m_activites extends CI_Model {
    
     public function __construct() {
        parent::__construct();
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');
    }

    /**
     * Activités en présentiel regroupées par usager 
     *
     * @param string    $services         Liste des services séparés par des virgules
     * @param timestamp $dateDebut        Date de début de la période
     * @param timestamp $dateFin          Date de fin de la période
     * @param string    $nonLieu          realise, non_realise ou vide (toute activité) : suivant le non lieu (activite_absence) rempli dans l'activité
     * 
     * @return array    Un tableau contenant le total des activités concernées par enfant
    **/
    public function getActivitesByUsagerPresentiel($services,$dateDebut,$dateFin,$nonLieu) {

        $this->db->select('count(*) as nb, enfant_id, enfant_nom, enfant_prenom, service_nom');
        $this->db->from('activite');
        $this->db->join('discipline', 'discipline_id = activite_discipline_id', 'left');
        $this->db->join('enfant', 'enfant_id = activite_enfant_id', 'left');
        $this->db->join('service', 'service_id = enfant_service_id', 'left');
        $this->db->where('discipline_aupres_enfant = ',"oui");
        $this->db->where('activite_enfant_id <> ',0);
        $this->db->where('activite_date_debut >= ',$dateDebut);
        $this->db->where('activite_date_fin <= ',$dateFin);
        $this->db->where_in('activite_service_id', explode(',',$services));
        if($nonLieu == 'realise')
        {
            $this->db->group_start();
            $this->db->where('activite_absence','');
            $this->db->or_where('activite_absence',NULL);
            $this->db->group_end();
        }elseif($nonLieu == 'non_realise'){
            $this->db->group_start();
            $this->db->where('activite_absence <> ','');
            $this->db->where('activite_absence IS NOT NULL');
            $this->db->group_end();
            //$absences_service = array('3', '4', '5');
            //$this->db->where_not_in('activite_absence', $absences_service);
        }
        $this->db->group_by("activite_enfant_id");
        $query = $this->db->get();
        $result = $query->result_array();
        //echo $this->db->last_query();
        return $result;
       
    }

    /**
     * Activités en présentiel regroupées par service 
     *
     * @param string    $services          Liste des services séparés par des virgules
     * @param timestamp $dateDebut         Date de début de la période
     * @param timestamp $dateFin           Date de fin de la période
     * @param string    $nonLieu           realise, non_realise ou vide (toute activité) : suivant le non lieu (activite_absence) rempli dans l'activité
     * @param string    $typePresentiel    present, concernant, sans ou vide (toute activité) : suivant le type de "présence" de l'usager en fonction de la discipline
     * 
     * @return array    Un tableau contenant le total des activités concernées par type d'absence et de service
    **/
    public function getActivitesByService($services,$dateDebut,$dateFin,$nonLieu,$typePresentiel) {

        $this->db->select('count(*) as nb, service_id, service_nom, activite_absence, discipline_id, discipline_libelle, discipline_aupres_enfant, discipline_concernant_enfant, discipline_sans_enfant');
        $this->db->from('activite');
        $this->db->join('discipline', 'discipline_id = activite_discipline_id', 'left');
        $this->db->join('service', 'service_id = activite_service_id', 'left');
        $this->db->where('activite_enfant_id <> ',0);
        $this->db->where('activite_date_debut >= ',$dateDebut);
        $this->db->where('activite_date_fin <= ',$dateFin);
        $this->db->where_in('activite_service_id', explode(',',$services));
        
        if($nonLieu == 'realise')
        {
            $this->db->group_start();
            $this->db->where('activite_absence','');
            $this->db->or_where('activite_absence',NULL);
            $this->db->group_end();
        }elseif($nonLieu == 'non_realise'){
            $this->db->group_start();
            $this->db->where('activite_absence <> ','');
            $this->db->where('activite_absence IS NOT NULL');
            $this->db->group_end();
            //$absences_service = array('3', '4', '5');
            //$this->db->where_not_in('activite_absence', $absences_service);
        }

        if($typePresentiel == 'present')
        {
            $this->db->where('discipline_aupres_enfant = ',"oui");
        }elseif($typePresentiel == 'concernant'){
            $this->db->where('discipline_concernant_enfant = ',"oui");
        }elseif($typePresentiel == 'sans'){
            $this->db->where('discipline_sans_enfant = ',"oui");
        }

        $this->db->group_by("activite_absence, discipline_libelle, activite_service_id");
        $this->db->order_by("activite_service_id, discipline_libelle, activite_absence");
        $query = $this->db->get();
        $result = $query->result_array();
        //echo $this->db->last_query();
        return $result;
       
    }

    /**
     * Liste des Activités 
     *
     * @param string    $services          Liste des services séparés par des virgules
     * @param timestamp $dateDebut         Date de début de la période
     * @param timestamp $dateFin           Date de fin de la période
     * @param string    $nonLieu           realise, non_realise ou vide (toute activité) : suivant le non lieu (activite_absence) rempli dans l'activité
     * @param string    $typePresentiel    present, concernant, sans ou vide (toute activité) : suivant le type de "présence" de l'usager en fonction de la discipline
     * 
     * @return array    Un tableau contenant les activités
    **/
    public function getListeActivitesByService($services,$dateDebut,$dateFin,$nonLieu,$typePresentiel) {

        $this->db->select('service_id, service_nom, activite_id, activite_date_debut, activite_date_fin, activite_enfant_multiple_num, activite_absence, discipline_id, discipline_libelle, discipline_aupres_enfant, discipline_concernant_enfant, discipline_sans_enfant, activite_therapeute, activite_enfant_id ');
        $this->db->from('activite');
        $this->db->join('discipline', 'discipline_id = activite_discipline_id', 'left');
        $this->db->join('service', 'service_id = activite_service_id', 'left');
        //$this->db->where('activite_enfant_id <> ',0);
        $this->db->where('activite_date_debut >= ',$dateDebut);
        $this->db->where('activite_date_fin <= ',$dateFin);
        $this->db->where_in('activite_service_id', explode(',',$services));
        
        if($nonLieu == 'realise')
        {
            $this->db->group_start();
            $this->db->where('activite_absence','');
            $this->db->or_where('activite_absence',NULL);
            $this->db->group_end();
        }elseif($nonLieu == 'non_realise'){
            $this->db->group_start();
            $this->db->where('activite_absence <> ','');
            $this->db->where('activite_absence IS NOT NULL');
            $this->db->group_end();
            //$absences_service = array('3', '4', '5');
            //$this->db->where_not_in('activite_absence', $absences_service);
        }

        if($typePresentiel == 'present')
        {
            $this->db->where('discipline_aupres_enfant = ',"oui");
        }elseif($typePresentiel == 'concernant'){
            $this->db->where('discipline_concernant_enfant = ',"oui");
        }elseif($typePresentiel == 'sans'){
            $this->db->where('discipline_sans_enfant = ',"oui");
        }

        $this->db->order_by("activite_date_debut");
        $query = $this->db->get();
        $result = $query->result_array();
        //echo $this->db->last_query();
        return $result;
       
    }

    /**
     * Activités pour un intervenant 
     *
     * @param int       $intervenant      ID de l'intervenant
     * @param timestamp $dateDebut        Date de début de la période
     * @param timestamp $dateFin          Date de fin de la période
     * @param string    $nonLieu          realise, non_realise ou vide (toute activité) : suivant le non lieu (activite_absence) rempli dans l'activité
     * 
     * @return array    Un tableau contenant le total des activités concernées par enfant
    **/
    public function getActivitesByIntervenant($intervenant,$champs,$dateDebut = NULL,$dateFin = NULL,$nonLieu = NULL) {

        if($champs)
        {
            $this->db->select($champs);
        }else{
            $this->db->select('activite_id, activite_date_debut, activite_date_fin, activite_enfant_multiple_num, activite_absence, discipline_id, discipline_libelle, discipline_aupres_enfant, discipline_concernant_enfant, discipline_sans_enfant, activite_therapeute, activite_enfant_id ');
        }
        $this->db->from('activite');
        $this->db->join('discipline', 'discipline_id = activite_discipline_id', 'left');
        $this->db->join('enfant', 'enfant_id = activite_enfant_id', 'left');
        $this->db->where('FIND_IN_SET ("'.$intervenant.'", activite_therapeute)');
        if($dateDebut)
        {
            $this->db->where('activite_date_debut >= ',$dateDebut);
        }
        if($dateFin)
        {
            $this->db->where('activite_date_fin <= ',$dateFin);
        }
        if($nonLieu == 'realise')
        {
            $this->db->group_start();
            $this->db->where('activite_absence','');
            $this->db->or_where('activite_absence',NULL);
            $this->db->group_end();
        }elseif($nonLieu == 'non_realise'){
            $this->db->group_start();
            $this->db->where('activite_absence <> ','');
            $this->db->where('activite_absence IS NOT NULL');
            $this->db->group_end();
        }
        $this->db->order_by("activite_date_debut DESC");
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->row();
        //echo $this->db->last_query();
        if($result){
            return $result;
        }else{
            $result = new stdClass();
            $result->date = NULL;
            return $result;
        }
    }

    /**
     * Activités en lien entre un usager et un intervenant 
     *
     * @param int       $usager           ID de l'usager
     * @param int       $intervenant      ID de l'intervenant
     * @param timestamp $dateDebut        Date de début de la période
     * @param timestamp $dateFin          Date de fin de la période
     * @param string    $nonLieu          realise, non_realise ou vide (toute activité) : suivant le non lieu (activite_absence) rempli dans l'activité
     * 
     * @return array    Un tableau contenant le total des activités concernées par enfant
    **/
    public function getActivitesByUsagerAndIntervenant($usager = NULL,$intervenant = NULL,$dateDebut = NULL,$dateFin = NULL,$nonLieu = NULL) {

        $this->db->select('DATE_FORMAT(FROM_UNIXTIME(activite_date_debut),"%d/%m/%Y") as date');
        $this->db->from('activite');
        $this->db->join('discipline', 'discipline_id = activite_discipline_id', 'left');
        $this->db->join('enfant', 'enfant_id = activite_enfant_id', 'left');
        $this->db->where('discipline_aupres_enfant',"oui");
        if($usager)
        {
            $this->db->where('activite_enfant_id',$usager);
        }
        if($intervenant)
        {
            $this->db->where('FIND_IN_SET ("'.$intervenant.'", activite_therapeute)');
        }
        if($dateDebut)
        {
            $this->db->where('activite_date_debut >= ',$dateDebut);
        }
        if($dateFin)
        {
            $this->db->where('activite_date_fin <= ',$dateFin);
        }
        if($nonLieu == 'realise')
        {
            $this->db->group_start();
            $this->db->where('activite_absence','');
            $this->db->or_where('activite_absence',NULL);
            $this->db->group_end();
        }elseif($nonLieu == 'non_realise'){
            $this->db->group_start();
            $this->db->where('activite_absence <> ','');
            $this->db->where('activite_absence IS NOT NULL');
            $this->db->group_end();
        }
        $this->db->order_by("activite_date_debut DESC");
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->row();
        //echo $this->db->last_query();
        if($result){
            return $result;
        }else{
            $result = new stdClass();
            $result->date = NULL;
            return $result;
        }
        
       
    }

    /**
     * Date de la dernière activité ayant le regroupement en paramètre
     *
     * @param int       $usager           ID de l'usager
     * @param int       $regroupement     ID du regroupement de discipline
     * @param timestamp $dateDebut        Date de début de la période
     * @param timestamp $dateFin          Date de fin de la période
     * 
     * @return object   date              Date de la dernière activité
    **/
    public function getActivitesByRegroupement($usager,$regroupement,$dateDebut = NULL,$dateFin = NULL) {

            $this->db->select('DATE_FORMAT(FROM_UNIXTIME(activite_date_debut),"%d/%m/%Y") as date');
            $this->db->from('activite');
            $this->db->join('discipline', 'discipline_id = activite_discipline_id', 'left');
            $this->db->where('activite_enfant_id',$usager);
            $this->db->where('discipline_regroupement',$regroupement);
            if($dateDebut)
            {
                $this->db->where('activite_date_debut >= ',$dateDebut);
            }
            if($dateFin)
            {
                $this->db->where('activite_date_fin <= ',$dateFin);
            }
            $this->db->group_start();
            $this->db->where('activite_absence','');
            $this->db->or_where('activite_absence',NULL);
            $this->db->group_end();
            $this->db->order_by("activite_date_debut DESC");
            $this->db->limit(1);

            $query = $this->db->get();
            $result = $query->row();
            //echo $this->db->last_query();
            if($result){
                return $result;
            }else{
                $result = new stdClass();
                $result->date = NULL;
                return $result;
            }
    }

    /**
     * Liste des activités réalisées d'un usager sur une période
     *
     * @param int       $idUsager           ID de l'usager
     * @param timestamp $dateDebut        Date de début de la période
     * @param timestamp $dateFin          Date de fin de la période
     * 
     * @return object                     Liste des activités
    **/
    public function getActivitesByUsagerRealise($idUsager,$dateDebut,$dateFin) {

        $this->db->select('activite_id, activite_date_debut, discipline_libelle');
        $this->db->from('activite');
        $this->db->join('enfant', 'activite_enfant_id = enfant_id', 'left');
        $this->db->join('discipline', 'discipline_id = activite_discipline_id', 'left');
        $this->db->where('activite_enfant_id', $idUsager);
        $this->db->where('activite_date_debut >=', $dateDebut);
        $this->db->where('activite_date_fin <=', $dateFin);
        $this->db->group_start();
            $this->db->where('activite_absence','');
            $this->db->or_where('activite_absence',NULL);
        $this->db->group_end();
        $this->db->order_by('activite_date_debut');
        $query = $this->db->get();
        $result = $query->result();
        //echo $this->db->last_query();
        return $result;
        
    }

    /**
     * Supprime une activité
     *
     * @param int       $idActivite       ID de l'activité
     * @param str       $urlRetour        URL de retour
     * 
     * @return void
    **/
    public function deleteActivite($idActivite,$urlRetour = NULL) {

        $this->db->where('activite_id', $idActivite);
        $result = $this->db->delete('activite');
        //------------------------------------------------------------------------ A FAIRE COPIE DANS LA TABLE ACTIVITE SAVE
        //echo $this->db->last_query();
        return $result;
        if($urlRetour)
        {
            redirect($urlRetour);
        }
        
}

}
?>