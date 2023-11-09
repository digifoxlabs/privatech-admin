<?php

namespace App\Controllers\Backend;

use App\Controllers\AdminController;
// Load Model
use App\Models\UserModel;
use App\Models\ShareModel;

class MemberController extends AdminController
{

    public function __construct(){

       parent::__construct();        
        // Loading db instance
		// $this->db = db_connect();
        $this->db = \Config\Database::connect();    
		// Loading Query builder instance
		$this->builder = $this->db->table("settings");

    }


    public function manage()
    {
        $data = array( 
            'pageTitle' => 'MCS-Customers',             
            'cardTitle' => 'All Members',            
        );
        $this-> render_view("Backend/pages/members/manage",$data);
    }   
    

    public function create_member(){

        $rules = [
            'name' => 'required|trim',
            'gender' => 'required|trim',
            'email_id' => 'required|trim|is_unique[users.email]',
            'contact' => 'trim|min_length[10]|max_length[10]|required|numeric|is_unique[users.mobile]',        
            'share_value' => 'required|trim|numeric',            
            'user_type' => 'required|trim',            
        ];

        $errors = [
  
            'name' => [
                'required' => "Name is Required",
            ], 
           
        ];

        if (!$this->validate($rules,$errors)) {
            $data['validation'] = $this->validator;
            $session = session();
            $errorMsg = $data['validation']->getErrors();
            $session->setFlashdata('error', $errorMsg);
            return redirect()->to(base_url('admin/members/manage'));


        }else {

            $model = new UserModel();

            $userData = [
                'name' => $this->request->getVar('name'),
                'mobile' => $this->request->getVar('contact'),
                'email' => $this->request->getVar('email_id'),
                'gender' => $this->request->getVar('gender'),
                'user_type' => $this->request->getVar('user_type'),
                'created_by' => session()->get('id'),
                'status' => 1,
                'password' => 'password123',
              
            ];
            $model->save($userData);

            $insertID = $model->getInsertID();
      
            $shareData = [
                'u_id' => $insertID,
                'share_amount' => $this->request->getVar('share_value'),
                'default_period' => '12',
                'custom_period' => null,
                'start_from' => '2023/10/01',
                'end_on' => '2024/09/30'              
            ];

            $shareModel = new ShareModel();

            $shareModel->save($shareData);

            $session = session();
            $session->setFlashdata('success', 'Member Added');
            return redirect()->to(base_url('admin/members/manage'));
        }


    }
    public function update_member(){

        $id = $this->request->getVar('row_id');

        $rules = [
            'name' => 'required|trim',
            'gender' => 'required|trim',
            'email_id' => 'required|trim|is_unique[users.email,u_id,'.$id.']',
            'contact' => 'trim|required|numeric|is_unique[users.mobile,u_id,'.$id.']',        
            'status' => 'required|trim|numeric',            
            'user_type' => 'required|trim',            
        ];

        $errors = [  
            'name' => [
                'required' => "Name is Required",
            ], 
           
        ];

        if (!$this->validate($rules,$errors)) {
            $data['validation'] = $this->validator;
            $session = session();
            $errorMsg = $data['validation']->getErrors();
            $session->setFlashdata('error', $errorMsg);
            return redirect()->to(base_url('admin/members/manage'));


        }else {

            $model = new UserModel();

            $userData = [

                'u_id' => $this->request->getVar('row_id'),
                'name' => $this->request->getVar('name'),
                'mobile' => $this->request->getVar('contact'),
                'email' => $this->request->getVar('email_id'),
                'gender' => $this->request->getVar('gender'),
                'status' => $this->request->getVar('status'),
                'user_type' => $this->request->getVar('user_type'),
              
            ];
            $model->save($userData);
            $session = session();
            $session->setFlashdata('success', 'Member Updated');
            return redirect()->to(base_url('admin/members/manage'));
        }


    }
    
    public function delete_member(){

        if (isset($_POST['row_id'])) {      
            $id = $this->request->getVar('row_id');                
            $model = new UserModel();
            $model->delete($id);

            //Also Delete Share Record
            $builder = $this->db->table('share_record');
            $builder->where('u_id', $id);
            $builder->delete();


            $session = session();
            $session->setFlashdata('success', 'Member Deleted');
            return redirect()->to(base_url('admin/members/manage'));
      }
      
      else {
            //Pass error message in key value pair
            $errorMsg = array('Msg:'=> 'Error occurred!');
            $session = session();
            $session->setFlashdata('error', $errorMsg);
            return redirect()->to(base_url('admin/members/manage'));
      }  


    }
    
    
    public function shares()
    {
        $data = array( 
            'pageTitle' => 'MCS-Customers',             
            'cardTitle' => 'All Shares',            
        );

        $this-> render_view("Backend/pages/members/shares",$data);
    }


    public function update_share(){

        $id = $this->request->getVar('row_id');

        $rules = [
            'share_value' => 'required|trim',
            'default_period' => 'required|trim',
            'custom_period' => 'trim',
            'start_from' => 'trim|required|',        
            'end_on' => 'required|trim',                     
        ];

        $errors = [  
            'share_value' => [
                'required' => "Share Amount is Required",
            ], 
           
        ];

        if (!$this->validate($rules,$errors)) {
            $data['validation'] = $this->validator;
            $session = session();
            $errorMsg = $data['validation']->getErrors();
            $session->setFlashdata('error', $errorMsg);
            return redirect()->to(base_url('admin/members/shares'));


        }else {

            $model = new ShareModel();

            $shareData = [

                'sh_id' => $this->request->getVar('row_id'),
                'share_amount' => $this->request->getVar('share_value'),
                'default_period' => $this->request->getVar('default_period'),
                'custom_period' => $this->request->getVar('custom_period'),
                'start_from' => $this->request->getVar('start_from'),
                'end_on' => $this->request->getVar('end_on'),
              
            ];
            $model->save($shareData);
            $session = session();
            $session->setFlashdata('success', 'Updated Successfully');
            return redirect()->to(base_url('admin/members/shares'));
        }


    }
    


    
    public function delete_share(){

        if (isset($_POST['row_id'])) {     

            $id = $this->request->getVar('row_id');                
            $model = new ShareModel();
            $model->delete($id);
            $session = session();
            $session->setFlashdata('success', 'Member Deleted');
            return redirect()->to(base_url('admin/members/shares'));
      }
      
      else {
            //Pass error message in key value pair
            $errorMsg = array('Msg:'=> 'Error occurred!');
            $session = session();
            $session->setFlashdata('error', $errorMsg);
            return redirect()->to(base_url('admin/members/shares'));
      }  


    }
    



    public function checkSQL(){


        $search_value = '';

    //Fetch data
    // $builder = $this->db->table('users');
    // $builder->select('users.u_id as id, users.name, users.email, users.mobile, users.status ,users.gender, COALESCE(share_record.share_amount, 0) as share');
    // $builder->join('share_record', 'users.u_id = share_record.u_id', 'left');
    // $query = $builder->get();
    // $total_count = $query->getResult();


                     
    $builder = $this->db->table('share_record');
    $builder->select('share_record.sh_id as u_id, share_record.u_id as user_id , share_record.share_amount, share_record.default_period, share_record.custom_period, share_record.start_from, share_record.end_on, COALESCE(users.name, null) as user_name');
    $builder->join('users', 'share_record.u_id = users.u_id', 'left');
    $query = $builder->get();
    $total_count = $query->getResult();


        
            echo "<pre>";
             print_r($total_count);

    }

    public function ajaxCallAllMembers(){

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
            $builder->select('users.u_id as u_id, users.name, users.email, users.mobile, users.status ,users.gender, users.user_type, COALESCE(share_record.share_amount, 0) as share');
            $builder->join('share_record', 'users.u_id = share_record.u_id', 'left');
            $builder->like('users.name', $search_value);
            $builder->where('users.u_id !=', 1);
            $query = $builder->get();
            $total_count = $query->getResult();       
            
            
            $builder = $this->db->table('users');
            $builder->select('users.u_id as u_id, users.name, users.email, users.mobile, users.status ,users.gender, users.user_type, COALESCE(share_record.share_amount, 0) as share');
            $builder->join('share_record', 'users.u_id = share_record.u_id', 'left');
            $builder->like('users.name', $search_value);
            $builder->where('users.u_id !=', 1);
            $builder->limit($start, $length);
            $query2 = $builder->get();
            $data = $query2->getResult();

           // $data = $this->db->query("SELECT * from users WHERE mobile like '%".$search_value."%' OR name like '%".$search_value."%' limit $start, $length")->getResult();
                      
        }
        
        else if(!empty($valueStatus)){
            // If we have value in search, searching by id, name, email, mobile

                //  $total_count = $this->db->query("SELECT * from users WHERE status=".$valueStatus."")->getResult();
                //  $data = $this->db->query("SELECT * from users WHERE status=".$valueStatus."")->getResult();
            

                 $builder = $this->db->table('users');
                 $builder->select('users.u_id as u_id, users.name, users.email, users.mobile, users.status ,users.gender, users.user_type, COALESCE(share_record.share_amount, 0) as share');
                 $builder->join('share_record', 'users.u_id = share_record.u_id', 'left');
                 $builder->where('users.status', $valueStatus);
                 $builder->where('users.u_id !=', 1);
                 $query = $builder->get();
                 $total_count = $query->getResult();       
                 
                 
                 $builder = $this->db->table('users');
                 $builder->select('users.u_id as u_id, users.name, users.email, users.mobile, users.status ,users.gender, users.user_type, COALESCE(share_record.share_amount, 0) as share');
                 $builder->join('share_record', 'users.u_id = share_record.u_id', 'left');
                 $builder->where('users.status', $valueStatus);
                 $builder->where('users.u_id !=', 1);
                 $builder->limit($start, $length);
                 $query2 = $builder->get();
                 $data = $query2->getResult();



        }        
        
        else{
                // count all data
  
                // $total_count = $this->db->query("SELECT * from users")->getResult();
                //  $data = $this->db->query("SELECT * from users limit $start, $length")->getResult(); 
                 
                 $builder = $this->db->table('users');
                 $builder->select('users.u_id as u_id, users.name, users.email, users.mobile, users.status ,users.gender, users.user_type, COALESCE(share_record.share_amount, 0) as share');
                 $builder->join('share_record', 'users.u_id = share_record.u_id', 'left');
                 $builder->where('users.u_id !=', 1);
                 $query = $builder->get();
                 $total_count = $query->getResult();       
                 
                 
                 $builder = $this->db->table('users');
                 $builder->select('users.u_id as u_id, users.name, users.email, users.mobile, users.status ,users.gender, users.user_type, COALESCE(share_record.share_amount, 0) as share');
                 $builder->join('share_record', 'users.u_id = share_record.u_id', 'left');
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

    public function ajaxCallAllShares(){

        $params['draw'] = $_REQUEST['draw'];
        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];
        /* If we pass any extra data in request from ajax */
        //$value1 = isset($_REQUEST['key1'])?$_REQUEST['key1']:"";

        /* Value we will get from typing in search */
        $search_value = $_REQUEST['search']['value'];

        if(!empty($search_value)){

                 
            $builder = $this->db->table('share_record');
            $builder->select('share_record.sh_id as u_id, share_record.u_id as user_id , share_record.share_amount, share_record.default_period, share_record.custom_period, share_record.start_from, share_record.end_on, COALESCE(users.name, null) as user_name');
            $builder->join('users', 'share_record.u_id = users.u_id', 'left');
            $builder->like('users.name', $search_value);
            $builder->where('users.u_id !=', 1);
            $query = $builder->get();
            $total_count = $query->getResult();       
            
            
            $builder = $this->db->table('share_record');
            $builder->select('share_record.sh_id as u_id, share_record.u_id as user_id , share_record.share_amount, share_record.default_period, share_record.custom_period, share_record.start_from, share_record.end_on, COALESCE(users.name, null) as user_name');
            $builder->join('users', 'share_record.u_id = users.u_id', 'left');
            $builder->like('users.name', $search_value);
            $builder->where('users.u_id !=', 1);
            $builder->limit($start, $length);
            $query2 = $builder->get();
            $data = $query2->getResult();

           // $data = $this->db->query("SELECT * from users WHERE mobile like '%".$search_value."%' OR name like '%".$search_value."%' limit $start, $length")->getResult();
                      
        }
             
        
        else{
                // count all data
  
                // $total_count = $this->db->query("SELECT * from users")->getResult();
                //  $data = $this->db->query("SELECT * from users limit $start, $length")->getResult(); 
                 
                $builder = $this->db->table('share_record');
                $builder->select('share_record.sh_id as u_id, share_record.u_id as user_id , share_record.share_amount, share_record.default_period, share_record.custom_period, share_record.start_from, share_record.end_on, users.name');
                $builder->join('users', 'share_record.u_id = users.u_id', 'left');
                 $builder->where('users.u_id !=', 1);
                 $query = $builder->get();
                 $total_count = $query->getResult();       
                 
                 
                 $builder = $this->db->table('share_record');
                 $builder->select('share_record.sh_id as u_id, share_record.u_id as user_id , share_record.share_amount, share_record.default_period, share_record.custom_period, share_record.start_from, share_record.end_on, users.name');
                 $builder->join('users', 'share_record.u_id = users.u_id', 'left');
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


}
