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
    $this->load->model('REST/M_intervenants');

    $listTask = $this->M_todolist->listTask();
    //print_r($listTask);
    foreach($listTask as $tache)
    {
        $listTaches[$tache->tache_id]['id'] = $tache->tache_id;
        $listTaches[$tache->tache_id]['titre'] = $tache->tache_titre;
        $listTaches[$tache->tache_id]['contenu'] = $tache->tache_contenu;
        $listTaches[$tache->tache_id]['dateCreation'] = $tache->tache_creation_date;
        $listTaches[$tache->tache_id]['intervenant'] = $tache->tache_intervenant_id; 
        $listTaches[$tache->tache_id]['intervenant_nom'] = $tache->tache_intervenant_id; 
        $listTaches[$tache->tache_id]['service'] = $tache->tache_service_id;
        $listTaches[$tache->tache_id]['archive'] = $tache->tache_archive;
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
public function index2() {
    $this->load->model('todolist/M_todolist');


    $listTask = $this->M_todolist->listTaskArchive();
    //print_r($listTask);
    foreach($listTask as $tache)
    {
        $listTaches[$tache->tache_id]['id'] = $tache->tache_id;
        $listTaches[$tache->tache_id]['titre'] = $tache->tache_titre;
        $listTaches[$tache->tache_id]['contenu'] = $tache->tache_contenu;
        $listTaches[$tache->tache_id]['dateCreation'] = $tache->tache_creation_date;
        $listTaches[$tache->tache_id]['intervenant'] = $tache->tache_service_id; 
        $listTaches[$tache->tache_id]['service'] = $tache->tache_service_id;
        $listTaches[$tache->tache_id]['archive'] = $tache->tache_archive;
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
    $this->load->view('todolist/todolist_archive', $data);
    $this->load->view('template/footer_scripts', $data);
    $this->load->view('template/footer_html_base', $data);

}
    public function insertTask() {

        $this->load->model('REST/m_services');
        $this->load->model('REST/m_intervenants');
        $this->load->helper('form');
        $nbIntervenants = $this->input->post('intervenant[]');
      
        if($this->input->post(NULL, TRUE))
        {
            foreach ($nbIntervenants as $intervenants)
            {
                $this->load->model('todolist/m_todolist');
                $addTask = $this->m_todolist->insertTask($this->input->post(NULL, TRUE), $intervenants);
            }
        }

        $data['scripts'] = array('jquery3', 'bootstrap', 'lte', 'datepicker','datatables', 'select2');
        // Creation du bandeau 
        $data['service'] = $this->m_services->getServices();
        $data['intervenants'] = $this->m_intervenants->getIntervenants();
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
        $this->load->view('todolist/todolist_create', $data);
        $this->load->view('template/footer_scripts', $data);
        $this->load->view('template/footer_html_base', $data);
        
    }
    public function updateTask($taskId) {

        $this->load->model('REST/m_services');
        $this->load->model('REST/m_intervenants');
        $this->load->model('todolist/m_todolist');

        $this->load->helper('form');

        if($this->input->post(NULL, TRUE))
        {
            $addTask = $this->m_todolist->updateTask($this->input->post(NULL, TRUE), $taskId);
        }

        $listTask = $this->m_todolist->getTask($taskId);

        $data['scripts'] = array('jquery3', 'bootstrap', 'lte', 'datepicker','datatables');
        // Creation du bandeau 
        $data['service'] = $this->m_services->getServices();
        $data['intervenants'] = $this->m_intervenants->getIntervenants();
        $data['task'] = $this->m_todolist->getTask($taskId);
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
        $this->load->view('todolist/todolist_update', $data);
        $this->load->view('template/footer_scripts', $data);
        $this->load->view('template/footer_html_base', $data);
        
    }
    public function putArchiveTask($taskId, $infoArchive){
        $this->load->model('todolist/m_todolist');

        $listTask = $this->m_todolist->putArchiveTask($taskId, $infoArchive);

        if($listTask)
        {
            // function logs 
        }
        redirect('/todolist/C_todolist/index2');
    }

    public function outArchiveTask($taskId, $infoArchive){
        $this->load->model('todolist/m_todolist');

        $listTask = $this->m_todolist->outArchiveTask($taskId, $infoArchive);

        if($listTask)
        {
            // function logs 
        }
        redirect('/todolist/C_todolist');
    }
// Fonction -> Affiche, Creation, Modif -> 3 view
// Index -> Modif nom
}

