<?php

namespace App\Controllers\Backend;

use App\Controllers\AdminController;

class PackageController extends AdminController
{
    public function index()
    {
        //
    }


    //View All packages
    public function viewAllPackages(){


        $data = array();
        $this-> render_view("Backend/pages/packages/all_packages",$data);
    }


    //AJAX Call All packages
    public function ajaxCallAllPackages(){

        $params['draw'] = $_REQUEST['draw'];
        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];
        /* If we pass any extra data in request from ajax */
        //$value1 = isset($_REQUEST['key1'])?$_REQUEST['key1']:"";

        $valueStatus = isset($_REQUEST['status'])?$_REQUEST['status']:"";
       

        /* Value we will get from typing in search */
        $search_value = $_REQUEST['search']['value'];

        if(!empty($search_value)){

                 
            $builder = $this->db->table('packages');
            $builder->select('*');
            $builder->like('name', $search_value);
            $query = $builder->get();
            $total_count = $query->getResult();       
            
            
            $builder = $this->db->table('packages');
            $builder->select('*');
            $builder->like('name', $search_value);
            $builder->limit($start, $length);
            $query2 = $builder->get();
            $data = $query2->getResult();

           // $data = $this->db->query("SELECT * from users WHERE mobile like '%".$search_value."%' OR name like '%".$search_value."%' limit $start, $length")->getResult();
                      
        }
        
        else if(!empty($valueStatus)){
            // If we have value in search, searching by id, name, email, mobile

                //  $total_count = $this->db->query("SELECT * from users WHERE status=".$valueStatus."")->getResult();
                //  $data = $this->db->query("SELECT * from users WHERE status=".$valueStatus."")->getResult();
            

                 $builder = $this->db->table('packages');
                 $builder->select('*');
                 $builder->where('is_active', $valueStatus);
                 $query = $builder->get();
                 $total_count = $query->getResult();       
                 
                 
                 $builder = $this->db->table('packages');
                 $builder->select('*');
                 $builder->where('is_active', $valueStatus);
                 $builder->limit($start, $length);
                 $query2 = $builder->get();
                 $data = $query2->getResult();



        }        
        
        else{
                // count all data
  
                // $total_count = $this->db->query("SELECT * from users")->getResult();
                //  $data = $this->db->query("SELECT * from users limit $start, $length")->getResult(); 
                 
                 $builder = $this->db->table('packages');
                 $builder->select('*');
                 $query = $builder->get();
                 $total_count = $query->getResult();       
                 
                 
                 $builder = $this->db->table('packages');
                 $builder->select('*');
                 $builder->limit($start, $length);
                 $query2 = $builder->get();
                 $data = $query2->getResult();

        }
        
        $json_data = array(
            "draw" => intval($params['draw']),
            "recordsTotal" => count($total_count),
            "recordsFiltered" => count($total_count),
            "data" => $data   // total data array
        );

        echo json_encode($json_data);   



    }


}
