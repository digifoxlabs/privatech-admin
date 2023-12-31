<?php

namespace App\Controllers\Backend;

use App\Controllers\AdminController;
use App\Models\SettingsModel;
use App\Models\ActivationCodeModel;

class ActivationCodeController extends AdminController
{

    public function __construct(){

        parent::__construct();        
         // Loading db instance
         $this->db = \Config\Database::connect();    
         // Loading Query builder instance
         $this->builder = $this->db->table("settings");        
 
     }




    public function index()
    {
        $settingsModel = new SettingsModel();
        $data = array();
        $data['gst_rate'] =$this->getSettings('gst_rate');
        $this-> render_view("Backend/pages/activationCode/all_codes",$data);
    }


        //AJAX Call All Activation Codes
        public function ajaxCallAllCodes(){

            $params['draw'] = $_REQUEST['draw'];
            $start = $_REQUEST['start'];
            $length = $_REQUEST['length'];
            /* If we pass any extra data in request from ajax */
            //$value1 = isset($_REQUEST['key1'])?$_REQUEST['key1']:"";
    
            $valueStatus = isset($_REQUEST['status'])?$_REQUEST['status']:"";
           
    
            /* Value we will get from typing in search */
            $search_value = $_REQUEST['search']['value'];
    
            if(!empty($search_value)){
    
                     
                $builder = $this->db->table('activation_codes');
                $builder->select('*');
                $builder->like('code', $search_value);
                $query = $builder->get();
                $total_count = $query->getResult();       
                
                
                $builder = $this->db->table('activation_codes');
                $builder->select('*');
                $builder->like('code', $search_value);
                $builder->limit($start, $length);
                $query2 = $builder->get();
                $data = $query2->getResult();
    
               // $data = $this->db->query("SELECT * from users WHERE mobile like '%".$search_value."%' OR name like '%".$search_value."%' limit $start, $length")->getResult();
                          
            }
            
            else if(!empty($valueStatus)){
                // If we have value in search, searching by id, name, email, mobile
    
                    //  $total_count = $this->db->query("SELECT * from users WHERE status=".$valueStatus."")->getResult();
                    //  $data = $this->db->query("SELECT * from users WHERE status=".$valueStatus."")->getResult();
                
    
                     $builder = $this->db->table('activation_codes');
                     $builder->select('*');
                     $builder->where('is_active', $valueStatus);
                     $query = $builder->get();
                     $total_count = $query->getResult();       
                     
                     
                     $builder = $this->db->table('activation_codes');
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
                     
                     $builder = $this->db->table('activation_codes');
                     $builder->select('*');
                     $query = $builder->get();
                     $total_count = $query->getResult();       
                     
                     
                     $builder = $this->db->table('activation_codes');
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


    //Create New Code
    public function createCode(){

        $rules = [
            'code_name' => 'required|trim|is_unique[activation_codes.code]',
            'duration' => 'required|trim|numeric',
            'amount' => 'required|trim|numeric',
            'tax' => 'required|trim|numeric',    
            'price' => 'required|trim|numeric',            
            'status' => 'required|trim|numeric',            
        ];

        $errors = [  
            'code_name' => [
                'required' => "Code is Required",
                'is_unique' => ' {value} already exists',
            ], 

            'duration'=>[],
            'amount'=>[],
            'tax'=>[],
            'price'=>[],
            'status'=>[],
           
        ];

        if (!$this->validate($rules,$errors)) {
            $data['validation'] = $this->validator;
            $session = session();
            $errorMsg = $data['validation']->getErrors();
            $session->setFlashdata('error', $errorMsg);
            return redirect()->to(base_url('admin/activationCodes'));


        }else {

            $model = new ActivationCodeModel();

            $data = [
                'code' => strtoupper($this->request->getVar('code_name')),
                'duration_in_days' => $this->request->getVar('duration'),
                'net_amount' => $this->request->getVar('amount'),
                'tax' => $this->request->getVar('tax'),
                'price' => $this->request->getVar('price'),
                'is_active' => $this->request->getVar('status'),
                'created_by' => session()->get('id'),
              
            ];

            $model->save($data);          

            $session = session();
            $session->setFlashdata('success', 'Code Created');
            return redirect()->to(base_url('admin/activationCodes'));
        }


    }


    //Delete Package
    public function deleteCode(){

        if (isset($_POST['row_id'])) {      
            $id = $this->request->getVar('row_id');                
            $model = new ActivationCodeModel();
            $model->delete($id);

            $session = session();
            $session->setFlashdata('success', 'Code Deleted');
            return redirect()->to(base_url('admin/activationCodes'));
      }
      
      else {
            //Pass error message in key value pair
            $errorMsg = array('Msg:'=> 'Error occurred!');
            $session = session();
            $session->setFlashdata('error', $errorMsg);
            return redirect()->to(base_url('admin/activationCodes'));
      } 


    }


}
