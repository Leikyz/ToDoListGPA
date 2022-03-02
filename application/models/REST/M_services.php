<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class m_services extends CI_Model {
    
     public function __construct() {
        parent::__construct();
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');
    }
    
    public function getUserServices() {
    //public function getServicesByIds() {

        $this->db->select('*');
        $this->db->from('service');
        $this->db->where_in('service_id', explode(',',$_SESSION['services']));
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
       
    }

    //public function getUserServicesByType($type) {
    public function getServicesByType($type) {

        $this->db->select('*');
        $this->db->from('service');
        $this->db->where_in('service_id', explode(',',$_SESSION['services']));
        $this->db->where('service_type', $type);
        $query = $this->db->get();
        $result = $query->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    //$format array ou str
    public function getServicesIDByType($type,$format = 'array') {

        $service_str = NULL;
        $this->db->select('service_id');
        $this->db->from('service');
        $this->db->where_in('service_id', explode(',',$_SESSION['services']));
        $this->db->where('service_type', $type);
        $query = $this->db->get();
        $result = $query->result();
        if($format == 'string')
        {
            foreach($result as $service)
            {
                $service_str .= $service->service_id.',';
            }
            $result = trim($service_str,',');
        }
       
        return $result;
    }

    

}
?>