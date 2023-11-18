<?php

namespace App\Controllers\Backend;

use App\Controllers\AdminController;
use CodeIgniter\I18n\Time;
use App\Models\UserModel;
use App\Models\SubscriptionModel;
use App\Models\TransactionModel;

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


    //View Client page
    public function viewClient($client_id){

        $userModel = new UserModel();
        $subsModel = new SubscriptionModel();
        $txnModel = new TransactionModel();

        $data = array(            
            'client_id'=>$client_id,
            'subs_status'=>$this->getSubStatus($client_id),
            'client_data'=>$userModel->where('u_id',$client_id)->first(),        
            'subscription_data'=>$subsModel->where('client_id',$client_id)->first(),        
            'txn_data'=>$txnModel->where('client_id',$client_id)->get()->getResultArray(),        
        
        );

        $this-> render_view("Backend/pages/clients/view_client",$data);

    }


    //Add Client
    public function addClient(){

        if ($this->request->getMethod() == 'post') {

            $rules = [
                'name' => 'required|trim',
                'email' => 'required|trim|valid_email|is_unique[users.email]',
                'mobile' => 'trim|min_length[10]|max_length[10]|required|numeric|is_unique[users.mobile]',  
                'password' => 'trim|required|min_length[3]|max_length[255]',       
                'passconf' => 'trim|required|min_length[3]|max_length[255]|matches[password]',       
                'status'=> 'trim|required'
            ];
    
            $errors = [
      
                'name' => [
                    'required' => "Name is Required",
                ], 
                'email'=>[
                    'required'=>'Email is required',
                    'valid_email'=>'Enter a valid email',
                    'is_unique'=>'Email already taken',
                ],
                'mobile'=>[
                    'required'=> "10 digit mobile number",
                    'min_length'=>'Enter 10 digit mobile number',
                    'max_length'=>'Enter10 digit mobile number',
                    'is_unique'=>'Mobile no already taken',
                ],         
                'password'=>[
                    'required'=> "Password is required",
                    'min_length'=> 'Minimum 3 digit password'
                ],        
                'passconf'=>[
                    'required'=> "Confirm the password",
                    'matches'=>'Passwords do not match',
                ],
                'status'=>[
                    'required'=> "Status is required",
                ],
               
            ];

            if (!$this->validate($rules,$errors)) {
                $data['validation'] = $this->validator;
                // return view('admin/pages/profile',$data);     
                $this->render_view('backend/pages/clients/add_client',$data);               
            }else {


                $logged_user = session()->get('id');

                $model = new UserModel();

                $userData = [
                    'name' => $this->request->getVar('name'),
                    'mobile' => $this->request->getVar('mobile'),
                    'email' => $this->request->getVar('email'),
                    'gender'   => null,
                    'user_type' => 'client',
                    'created_by' =>  $logged_user,
                    'status' => $this->request->getVar('status'),   
                    'password' => $this->request->getVar('password')                  
                ];

                if( $logged_user)
                    $model->save($userData);

                $lastUserID = $model->getInsertID();

                if($lastUserID){

                        //Create a Subscription Entry
                        $subsmodel = new SubscriptionModel();

                        $subsData = [
                            'client_id' => $lastUserID,                            
                            'txn_id' => null,
                            'started_at' => null,
                            'ends_on' => null,
                            'validity'=>null,
                            'status' => 2, //1 Active | 2 Pending                       
                        ];
                        $subsmodel->save($subsData);


                        $session = session();
                        $session->setFlashdata('success', 'User Created');
                        return redirect()->to(base_url('admin/allClients'));


                }   



            }

        }
        else {

            $data = array();
        $this-> render_view("Backend/pages/clients/add_client",$data);

        }

    }





    //Update Client Profile
    public function updateClientProfile(){


        if ($this->request->getMethod() == 'post') {

            $id = $this->request->getvar('row_id');

            $rules = [
                'name' => 'required|trim',
                'email' => 'required|trim|valid_email|is_unique[users.email,u_id,'.$id.']',
                'mobile' => 'trim|min_length[10]|max_length[10]|required|numeric|is_unique[users.mobile,u_id,'.$id.']',    
                'type' => 'required|trim',  
                'status' => 'required|trim',  
            ];
            $errors = [
      
                'name' => [
                    'required' => "Name is Required",
                ], 
                'email'=>[
                    'required'=>'Email is required',
                    'valid_email'=>'Enter a valid email',
                    'is_unique'=>'Email already taken',
                ],
                'mobile'=>[
                    'required'=> "10 digit mobile number",
                    'min_length'=>'Enter 10 digit mobile number',
                    'max_length'=>'Enter10 digit mobile number',
                    'is_unique'=>'Mobile no already taken',
                ],                        
            ];

            if (!$this->validate($rules, $errors)) {

                $data['validation'] = $this->validator;
                $session = session();
                $errorMsg = $data['validation']->getErrors();
                $session->setFlashdata('error', $errorMsg);
                return redirect()->to(base_url('admin/clients/view/'.$id));

            } else {  //ELse update details


                $model = new UserModel();

                $data = [
                    'u_id' => $id,
                    'name' => strtoupper($this->request->getVar('name')),
                    'email' => $this->request->getVar('email'),
                    'mobile' => $this->request->getVar('mobile'),
                    'user_type' => $this->request->getVar('user_type'),
                    'status' => $this->request->getVar('status'),
                  
                ];
    
                $model->save($data);
                $session = session();
                $session->setFlashdata('success', 'Profile Updated');
                return redirect()->to(base_url('admin/clients/view/'.$id));




            }



        }
    }

    //Update Client Subscription
    public function updateClientSubscription(){


        if ($this->request->getMethod() == 'post') {

            $id = $this->request->getvar('row_id');

            $rules = [
                'started_at' => 'required|trim',
                'ends_on' => 'required|trim',
                'validity_days' => 'trim|required|numeric',    
                'status' => 'required|trim',  
            ];
            $errors = [
      
                'started_at' => [
                    'required' => "Sart Date Required",           
                     ], 
                'ends_on'=>[
                    'required'=>'End Date is required',
                ],
                         
            ];

            if (!$this->validate($rules, $errors)) {

                $data['validation'] = $this->validator;
                $session = session();
                $errorMsg = $data['validation']->getErrors();
                $session->setFlashdata('error', $errorMsg);
                return redirect()->to(base_url('admin/clients/view/'.$id));

            } else {  //ELse update details


                $builder = $this->db->table('subscriptions');

                $data = [
                    'started_at' => strtoupper($this->request->getVar('started_at')),
                    'ends_on' => $this->request->getVar('ends_on'),
                    'validity_days' => $this->request->getVar('validity_days'),                  
                    'status' => $this->request->getVar('status'),                  
                ];

                $builder->where('client_id', $id);
                $builder->update($data);
   
                $session = session();
                $session->setFlashdata('success', 'Subscription Updated');
                return redirect()->to(base_url('admin/clients/view/'.$id));




            }



        }
    }


    //Update Client Subscription
    public function updateClientPassword(){


        if ($this->request->getMethod() == 'post') {

            $id = $this->request->getvar('row_id');

            $rules = [
                'password' => 'trim|required|min_length[3]|max_length[255]',       
                'passconf' => 'trim|required|min_length[3]|max_length[255]|matches[password]',    
            ];
            $errors = [
      
                'password'=>[
                    'required'=> "Password is required",
                    'min_length'=> 'Minimum 3 digit password'
                ],        
                'passconf'=>[
                    'required'=> "Confirm the password",
                    'matches'=>'Passwords do not match',
                ],
                         
            ];

            if (!$this->validate($rules, $errors)) {

                $data['validation'] = $this->validator;
                $session = session();
                $errorMsg = $data['validation']->getErrors();
                $session->setFlashdata('error', $errorMsg);
                return redirect()->to(base_url('admin/clients/view/'.$id));

            } else {  //ELse update details


                $model = new UserModel();


                $data = [
                    'u_id' => $this->request->getVar('row_id'),                  
                    'password' => $this->request->getVar('password'),                  
                ];

                $model->save($data);
                $session = session();
                $session->setFlashdata('success', 'Password Updated');
                return redirect()->to(base_url('admin/clients/view/'.$id));

            }



        }
    }




    //AJAX Call all clients
    public function ajaxCallAllClients(){

        $today = Time::today('Asia/Kolkata', 'en_IN');

        $params['draw'] = $_REQUEST['draw'];
        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];
        /* If we pass any extra data in request from ajax */
        //$value1 = isset($_REQUEST['key1'])?$_REQUEST['key1']:"";

        $total_count = array();
        $data = array();

        
        $valueStatus = isset($_REQUEST['status'])?$_REQUEST['status']:"";

        /* Value we will get from typing in search */
        $search_value = $_REQUEST['search']['value'];
    

        if(!empty($search_value)){
          
            $builder = $this->db->table('users');
            $builder->select('u_id,name, mobile , email, status, (SELECT COUNT(*) FROM subscriptions WHERE (subscriptions.client_id = users.u_id AND subscriptions.client_id != "1" AND subscriptions.ends_on >= now() )) as subscription');
            $builder->like('users.name', $search_value);
            $builder->where('users.u_id !=', 1);
            $query = $builder->get();
            $total_count = $query->getResult();           
            
            
            $builder = $this->db->table('users');
            $builder->select('u_id,name, mobile , email, status, (SELECT COUNT(*) FROM subscriptions WHERE (subscriptions.client_id = users.u_id AND subscriptions.client_id != "1" AND subscriptions.ends_on >= now() )) as subscription');
            $builder->like('users.name', $search_value);
            $builder->where('users.u_id !=', 1);
            $builder->limit($start, $length);
            $query2 = $builder->get();
            $data = $query2->getResult();   
             
        }

        else if(!empty($valueStatus)){

                $builder = $this->db->table('users');
                $builder->select('u_id,name, mobile , email, status, (SELECT COUNT(*) FROM subscriptions WHERE (subscriptions.client_id = users.u_id AND subscriptions.client_id != "1" AND subscriptions.ends_on >= now() )) as subscription');
                $builder->where('users.u_id !=', 1);
                $builder->where('status', $valueStatus);
                $query = $builder->get();
                $total_count = $query->getResult();           
                
                
                $builder = $this->db->table('users');
                $builder->select('u_id,name, mobile , email, status, (SELECT COUNT(*) FROM subscriptions WHERE (subscriptions.client_id = users.u_id AND subscriptions.client_id != "1" AND subscriptions.ends_on >= now() )) as subscription');
                $builder->where('users.u_id !=', 1);
                $builder->where('status', $valueStatus);
                $builder->limit($start, $length);
                $query2 = $builder->get();
                $data = $query2->getResult();   


        } 
             
        
        else{

                // count all data
                $builder = $this->db->table('users');
                $builder->select('u_id, name, mobile , email, status, (SELECT COUNT(*) FROM subscriptions WHERE (subscriptions.client_id = users.u_id  AND subscriptions.status = 1 )) as subscription');
                $builder->where('users.u_id !=', 1);
                $query = $builder->get();
                $total_count = $query->getResult();          
                
                
                $builder = $this->db->table('users');
                $builder->select('u_id, name, mobile , email, status, (SELECT COUNT(*) FROM subscriptions WHERE (subscriptions.client_id = users.u_id AND subscriptions.status = 1 )) as subscription');
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
            $builder->select('users.u_id,users.name, users.mobile , users.email, users.status, subscriptions.status as subscription');
            $builder->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left');
            $builder->like('users.name', $search_value);
            $builder->where('users.u_id !=', 1);
            $builder->where('subscriptions.status', 1);
            $builder->where('subscriptions.ends_on >=', $today);
            $builder->groupBy('users.u_id');
            $query = $builder->get();
            $total_count = $query->getResult();    

            $builder = $this->db->table('users');
            $builder->select('users.u_id,users.name, users.mobile , users.email, users.status, subscriptions.status as subscription');
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

                $builder = $this->db->table('users');
                $builder->select('users.u_id,users.name, users.mobile , users.email, users.status, subscriptions.status as subscription');
                $builder->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left');
                $builder->where('users.status', $valueStatus);
                $builder->where('users.u_id !=', 1);
                $builder->where('subscriptions.status', 1);
                $builder->where('subscriptions.ends_on >=', $today);
                $builder->groupBy('users.u_id');
                $query = $builder->get();
                $total_count = $query->getResult();    
    
                $builder = $this->db->table('users');
                $builder->select('users.u_id,users.name, users.mobile , users.email, users.status, subscriptions.status as subscription');
                $builder->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left');
                $builder->where('users.status', $valueStatus);
                $builder->where('users.u_id !=', 1);
                $builder->where('subscriptions.status', 1);
                $builder->where('subscriptions.ends_on >=', $today);
                $builder->groupBy('users.u_id');
                $builder->limit($start, $length);
                $query2 = $builder->get();
                $data = $query2->getResult();  


        } 
             
        
        else{
                // count all data

                $builder = $this->db->table('users');
                $builder->select('users.u_id,users.name, users.mobile , users.email, users.status, subscriptions.status as subscription');
                $builder->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left');
                $builder->where('users.u_id !=', 1);
                $builder->where('subscriptions.status', 1);
                $builder->where('subscriptions.ends_on >=', $today);
                $builder->groupBy('users.u_id');
                $query = $builder->get();
                $total_count = $query->getResult();    



                $builder = $this->db->table('users');
                $builder->select('users.u_id,users.name, users.mobile , users.email, users.status, subscriptions.status as subscription');
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

            $builder = $this->db->table('users');
            $builder->select('users.u_id, users.name, users.mobile , users.email, users.status, 0 as subscription');
            $builder->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left');
            $builder->like('users.name',$search_value);
            $builder->where('users.u_id !=', 1);
            $builder->where('subscriptions.status', 1);
            $builder->where('subscriptions.ends_on <', $today);
            $query = $builder->get();
            $total_count = $query->getResult();          
            
            
            $builder = $this->db->table('users');
            $builder->select('users.u_id, users.name, users.mobile , users.email, users.status, 0 as subscription');
            $builder->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left');
            $builder->like('users.name',$search_value);
            $builder->where('users.u_id !=', 1);
            $builder->where('subscriptions.status', 1);
            $builder->where('subscriptions.ends_on <', $today);
            $builder->limit($start, $length);
            $query2 = $builder->get();
            $data = $query2->getResult();   
            
            
        }

        else if(!empty($valueStatus)){


            $builder = $this->db->table('users');
            $builder->select('users.u_id, users.name, users.mobile , users.email, users.status, 0 as subscription');
            $builder->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left');
            $builder->where('users.status',$valueStatus);
            $builder->where('users.u_id !=', 1);
            $builder->where('subscriptions.status', 1);
            $builder->where('subscriptions.ends_on <', $today);
            $query = $builder->get();
            $total_count = $query->getResult();          
            
            
            $builder = $this->db->table('users');
            $builder->select('users.u_id, users.name, users.mobile , users.email, users.status, 0 as subscription');
            $builder->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left');
            $builder->where('users.status',$valueStatus);
            $builder->where('users.u_id !=', 1);
            $builder->where('subscriptions.status', 1);
            $builder->where('subscriptions.ends_on <', $today);
            $builder->limit($start, $length);
            $query2 = $builder->get();
            $data = $query2->getResult();   

        } 
             
        
        else {
                // count all data       

                    $builder = $this->db->table('users');
                    $builder->select('users.u_id, users.name, users.mobile , users.email, users.status, 0 as subscription');
                    $builder->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left');
                    $builder->where('users.u_id !=', 1);
                    $builder->where('subscriptions.status', 1);
                    $builder->where('subscriptions.ends_on <', $today);
                    $query = $builder->get();
                    $total_count = $query->getResult();          
                    
                    
                    $builder = $this->db->table('users');
                    $builder->select('users.u_id, users.name, users.mobile , users.email, users.status, 0 as subscription');
                    $builder->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left');
                    $builder->where('users.u_id !=', 1);
                    $builder->where('subscriptions.status', 1);
                    $builder->where('subscriptions.ends_on <', $today);
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


            $builder = $this->db->table('users');
            $builder->select('users.u_id, users.name, users.mobile , users.email, users.status, 0 as subscription');
            $builder->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left');
            $builder->like('users.name', $search_value);
            $builder->where('users.u_id !=', 1);
            $builder->where('subscriptions.validity_days', null);
            $query = $builder->get();
            $total_count = $query->getResult();          
            
            
            $builder = $this->db->table('users');
            $builder->select('users.u_id, users.name, users.mobile , users.email, users.status, 0 as subscription');
            $builder->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left');
            $builder->like('users.name', $search_value);
            $builder->where('users.u_id !=', 1);
            $builder->where('subscriptions.validity_days', null);
            $builder->limit($start, $length);
            $query2 = $builder->get();
            $data = $query2->getResult();   

             
        }

        else if(!empty($valueStatus)){


            $builder = $this->db->table('users');
            $builder->select('users.u_id, users.name, users.mobile , users.email, users.status, 0 as subscription');
            $builder->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left');
            $builder->where('users.status', $valueStatus);
            $builder->where('users.u_id !=', 1);
            $builder->where('subscriptions.validity_days', null);
            $query = $builder->get();
            $total_count = $query->getResult();          
            
            
            $builder = $this->db->table('users');
            $builder->select('users.u_id, users.name, users.mobile , users.email, users.status, 0 as subscription');
            $builder->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left');
            $builder->where('users.status', $valueStatus);
            $builder->where('users.u_id !=', 1);
            $builder->where('subscriptions.validity_days', null);
            $builder->limit($start, $length);
            $query2 = $builder->get();
            $data = $query2->getResult();   
  



        } 
             
        
        else {
                // count all data
        
                $builder = $this->db->table('users');
                $builder->select('users.u_id, users.name, users.mobile , users.email, users.status, 0 as subscription');
                $builder->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left');
                $builder->where('users.u_id !=', 1);
                $builder->where('subscriptions.validity_days', null);
                $query = $builder->get();
                $total_count = $query->getResult();          
                
                
                $builder = $this->db->table('users');
                $builder->select('users.u_id, users.name, users.mobile , users.email, users.status, 0 as subscription');
                $builder->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left');
                $builder->where('users.u_id !=', 1);
                $builder->where('subscriptions.validity_days', null);
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


    //Check User Subscription
    public function getSubStatus($id){

        $tmp_value = '';
        $today = Time::today('Asia/Kolkata', 'en_IN');

        $builder = $this->db->table('subscriptions')    
                     ->select('*')              
                    ->where('subscriptions.client_id', $id)
                    ->where('subscriptions.validity_days', null)
                    ->where('subscriptions.started_at', null)
                    ->where('subscriptions.ends_on', null)
                    ->get()->getResult();

        if(count($builder) > 0){

           $tmp_value = '<span class="text-warning">PENDING</span>';

        }



        $builder = $this->db->table('subscriptions')
                        ->select('*')
                        ->where('subscriptions.client_id', $id)
                        ->where('subscriptions.status', 1)
                        ->where('subscriptions.ends_on <', $today)
                        ->get()->getResult();

   
        if(count($builder) > 0){

           $tmp_value = '<span class="text-danger">EXPIRED<span>';


        }

        $builder = $this->db->table('subscriptions')
                        ->select('ends_on')                        
                        ->where('subscriptions.client_id', $id)
                        ->where('subscriptions.status', 1)
                        ->where('subscriptions.ends_on >=', $today)
                        ->get()->getRow('ends_on');
                             
        if($builder){

            $tmp_value = $builder;           

        }

       return $tmp_value;
    
    }



}
