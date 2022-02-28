<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
* Liste les activités par date avec les intervenants
*
* @author André Maillard 07/10/2021
* @ACCES    tous,
* @LOG      affichage seulement, pas de log
* @RGPD     pas de données personnelles
*/

class C_usagers_accompagnement extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $acces = new Acces;
        //ACCES sur le niveau
        if($acces->AfficheZone('niveau', '1,2,3,4,5,6,7')=='N'){ show_error("Le niveau d'accès requis n'est pas atteint pour afficher cette page.","1","Accès refusé");}
        //formatage heure locale
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');
    }

    public function index() {
		
        $this->load->model('usagers/M_usagers_accompagnement');
        $this->load->model('REST/M_usagers');
		
        $accompagementInfos = array();

		$listeAccompagnement = $this->M_usagers_accompagnement->Liste_Accompagnement($this->input->get('enfant_id'));
        $usagerInfos = $this->M_usagers->getUsager($this->input->get('enfant_id'),'enfant_nom,enfant_prenom') ;

        if(empty($listeAccompagnement))
        {
            $listeAccompagnement = array();
        }

        //Boucle sur les résultats pour construire un tableau
        foreach($listeAccompagnement as $accompagnement)
        {
            //Simplifcation des variables
            $disciplineId = $accompagnement['activite_discipline_id'];
            $intervenants = $accompagnement['activite_therapeute'];
            $libelle = $accompagnement['discipline_libelle'];

            //1er passage, création des éléments du tableau
            if(!isset($accompagementInfos[$disciplineId]))
            {
                $accompagementInfos[$disciplineId]['libelle'] =  $libelle;
                $accompagementInfos[$disciplineId]['DD'] = $accompagnement['DD'];
                $accompagementInfos[$disciplineId]['DF'] = $accompagnement['DF'];
                $accompagementInfos[$disciplineId]['intervenants'] = NULL;
                $accompagementInfos[$disciplineId]['intervenantsId'] = array();
                
            }else{
                //Prendre les dates les plus à l'extrême
                if($accompagementInfos[$disciplineId]['DD'] > $accompagnement['DD'])
                {
                    $accompagementInfos[$disciplineId]['DD'] = $accompagnement['DD'];
                }
                if($accompagementInfos[$disciplineId]['DF'] < $accompagnement['DF'])
                {
                    $accompagementInfos[$disciplineId]['DF'] = $accompagnement['DF'];
                }
               
            }
            //Concaténation des intervenants
            foreach(explode(',',$intervenants) as $intervenant)
            {
                //Evite les doublons
                if(!in_array($intervenant,$accompagementInfos[$disciplineId]['intervenantsId']))
                {
                    $accompagementInfos[$disciplineId]['intervenants'] .= Get_Personnel_Nom($intervenant).', ';
                }
                $accompagementInfos[$disciplineId]['intervenantsId'][] = $intervenant;
            }
            
        }
		$data["liste_accompagnement"] = $accompagementInfos;
		
		
        // On peuple la variable data pour charger les bons script/css
        $data['scripts'] = array('jquery3', 'bootstrap', 'lte',  'datepicker');

		// Creation du bandeau 
        $data['title'] = "Accompagnement" ;
        $data['titre'] = array("Accompagnement ".$usagerInfos->enfant_nom." ".$usagerInfos->enfant_prenom, "fa fa-user");
        $data['boutons'] = array(
                array("Imprimer", "fa fa-print", null, "window.print()")
        );
        // On charge les differents modules neccessaires a l'affichage d'une page
        $this->load->view('template/header_html_base', $data);
        $this->load->view('template/header_scripts', $data);
        $this->load->view('template/bandeau', $data);
        $this->load->view('usagers/V_usagers_accompagnement', $data);
        $this->load->view('template/footer_scripts', $data);
        $this->load->view('template/footer_html_base', $data);
    }

}
