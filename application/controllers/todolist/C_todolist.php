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
        $listTaches[$tache->tache_id]['intervenant_nom'] = $tache->personnel_nom. ' ' . $tache->personnel_prenom; 
        $listTaches[$tache->tache_id]['service'] = $tache->service_nom;
        $listTaches[$tache->tache_id]['note'] = $tache->tache_commentaire;
        $listTaches[$tache->tache_id]['status'] = $tache->status_nom;
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
        $listTaches[$tache->tache_id]['intervenant_nom'] = $tache->personnel_nom. ' ' . $tache->personnel_prenom; 
        $listTaches[$tache->tache_id]['service'] = $tache->service_nom;
        $listTaches[$tache->tache_id]['note'] = $tache->tache_commentaire;
        $listTaches[$tache->tache_id]['status'] = $tache->status_nom;
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

        $this->load->model('todolist/m_todolist');
        $this->load->model('REST/m_services');
        $this->load->model('REST/m_intervenants');
        $this->load->helper('form');

        if($this->input->post(NULL, TRUE))
        {
            $nbIntervenants = $this->input->post('intervenant');
            foreach ($nbIntervenants as $intervenants)
            {
                $addTask = $this->m_todolist->insertTask($this->input->post(NULL, TRUE), $intervenants);
            }
            redirect('/todolist/C_todolist');
        }

        $data['scripts'] = array('jquery3', 'bootstrap', 'lte', 'datepicker','datatables', 'select2');

        $data['custom_script'] = "
                <script>
                    $(document).ready(function() {
                        $('.select2').select2();
                    });
                </script>";
        // Creation du bandeau 
        $intervenants = $this->m_intervenants->listIntervenants();
        $services = $this->m_services->listServices();
        foreach($intervenants as $intervenant)
        {
            $intervenantInfos[$intervenant['personnel_id']] = $intervenant['personnel_prenom'].' '.$intervenant['personnel_nom'];
        }
        foreach($services as $service)
        {
            $servicesInfo[$service['service_id']] = $service['service_nom'];
        }
       // var_dump($intervenants);
        $data['service'] = $servicesInfo;
        $data['list_intervenant'] = $intervenantInfos;
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

        //print_r($listTask);
        $intervenants = $this->m_intervenants->listIntervenants();
        $services = $this->m_services->listServices();
        $status = $this->m_todolist->getTaskStatus();
        foreach($status as $statu)
        {
            $statusInfos[$statu['status_id']] = $statu['status_nom'];
        }
        foreach($intervenants as $intervenant)
        {
            $intervenantInfos[$intervenant['personnel_id']] = $intervenant['personnel_prenom'].' '.$intervenant['personnel_nom'];
        }
        foreach($services as $service)
        {
            $servicesInfo[$service['service_id']] = $service['service_nom'];
        }

        $data['scripts'] = array('jquery3', 'bootstrap', 'lte', 'datepicker','datatables');
        $data['service'] = $servicesInfo;
        $data['status'] = $statusInfos;
        $data['list_intervenant'] = $intervenantInfos;
        $data['task'] = $this->m_todolist->getTaskInfos($taskId);
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

