<?php 

class todolist extends CI_Controller {

    public function __construct()
    {
        
    }

    public function listDipc($usagerId) {
        //Contrôle l'accès par service
        $usagerService = Get_Enfant_Champ($usagerId, 'enfant_service_id');
        /*if( $acces->AfficheZone('service', $usagerService['enfant_service_id'] ) == 'N')
        { 
            show_error("L'autorisation d'accès aux services concernés n'est pas accordée pour afficher cette page.","1","Accès refusé");
        }*/

        //Récupération des données
        $this->load->model('todolist/todolist');
        $listTodo = $this->todolist->listDipc($usagerId);
        
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