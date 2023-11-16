<?php

namespace App\Controllers\Backend;

use App\Controllers\AdminController;
use CodeIgniter\I18n\Time;

class ClientController extends AdminController
{

    //All Clients
    public function viewAllClients(){


        $data = array();
        $this-> render_view("Backend/pages/clients/all_clients",$data);

    }


    //Clients with active subscription
    public function viewAllClientsActive(){

        $data = array();
        $this-> render_view("Backend/pages/clients/active_clients",$data);

    }


    //Clients with expired subscription
    public function viewAllClientsExpired(){

        $data = array();
        $this-> render_view("Backend/pages/clients/expired_clients",$data);

    }
    //Clients with pending subscription
    public function viewAllClientsPending(){

        $data = array();
        $this-> render_view("Backend/pages/clients/pending_clients",$data);

    }


    //AJAX Call all clients
    public function ajaxCallAllClients(){

        $today = Time::today('Asia/Kolkata', 'en_IN');

        $params['draw'] = $_REQUEST['draw'];
        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];
        /* If we pass any extra data in request from ajax */
        //$value1 = isset($_REQUEST['key1'])?$_REQUEST['key1']:"";


        
        $valueStatus = isset($_REQUEST['status'])?$_REQUEST['status']:"";

        /* Value we will get from typing in search */
        $search_value = $_REQUEST['search']['value'];

        if(!empty($search_value)){


          
            $builder = $this->db->table('users');
            $builder->select('name, mobile , email, status, (SELECT COUNT(*) FROM subscriptions WHERE (subscriptions.client_id = users.u_id AND subscriptions.client_id != "1" AND subscriptions.ends_on >= now() )) as subscription');
            $builder->like('users.name', $search_value);
            $builder->where('users.u_id !=', 1);
            $query = $builder->get();
            $total_count = $query->getResult();           
            
            
            $builder = $this->db->table('users');
            $builder->select('name, mobile , email, status, (SELECT COUNT(*) FROM subscriptions WHERE (subscriptions.client_id = users.u_id AND subscriptions.client_id != "1" AND subscriptions.ends_on >= now() )) as subscription');
            $builder->like('users.name', $search_value);
            $builder->where('users.u_id !=', 1);
            $builder->limit($start, $length);
            $query2 = $builder->get();
            $data = $query2->getResult();   
             
        }

        else if(!empty($valueStatus)){
            // If we have value in search, searching by id, name, email, mobile

                //  $total_count = $this->db->query("SELECT * from users WHERE status=".$valueStatus."")->getResult();
                //  $data = $this->db->query("SELECT * from users WHERE status=".$valueStatus."")->getResult();
            

                $builder = $this->db->table('users');
                $builder->select('name, mobile , email, status, (SELECT COUNT(*) FROM subscriptions WHERE (subscriptions.client_id = users.u_id AND subscriptions.client_id != "1" AND subscriptions.ends_on >= now() )) as subscription');
                $builder->like('users.name', $search_value);
                $builder->where('users.u_id !=', 1);
                $query = $builder->get();
                $total_count = $query->getResult();           
                
                
                $builder = $this->db->table('users');
                $builder->select('name, mobile , email, status, (SELECT COUNT(*) FROM subscriptions WHERE (subscriptions.client_id = users.u_id AND subscriptions.client_id != "1" AND subscriptions.ends_on >= now() )) as subscription');
                $builder->like('users.name', $search_value);
                $builder->where('users.u_id !=', 1);
                $builder->limit($start, $length);
                $query2 = $builder->get();
                $data = $query2->getResult();   


        } 
             
        
        else{
                // count all data
                $builder = $this->db->table('users');
                $builder->select('name, mobile , email, status, (SELECT COUNT(*) FROM subscriptions WHERE (subscriptions.client_id = users.u_id AND subscriptions.client_id != "1" AND subscriptions.ends_on >= now() )) as subscription');
                $builder->where('users.u_id !=', 1);
                $query = $builder->get();
                $total_count = $query->getResult();           
                
                
                $builder = $this->db->table('users');
                $builder->select('name, mobile , email, status, (SELECT COUNT(*) FROM subscriptions WHERE (subscriptions.client_id = users.u_id AND subscriptions.client_id != "1" AND subscriptions.ends_on >= now() )) as subscription');
                $builder->where('users.u_id !=', 1);
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



    //AJAX Call Expired clients
    public function ajaxCallAllClientsActive(){

        $today = Time::today('Asia/Kolkata', 'en_IN');

        $params['draw'] = $_REQUEST['draw'];
        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];
        /* If we pass any extra data in request from ajax */
        //$value1 = isset($_REQUEST['key1'])?$_REQUEST['key1']:"";


        
        $valueStatus = isset($_REQUEST['status'])?$_REQUEST['status']:"";

        /* Value we will get from typing in search */
        $search_value = $_REQUEST['search']['value'];

        if(!empty($search_value)){


            $builder = $this->db->table('users');
            $builder->select('users.name, users.mobile , users.email, users.status, subscriptions.status as subscription');
            $builder->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left');
            $builder->like('users.name', $search_value);
            $builder->where('users.u_id !=', 1);
            $builder->where('subscriptions.status', 1);
            $builder->where('subscriptions.ends_on >=', $today);
            $builder->groupBy('users.u_id');
            $query = $builder->get();
            $total_count = $query->getResult();    

            $builder = $this->db->table('users');
            $builder->select('users.name, users.mobile , users.email, users.status, subscriptions.status as subscription');
            $builder->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left');
            $builder->like('users.name', $search_value);
            $builder->where('users.u_id !=', 1);
            $builder->where('subscriptions.status', 1);
            $builder->where('subscriptions.ends_on >=', $today);
            $builder->groupBy('users.u_id');
            $builder->limit($start, $length);
            $query2 = $builder->get();
            $data = $query2->getResult();   
             
        }

        else if(!empty($valueStatus)){
            // If we have value in search, searching by id, name, email, mobile

                //  $total_count = $this->db->query("SELECT * from users WHERE status=".$valueStatus."")->getResult();
                //  $data = $this->db->query("SELECT * from users WHERE status=".$valueStatus."")->getResult();
            

                $builder = $this->db->table('users');
                $builder->select('name, mobile , email, status, (SELECT COUNT(*) FROM subscriptions WHERE (subscriptions.client_id = users.u_id AND subscriptions.client_id != "1" AND subscriptions.ends_on >= now() )) as subscription');
                $builder->like('users.name', $search_value);
                $builder->where('users.u_id !=', 1);
                $query = $builder->get();
                $total_count = $query->getResult();           
                
                
                $builder = $this->db->table('users');
                $builder->select('name, mobile , email, status, (SELECT COUNT(*) FROM subscriptions WHERE (subscriptions.client_id = users.u_id AND subscriptions.client_id != "1" AND subscriptions.ends_on >= now() )) as subscription');
                $builder->like('users.name', $search_value);
                $builder->where('users.u_id !=', 1);
                $builder->limit($start, $length);
                $query2 = $builder->get();
                $data = $query2->getResult();   


        } 
             
        
        else{
                // count all data

                $builder = $this->db->table('users');
                $builder->select('users.name, users.mobile , users.email, users.status, subscriptions.status as subscription');
                $builder->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left');
                $builder->where('users.u_id !=', 1);
                $builder->where('subscriptions.status', 1);
                $builder->where('subscriptions.ends_on >=', $today);
                $builder->groupBy('users.u_id');
                $query = $builder->get();
                $total_count = $query->getResult();    




                $builder = $this->db->table('users');
                $builder->select('users.name, users.mobile , users.email, users.status, subscriptions.status as subscription');
                $builder->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left');
                $builder->where('users.u_id !=', 1);
                $builder->where('subscriptions.status', 1);
                $builder->where('subscriptions.ends_on >=', $today);
                $builder->groupBy('users.u_id');
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


    //AJAX Call Expired clients
    public function ajaxCallAllClientsExpired(){

        $today = Time::today('Asia/Kolkata', 'en_IN');

        $params['draw'] = $_REQUEST['draw'];
        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];
        /* If we pass any extra data in request from ajax */
        //$value1 = isset($_REQUEST['key1'])?$_REQUEST['key1']:"";


        
        $valueStatus = isset($_REQUEST['status'])?$_REQUEST['status']:"";

        /* Value we will get from typing in search */
        $search_value = $_REQUEST['search']['value'];

        if(!empty($search_value)){

            $hasSubscription = $this->db->table('users')
                                    ->select('*')
                                    ->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left')
                                    ->where('users.u_id !=', 1)
                                    ->where('subscriptions.status', 1)
                                    ->where('subscriptions.ends_on <', $today)
                                    ->groupBy('users.u_id')
                                    ->get();

            $total_count =$hasSubscription->getResult();  
            $data =$hasSubscription->getResult();  

            if(count($hasSubscription->getResult()) > 0){

            $isSubscriptionExpired = $this->db->table('users')
                                ->select('*')
                                ->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left')
                                ->where('users.u_id !=', 1)
                                ->where('subscriptions.status', 1)
                                ->where('subscriptions.ends_on >=', $today)
                                ->groupBy('users.u_id')
                                ->get();

            $total_count =$isSubscriptionExpired->getResult(); 
            $data =$isSubscriptionExpired->getResult();  

            //Expired Subscription
            if(count($isSubscriptionExpired->getResult()) == 0){

            $builder = $this->db->table('users')
                            ->select('users.name, users.mobile , users.email,users.status, subscriptions.status as subscription')
                            ->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left')
                            ->like('users.name', $search_value)
                            ->where('users.u_id !=', 1)
                            ->where('subscriptions.status', 1)
                            ->where('subscriptions.ends_on <', $today)
                            ->groupBy('users.u_id')
                            ->get();
            $total_count = $builder->getResult();    

            $builder = $this->db->table('users')
                            ->select('users.name, users.mobile , users.email,users.status, subscriptions.status as subscription')
                            ->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left')
                            ->like('users.name', $search_value)
                            ->where('users.u_id !=', 1)
                            ->where('subscriptions.status', 1)
                            ->where('subscriptions.ends_on <', $today)
                            ->groupBy('users.u_id')
                            ->limit($start, $length)
                            ->get();

            $data = $builder->getResult();    

            }
            else {
            //No Expired Subscriptions
            $total_count = array();
            $data = array();
            }


            }


             
        }

        else if(!empty($valueStatus)){
            // If we have value in search, searching by id, name, email, mobile

                //  $total_count = $this->db->query("SELECT * from users WHERE status=".$valueStatus."")->getResult();
                //  $data = $this->db->query("SELECT * from users WHERE status=".$valueStatus."")->getResult();
            

                $builder = $this->db->table('users');
                $builder->select('name, mobile , email, status, (SELECT COUNT(*) FROM subscriptions WHERE (subscriptions.client_id = users.u_id AND subscriptions.client_id != "1" AND subscriptions.ends_on >= now() )) as subscription');
                $builder->like('users.name', $search_value);
                $builder->where('users.u_id !=', 1);
                $query = $builder->get();
                $total_count = $query->getResult();           
                
                
                $builder = $this->db->table('users');
                $builder->select('name, mobile , email, status, (SELECT COUNT(*) FROM subscriptions WHERE (subscriptions.client_id = users.u_id AND subscriptions.client_id != "1" AND subscriptions.ends_on >= now() )) as subscription');
                $builder->like('users.name', $search_value);
                $builder->where('users.u_id !=', 1);
                $builder->limit($start, $length);
                $query2 = $builder->get();
                $data = $query2->getResult();   


        } 
             
        
        else {
                // count all data
        
                $hasSubscription = $this->db->table('users')
                                        ->select('*')
                                        ->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left')
                                        ->where('users.u_id !=', 1)
                                        ->where('subscriptions.status', 1)
                                        ->where('subscriptions.ends_on <', $today)
                                        ->groupBy('users.u_id')
                                        ->get();

                $total_count =$hasSubscription->getResult();  
                $data =$hasSubscription->getResult();  

                if(count($hasSubscription->getResult()) > 0){

                    $isSubscriptionExpired = $this->db->table('users')
                                                ->select('*')
                                                ->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left')
                                                ->where('users.u_id !=', 1)
                                                ->where('subscriptions.status', 1)
                                                ->where('subscriptions.ends_on >=', $today)
                                                ->groupBy('users.u_id')
                                                ->get();

                $total_count =$isSubscriptionExpired->getResult(); 
                $data =$isSubscriptionExpired->getResult();  
                
                    //Expired Subscription
                    if(count($isSubscriptionExpired->getResult()) == 0){

                            $builder = $this->db->table('users')
                                            ->select('users.name, users.mobile , users.email,users.status, subscriptions.status as subscription')
                                            ->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left')
                                            ->where('users.u_id !=', 1)
                                            ->where('subscriptions.status', 1)
                                            ->where('subscriptions.ends_on <', $today)
                                            ->groupBy('users.u_id')
                                            ->get();
                            $total_count = $builder->getResult();    

                            $builder = $this->db->table('users')
                                            ->select('users.name, users.mobile , users.email,users.status, subscriptions.status as subscription')
                                            ->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left')
                                            ->where('users.u_id !=', 1)
                                            ->where('subscriptions.status', 1)
                                            ->where('subscriptions.ends_on <', $today)
                                            ->groupBy('users.u_id')
                                            ->limit($start, $length)
                                            ->get();

                            $data = $builder->getResult();    

                    }
                    else {
                        //No Expired Subscriptions
                        $total_count = array();
                        $data = array();
                    }
                

                }



        }
        
        $json_data = array(
            "draw" => intval($params['draw']),
            "recordsTotal" => count($total_count),
            "recordsFiltered" => count($total_count),
            "data" => $data   // total data array
        );

        echo json_encode($json_data);   


        
    }


    //AJAX Call Expired clients
    public function ajaxCallAllClientsPending(){

        $today = Time::today('Asia/Kolkata', 'en_IN');

        $params['draw'] = $_REQUEST['draw'];
        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];
        /* If we pass any extra data in request from ajax */
        //$value1 = isset($_REQUEST['key1'])?$_REQUEST['key1']:"";


        
        $valueStatus = isset($_REQUEST['status'])?$_REQUEST['status']:"";

        /* Value we will get from typing in search */
        $search_value = $_REQUEST['search']['value'];

        if(!empty($search_value)){

            $hasSubscription = $this->db->table('users')
                                    ->select('*')
                                    ->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left')
                                    ->where('users.u_id !=', 1)
                                    ->where('subscriptions.status', 1)
                                    ->where('subscriptions.ends_on <', $today)
                                    ->groupBy('users.u_id')
                                    ->get();

            $total_count =$hasSubscription->getResult();  
            $data =$hasSubscription->getResult();  

            if(count($hasSubscription->getResult()) > 0){

            $isSubscriptionExpired = $this->db->table('users')
                                ->select('*')
                                ->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left')
                                ->where('users.u_id !=', 1)
                                ->where('subscriptions.status', 1)
                                ->where('subscriptions.ends_on >=', $today)
                                ->groupBy('users.u_id')
                                ->get();

            $total_count =$isSubscriptionExpired->getResult(); 
            $data =$isSubscriptionExpired->getResult();  

            //Expired Subscription
            if(count($isSubscriptionExpired->getResult()) == 0){

            $builder = $this->db->table('users')
                            ->select('users.name, users.mobile , users.email,users.status, subscriptions.status as subscription')
                            ->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left')
                            ->like('users.name', $search_value)
                            ->where('users.u_id !=', 1)
                            ->where('subscriptions.status', 1)
                            ->where('subscriptions.ends_on <', $today)
                            ->groupBy('users.u_id')
                            ->get();
            $total_count = $builder->getResult();    

            $builder = $this->db->table('users')
                            ->select('users.name, users.mobile , users.email,users.status, subscriptions.status as subscription')
                            ->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left')
                            ->like('users.name', $search_value)
                            ->where('users.u_id !=', 1)
                            ->where('subscriptions.status', 1)
                            ->where('subscriptions.ends_on <', $today)
                            ->groupBy('users.u_id')
                            ->limit($start, $length)
                            ->get();

            $data = $builder->getResult();    

            }
            else {
            //No Expired Subscriptions
            $total_count = array();
            $data = array();
            }


            }


             
        }

        else if(!empty($valueStatus)){
            // If we have value in search, searching by id, name, email, mobile

                //  $total_count = $this->db->query("SELECT * from users WHERE status=".$valueStatus."")->getResult();
                //  $data = $this->db->query("SELECT * from users WHERE status=".$valueStatus."")->getResult();
            

                $builder = $this->db->table('users');
                $builder->select('name, mobile , email, status, (SELECT COUNT(*) FROM subscriptions WHERE (subscriptions.client_id = users.u_id AND subscriptions.client_id != "1" AND subscriptions.ends_on >= now() )) as subscription');
                $builder->like('users.name', $search_value);
                $builder->where('users.u_id !=', 1);
                $query = $builder->get();
                $total_count = $query->getResult();           
                
                
                $builder = $this->db->table('users');
                $builder->select('name, mobile , email, status, (SELECT COUNT(*) FROM subscriptions WHERE (subscriptions.client_id = users.u_id AND subscriptions.client_id != "1" AND subscriptions.ends_on >= now() )) as subscription');
                $builder->like('users.name', $search_value);
                $builder->where('users.u_id !=', 1);
                $builder->limit($start, $length);
                $query2 = $builder->get();
                $data = $query2->getResult();   


        } 
             
        
        else {
                // count all data

        
                $builder = $this->db->table('users');
                $builder->select('users.name, users.mobile , users.email, users.status, subscriptions.status as subscription');
                $builder->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left');
                $builder->where('users.u_id !=', 1);
                $builder->where('subscriptions.status !=', 1);
                $builder->groupBy('users.u_id');
                $query = $builder->get();
                $total_count = $query->getResult();    




                $builder = $this->db->table('users');
                $builder->select('users.name, users.mobile , users.email, users.status, subscriptions.status as subscription');
                $builder->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left');
                $builder->where('users.u_id !=', 1);
                $builder->where('subscriptions.status !=', 1);
                $builder->groupBy('users.u_id');
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
