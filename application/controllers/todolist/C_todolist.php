<?php
//To-Do List
//Controllers V1 - 01/03/2022
//Projet Stage

//Création
class c_todolist extends CI_Controller {

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


    public function index() {
        $this->load->model('todolist/M_todolist');


        $listTask = $this->M_todolist->listTask(1);
        //print_r($listTask);
        foreach($listTask as $tache)
        {
            $listTaches[$tache->tache_id]['id'] = $tache->tache_id;
            $listTaches[$tache->tache_id]['titre'] = $tache->tache_titre;
            $listTaches[$tache->tache_id]['contenu'] = $tache->tache_contenu;
            $listTaches[$tache->tache_id]['dateCreation'] = $tache->tache_creation_date;
            $listTaches[$tache->tache_id]['intervenant'] = $tache->tache_service_id; 
            $listTaches[$tache->tache_id]['service'] = $tache->tache_service_id;
        }

        //DATA VIEW
        $data['task'] = $listTaches;

    
        // On peuple la variable data pour charger les bons script/css
        $data['scripts'] = array('jquery3', 'bootstrap', 'lte', 'datepicker','datatables');
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
        //View accès chaque fonction
        $this->load->view('todolist/todolist', $data);
        $this->load->view('template/footer_scripts', $data);
        $this->load->view('template/footer_html_base', $data);
        
    }
// Fonction -> Affiche, Creation, Modif -> 3 view
// Index -> Modif nom
}

