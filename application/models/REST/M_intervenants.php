<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class m_intervenants extends CI_Model {
    
     public function __construct() {
        parent::__construct();
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');
    }

    /**
     * Information de l'intervenant 
     * 
     * @return array  
    **/
    public function getIntervenant($id) 
    {
        $this->db->select('*');
        $this->db->from('personnel');
        $this->db->where('personnel_id', $id);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }
    public function getIntervenants() 
    {
        $this->db->select('*');
        $this->db->from('personnel');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function getIntervenantsByName($name) 
    {
        $this->db->select('personnel_id');
        $this->db->from('personnel');
        $this->db->where('personnel_nom', $name);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }
    /**
     * Information de l'intervenant avec selection des champs
     * 
     * @return array  
    **/
    public function getIntervenantChamps($id,$champs) 
    {
        if(!empty($id))
        {
            $this->db->select($champs);
            $this->db->from('personnel');
            $this->db->where('personnel_id', $id);
            $query = $this->db->get();
            $result = $query->row();
        }else{
            $result = new stdClass();
            foreach(explode(',',$champs) as $champ)
            {
                $result->$champ = NULL;
            }
        }
        return $result;
    }

    public function updateIntervenantDisciplines($id,$disciplines) 
    {
        $data = array(
            'personnel_disciplines' => $disciplines,
        );
        $this->db->where('personnel_id', $id);
        $this->db->update('personnel', $data);
    }
    
    //Liste Intervenants / Enfant
    public function Liste_Enfant_Intervenants($enfant_id,$nb_mois)
    {
        global $pdo;
        $temps = mktime(0,0,0,date('n')-$nb_mois,date('j'),date('Y')); //jour  - x mois
        $this->db->select('activite_id, activite_therapeute, activite_enfant_id');
        $this->db->from('activite');
        $this->db->join('discipline', 'activite_discipline_id = discipline_id', 'left');
        $this->db->where('discipline_aupres_enfant','oui');
        $this->db->where('activite_date_debut >= ',$temps);
        $this->db->where('activite_enfant_id',$enfant_id);
        $this->db->group_by("activite_therapeute");
        $query = $this->db->get();
        $data = $query->result_array();
        $liste_intervenants = array();
        //echo $this->db->last_query();
        foreach($data as $ligne)//tableau des activités
        {
            foreach(explode(',',$ligne['activite_therapeute']) as $intervenants)//liste les intervenants
            {
                $liste_intervenants[$enfant_id][] = $intervenants;
            }
        }
        if(!empty($liste_intervenants[$enfant_id]))
        {
            return array_unique($liste_intervenants[$enfant_id]);//supprime les doublons
        }else{
            return array();
        }
    }

    /**
     * Ajout d'un Intervenant
     * @param  array Infos venant de la base RPPS+ 
     * @return int   ID de l'intervenant renseigné  
    **/
    public function AddIntervenant($data)
    {
        //Génère le Mot de Passe avec le préfixe et le nom de l'intervenant
        $mdp = Get_Parametre(82).$data->{'Nom_exercice'};
        //Trouve l'id du métier dans la base sinon : 0
        $profession = (!empty($this->getFonction($data->{'Libellé profession'}))) ? $this->getFonction($data->{'Libellé profession'}) : '0';
        //Coche les services en fonctions des finess renseignés
        $service = $this->getService($data->{'Numéro FINESS site'});
        $serviceListe = NULL;
        foreach($service as $serviceId)
        {
            $serviceListe .= $serviceId['service_id'].',';
        }

        //Requete d'insertion
        $insertData = array(
            'personnel_nom' => $data->{'Nom_exercice'},
            'personnel_prenom' => $data->{'Prenom_exercice'},
            'personnel_niveau' => $data->{'Prenom_exercice'},
            'personnel_mdp' => password_hash($mdp, PASSWORD_BCRYPT),
            'personnel_mdp_time' => date('Y-m-d'),
            'personnel_numero_medecin' => $data->{'Identifiant PP'},
            'personnel_profession' => $profession,
            'personnel_service_id' => rtrim($serviceListe,','),
            'personnel_niveau' => '4',
            'personnel_adresse1' => $data->{'Numéro Voie (coord. structure)'}.' '.$data->{'Libellé type de voie (coord. structure)'}.' '.$data->{'Libellé Voie (coord. structure)'},
            'personnel_cp' => $data->{'Code postal (coord. structure)'},
            'personnel_ville' => $data->{'Libellé commune (coord. structure)'},
            'personnel_mail' => $data->{'Adresse e-mail (coord. structure)'},
            'personnel_tel' => $data->{'Téléphone (coord. structure)'},
            
        );        
        $this->db->insert('personnel', $insertData);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }

    //Trouve l'id de la fonction par le métier
    public function getFonction($fonction)
    {
        $this->db->select("liste_fonctions_id");
        $this->db->from('liste_fonctions');
        $this->db->where('liste_fonctions_libelle', $fonction);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            $result = $query->row();
            return $result->liste_fonctions_id;
        }
        return NULL;
    }

    //Trouve l'id du type de contact par le libellé
    public function getFonctionContact($fonction)
    {
        $this->db->select("contact_type_id");
        $this->db->from('contact_type');
        $this->db->like('contact_type_libelle', $fonction);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            $result = $query->row();
            return $result->contact_type_id;
        }
        return NULL;
    }

    //Trouve l'id du service par le FINESS
    public function getService($finess)
    {
        $this->db->select("service_id");
        $this->db->from('service');
        $this->db->where('service_finess', $finess);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            $result = $query->result_array();
            return $result;
        }
        return array();
    }

    //Trouve l'id de l'intervenant par le RPPS
    public function getIntervenantByRpps($rpps)
    {
        $this->db->select("personnel_id");
        $this->db->from('personnel');
        $this->db->where('personnel_numero_medecin', $rpps);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            $result = $query->row();
            return $result->personnel_id;
        }
        return NULL;
    }

    //MAJ du numéro RPPS de l'intervenant 
    public function updateRppsIntervenant($rpps,$intervenantId)
    {
        $data = array(
            'personnel_numero_medecin' => $rpps,
        );
        $this->db->where('personnel_id', $intervenantId);
        $this->db->update('personnel', $data);
    }

    /**
     * Ajout d'un Contact
     * @param  array Infos venant de la base RPPS+ 
     * @return int   ID du contact renseigné  
    **/
    public function AddContact($data)
    {
        //Trouve l'id du métier dans la base sinon : 0
        $type = (!empty($this->getFonctionContact($data->{'Libellé profession'}))) ? $this->getFonctionContact($data->{'Libellé profession'}) : '0';
        //Civilité
        $civilite = array('Madame'=>'Mme','Mademoiselle'=>'Mme','Monsieur'=>'M.');

        //Requete d'insertion
        $insertData = array(
            'contact_civilite' => $civilite[$data->{'Libellé civilité'}],
            'contact_nom' => $data->{'Nom_exercice'},
            'contact_structure' => $data->{'Raison sociale site'},
            'contact_prenom' => $data->{'Prenom_exercice'},
            'contact_rpps' => $data->{'Identifiant PP'},
            'contact_type' => $type,
            'contact_adresse1' => $data->{'Numéro Voie (coord. structure)'}.' '.$data->{'Libellé type de voie (coord. structure)'}.' '.$data->{'Libellé Voie (coord. structure)'},
            'contact_cp' => $data->{'Code postal (coord. structure)'},
            'contact_ville' => $data->{'Libellé commune (coord. structure)'},
            'contact_mail' => $data->{'Adresse e-mail (coord. structure)'},
            'contact_tel' => $data->{'Téléphone (coord. structure)'},
            
        );        
        $this->db->insert('contact', $insertData);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }

    /**
     * Ajout d'un Contact structure
     * @param  array Infos venant de la base FINESS 
     * @return int   ID du contact renseigné  
    **/
    public function AddContactStructure($data)
    {
        //Requete d'insertion
        $insertData = array(
            'contact_structure' => $data->{'nom_court'},
            'contact_finess_site' => $data->{'finess'},
            'contact_finess_rattachement' => $data->{'finess_rattachement'},
            'contact_adresse1' => $data->{'adresse_numero'}.' '.$data->{'adresse_type'}.' '.$data->{'adresse_rue_1'},
            'contact_cp' => substr($data->{'code_postal_ville'}, 0, 5),
            'contact_ville' => substr($data->{'code_postal_ville'},6),
            'contact_tel' => $data->{'telephone_1'},
        );        
        $this->db->insert('contact', $insertData);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }

    //Trouve l'id du contact par le RPPS
    public function getContactByRpps($rpps)
    {
        $this->db->select("contact_id");
        $this->db->from('contact');
        $this->db->where('contact_rpps', $rpps);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            $result = $query->row();
            return $result->contact_id;
        }
        return NULL;
    }

    //MAJ des infos du service
    public function updateService($serviceId,$data,$dataDetails)
    {
        if(!empty($data))
        {
            $this->db->where('service_id', $serviceId);
            $this->db->update('service', $data);
        }
        
        if(!empty($dataDetails))
        {
            $this->db->where('service_details_id', $serviceId);
            $this->db->update('service_details', $dataDetails);
        }

        if(!empty($dataDetails) or !empty($data))
        {
            return 'Les informations ont été mises à jour. Merci de réactualiser la page du service après avoir fermé cette fenêtre.';
        }else{
            return 'Pas de mise à jour effectuée.';
        }
        
    }
    

}
?>
