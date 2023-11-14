<?php

namespace App\Controllers\Backend;

use App\Controllers\AdminController;
use App\Models\CouponModel;

class CouponController extends AdminController
{

    public function __construct(){
        parent::__construct();        
         // Loading db instance
         $this->db = \Config\Database::connect();       
     }



    public function index()
    {

        $data = array();
        $this-> render_view("Backend/pages/coupons/all_coupons",$data);
    }


        //AJAX Call All Coupons
        public function ajaxCallAllCoupons(){

            $params['draw'] = $_REQUEST['draw'];
            $start = $_REQUEST['start'];
            $length = $_REQUEST['length'];
            /* If we pass any extra data in request from ajax */
            //$value1 = isset($_REQUEST['key1'])?$_REQUEST['key1']:"";
    
            $valueStatus = isset($_REQUEST['status'])?$_REQUEST['status']:"";
           
    
            /* Value we will get from typing in search */
            $search_value = $_REQUEST['search']['value'];
    
            if(!empty($search_value)){
    
                     
                $builder = $this->db->table('coupons');
                $builder->select('*');
                $builder->like('coupon', $search_value);
                $query = $builder->get();
                $total_count = $query->getResult();       
                
                
                $builder = $this->db->table('coupons');
                $builder->select('*');
                $builder->like('coupon', $search_value);
                $builder->limit($start, $length);
                $query2 = $builder->get();
                $data = $query2->getResult();
    
               // $data = $this->db->query("SELECT * from users WHERE mobile like '%".$search_value."%' OR name like '%".$search_value."%' limit $start, $length")->getResult();
                          
            }
            
            else if(!empty($valueStatus)){
                // If we have value in search, searching by id, name, email, mobile
    
                    //  $total_count = $this->db->query("SELECT * from users WHERE status=".$valueStatus."")->getResult();
                    //  $data = $this->db->query("SELECT * from users WHERE status=".$valueStatus."")->getResult();
                
    
                     $builder = $this->db->table('coupons');
                     $builder->select('*');
                     $builder->where('is_active', $valueStatus);
                     $query = $builder->get();
                     $total_count = $query->getResult();       
                     
                     
                     $builder = $this->db->table('coupons');
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
                     
                     $builder = $this->db->table('coupons');
                     $builder->select('*');
                     $query = $builder->get();
                     $total_count = $query->getResult();       
                     
                     
                     $builder = $this->db->table('coupons');
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



    //Create New Coupon
    public function createCoupon(){

        $rules = [
            'coupon_name' => 'required|trim|is_unique[coupons.coupon]',
            'promoter' => 'trim',
            'discount_pcn' => 'required|trim|numeric',          
            'status' => 'required|trim|numeric',            
        ];

        $errors = [  
            'coupon_name' => [
                'required' => "Coupon name is Required",
                'is_unique' => ' {value} already exists',
            ], 

            'promoter'=>[],
            'amount'=>[],
            'discount_pcn'=>[],
            'status'=>[],
           
        ];

        if (!$this->validate($rules,$errors)) {
            $data['validation'] = $this->validator;
            $session = session();
            $errorMsg = $data['validation']->getErrors();
            $session->setFlashdata('error', $errorMsg);
            return redirect()->to(base_url('admin/couponCodes'));


        }else {

            $model = new CouponModel();

            $data = [
                'coupon' => strtoupper($this->request->getVar('coupon_name')),
                'promoter_name' => $this->request->getVar('promoter'),
                'discount_percentage' => $this->request->getVar('discount_pcn'),
                'is_active' => $this->request->getVar('status'),
                'created_by' => session()->get('id'),
              
            ];

            $model->save($data);          

            $session = session();
            $session->setFlashdata('success', 'Coupon Created');
            return redirect()->to(base_url('admin/couponCodes'));
        }


    }




        //Update Coupon
        public function updateCoupon(){

            $id = $this->request->getVar('row_id');
    
            $rules = [
               
                'coupon_name' => 'required|trim|is_unique[coupons.coupon,cp_id,'.$id.']',
                'promoter' => 'trim',
                'discount_pcn' => 'required|trim|numeric',          
                'status' => 'required|trim|numeric',         

            ];
    
            $errors = [  
                'coupon_name' => [
                    'required' => "Coupon name is Required",
                    'is_unique' => ' {value} already exists',
                ], 
    
                'promoter'=>[],
                'amount'=>[],
                'discount_pcn'=>[],
                'status'=>[],
               
            ];
    
            if (!$this->validate($rules,$errors)) {
                $data['validation'] = $this->validator;
                $session = session();
                $errorMsg = $data['validation']->getErrors();
                $session->setFlashdata('error', $errorMsg);
                return redirect()->to(base_url('admin/couponCodes'));
    
    
            }else {
    
                $model = new CouponModel();
    
              
                $data = [
                    'cp_id' => $this->request->getVar('row_id'),
                    'coupon' => strtoupper($this->request->getVar('coupon_name')),
                    'promoter_name' => $this->request->getVar('promoter'),
                    'discount_percentage' => $this->request->getVar('discount_pcn'),
                    'is_active' => $this->request->getVar('status'),
                
                ];
        
                $model->save($data);
                $session = session();
                $session->setFlashdata('success', 'Coupon Updated');
                return redirect()->to(base_url('admin/couponCodes'));
            }
    
        }
    

        
    //Delete Package
    public function deleteCoupon(){

        if (isset($_POST['row_id'])) {      
            $id = $this->request->getVar('row_id');                
            $model = new CouponModel();
            $model->delete($id);

            $session = session();
            $session->setFlashdata('success', 'Coupon Deleted');
            return redirect()->to(base_url('admin/couponCodes'));
      }
      
      else {
            //Pass error message in key value pair
            $errorMsg = array('Msg:'=> 'Error occurred!');
            $session = session();
            $session->setFlashdata('error', $errorMsg);
            return redirect()->to(base_url('admin/couponCodes'));
      } 


    }




}
