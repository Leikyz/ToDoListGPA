<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
* Gestion des DIPC / PPA / PIA ...
*
* @author André Maillard 23/04/2021
* @ACCES    par niveau et service en fonction de l'usager
* @LOG      table log
* @RGPD     pas de données sensibles
*/

class c_dipc extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //ACCES sur le niveau 
        //$acces = new Acces; 
        //if($acces->AfficheZone('niveau', '1,3,4,5,7')=='N')
        //{ 
        //    show_error("Le niveau d'accès requis n'est pas atteint pour afficher cette page.","1","Accès refusé");
        //}
        //formatage heure locale
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');
    }
	
    /**
     * Création d'un DIPC 
     * @param int $usagerId     ID de l'usager
     * @param int $dipcId       non utilisé
     * @return view  
    **/
    public function insertDipc($usagerId,$dipcId = NULL) {

        //Contrôle l'accès par service et le niveau
        $usagerService = Get_Enfant_Champ($usagerId, 'enfant_service_id');
        //$acces = new Acces;
        /*if( $acces->AfficheZone('service', $usagerService['enfant_service_id'] ) == 'N')
        { 
            show_error("L'autorisation d'accès aux services concernés n'est pas accordée pour afficher cette page.","1","Accès refusé");
        }*/
        //if($acces->AfficheZone('niveau', '1,3,5,7')=='N')
        //{ 
        //    show_error("Le niveau d'accès requis n'est pas atteint pour afficher cette page.","1","Accès refusé");
        //}

        $this->load->helper('form');

        //Insertion des données
        if($this->input->post(NULL, TRUE))
        {
            $this->load->model('dipc/m_dipc');
            $ajoutDipc = $this->m_dipc->insertDipc($this->input->post(NULL, TRUE));
            redirect('/dipc/C_dipc/listDipc/'.$usagerId);
        }

        //Liste des types de DIPC
        $this->load->model('REST/m_liste_generale');
        $dipcTypeTab = $this->m_liste_generale->listeByType("DIPC_type", NULL, $orderBy = 'liste_generale_libelle');
        foreach($dipcTypeTab as $type)
        {
            $dipcType[$type['liste_generale_id']] = $type['liste_generale_libelle'];
        }
        
        //Liste des statuts de DIPC
        $this->load->model('REST/m_liste_generale');
        $dipcStatutTab = $this->m_liste_generale->listeByType("DIPC_statut", NULL, $orderBy = 'liste_generale_libelle');
        foreach($dipcStatutTab as $statut)
        {
            $dipcStatut[$statut['liste_generale_id']] = $statut['liste_generale_libelle'];
        }

        //Data pour le view
        $data['dipcType'] = $dipcType;
        $data['dipcStatut'] = $dipcStatut;
        $data['usager_id'] = $usagerId;
        $data['action'] = $this->router->method;
        $detailsDipc = array('dipc_date_debut'=>NULL,'dipc_date_fin'=>NULL,'dipc_type'=>NULL,'dipc_statut'=>NULL,'dipc_document'=>NULL);
        $data['detailsDipc'] = (object) $detailsDipc;





        
        // On peuple la variable data pour charger les bons script/css
        $data['scripts'] = array('jquery3', 'bootstrap', 'lte', 'datepicker');
        
        // Creation du bandeau 
        $data['title'] = 'Ajout';
        $data['titre'] = array('Ajout',"fa fa-book");
        $data['boutons'] = array(
                //array("Imprimer", "fa fa-print", null, "window.print()")
        );
        // On charge les differents modules neccessaires a l'affichage d'une page
        $this->load->view('template/header_html_base', $data);
        $this->load->view('template/header_scripts', $data);
        $this->load->view('template/bandeau', $data);
        $this->load->view('dipc/dipc_gestion', $data);
        $this->load->view('template/footer_scripts', $data);
        $this->load->view('template/footer_html_base', $data);
        
    }

    /**
     * Mise à jour d'un DIPC 
     * @param int $usagerId     ID de l'usager
     * @param int $dipcId       ID du DIPC a mettre a jour
     * @return view  
    **/
    public function updateDipc($usagerId,$dipcId) {
        //Contrôle l'accès par service et le niveau
        $usagerService = Get_Enfant_Champ($usagerId, 'enfant_service_id');
        //$acces = new Acces;
        /*if( $acces->AfficheZone('service', $usagerService['enfant_service_id'] ) == 'N')
        { 
            show_error("L'autorisation d'accès aux services concernés n'est pas accordée pour afficher cette page.","1","Accès refusé");
        }*/
        //if($acces->AfficheZone('niveau', '1,3,5,7')=='N')
        //{ 
         //   show_error("Le niveau d'accès requis n'est pas atteint pour afficher cette page.","1","Accès refusé");
        //}

        $this->load->helper('form');
        $this->load->model('dipc/m_dipc');

        //Récupération des données
        $detailsDipc = $this->m_dipc->getDipc($dipcId);

        //Suppression de l'élément
        if($this->input->post('supprimer'))
        {
            $deleteDipc = $this->m_dipc->deleteDipc($this->input->post('dipc_id'),$usagerId);
            redirect('/dipc/C_dipc/listDipc/'.$usagerId);
        }

        //MAJ des données
        if($this->input->post(NULL, TRUE))
        {
            $this->load->model('dipc/m_dipc');
            $updateDipc = $this->m_dipc->updateDipc($this->input->post(NULL, TRUE));
            redirect('/dipc/C_dipc/listDipc/'.$usagerId);
        }

        //Liste des types de DIPC
        $this->load->model('REST/m_liste_generale');
        $dipcTypeTab = $this->m_liste_generale->listeByType("DIPC_type", NULL, $orderBy = 'liste_generale_libelle');
        foreach($dipcTypeTab as $type)
        {
            $dipcType[$type['liste_generale_id']] = $type['liste_generale_libelle'];
        }
        
        //Liste des statuts de DIPC
        $this->load->model('REST/m_liste_generale');
        $dipcStatutTab = $this->m_liste_generale->listeByType("DIPC_statut", NULL, $orderBy = 'liste_generale_libelle');
        foreach($dipcStatutTab as $statut)
        {
            $dipcStatut[$statut['liste_generale_id']] = $statut['liste_generale_libelle'];
        }
        
        //Data pour le view
        $data['dipcStatut'] = $dipcStatut;
        $data['dipcType'] = $dipcType;
        $data['usager_id'] = $usagerId;
        $data['dipc_id'] = $dipcId;
        $data['action'] = $this->router->method;
        $data['detailsDipc'] = $detailsDipc;


        // On peuple la variable data pour charger les bons script/css
        $data['scripts'] = array('jquery3', 'bootstrap', 'lte', 'datepicker');
        
        // Creation du bandeau 
        $data['title'] = 'Mise à jour';
        $data['titre'] = array('Mise à jour',"fa fa-book");
        $data['boutons'] = array(
               // array("Imprimer", "fa fa-print", null, "window.print()"),
        );
        // On charge les differents modules neccessaires a l'affichage d'une page
        $this->load->view('template/header_html_base', $data);
        $this->load->view('template/header_scripts', $data);
        $this->load->view('template/bandeau', $data);
        $this->load->view('dipc/dipc_gestion', $data);
        $this->load->view('template/footer_scripts', $data);
        $this->load->view('template/footer_html_base', $data);
    }

    /**
     * Liste les DIPC d'un usager
     * @param int $usagerId     ID de l'usager
     * @return view  
    **/
    public function listDipc($usagerId) {
        //Contrôle l'accès par service
        $usagerService = Get_Enfant_Champ($usagerId, 'enfant_service_id');
        $acces = new Acces;
        /*if( $acces->AfficheZone('service', $usagerService['enfant_service_id'] ) == 'N')
        { 
            show_error("L'autorisation d'accès aux services concernés n'est pas accordée pour afficher cette page.","1","Accès refusé");
        }*/

        //Récupération des données
        $this->load->model('dipc/m_dipc');
        $listDipc = $this->m_dipc->listDipc($usagerId);
        
        $data['usager_id'] = $usagerId;
        $data['liste'] = $listDipc;

        // On peuple la variable data pour charger les bons script/css
        $data['scripts'] = array('jquery3', 'bootstrap', 'lte', 'datatables');
        
        // Creation du bandeau 
        $data['title'] = "Liste";
        $data['titre'] = array("Liste","fa fa-th-list");
        if($acces->AfficheZone('niveau', '1,3')=='O')
        { 
            $data['acces_modif'] = 'ok';
            $data['boutons'] = array(
                array("Ajouter", "fa fa-plus", '/dipc/C_dipc/insertDipc/'.$usagerId, "")
                );
        }else{
            $data['acces_modif'] = 'nok';
            $data['boutons'] = array();
        }

        // On charge les differents modules neccessaires a l'affichage d'une page
        $this->load->view('template/header_html_base', $data);
        $this->load->view('template/header_scripts', $data);
        $this->load->view('template/bandeau', $data);
        $this->load->view('dipc/dipc_liste', $data);
        $this->load->view('template/footer_scripts', $data);
        $this->load->view('template/footer_html_base', $data);
        
    }

}
