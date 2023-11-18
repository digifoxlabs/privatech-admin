<?php

namespace App\Controllers\Backend;

use CodeIgniter\I18n\Time;
use App\Controllers\AdminController;
use App\Models\TransactionModel;

class TxnController extends AdminController
{


    public function __construct(){

        parent::__construct();
        $this->db = db_connect();
    }


    public function index()
    {
        $data = array();
        $this-> render_view("Backend/pages/transactions/index",$data);

    }


    //AJAX Call all TXN

    public function ajaxCallAllTxn(){

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


            $builder = $this->db->table('transactions');
            $builder->select('transactions.*,users.name, users.mobile');
            $builder->join('users', 'transactions.client_id = users.u_id');
            $builder->like('transactions.txn_id', $search_value);
            $builder->where('users.u_id !=', 1);
            $builder->orderBy('transactions.created_at', 'DESC');
            $query = $builder->get();
            $total_count = $query->getResult();          
            
            
            $builder = $this->db->table('transactions');
            $builder->select('transactions.*,users.name, users.mobile');
            $builder->join('users', 'transactions.client_id = users.u_id');
            $builder->like('transactions.txn_id', $search_value);
            $builder->where('users.u_id !=', 1);
            $builder->limit($start, $length);
            $builder->orderBy('transactions.created_at', 'DESC');
            $query2 = $builder->get();
            $data = $query2->getResult();   


             
        }

        else if(!empty($valueStatus)){

            $builder = $this->db->table('transactions');
            $builder->select('transactions.*,users.name, users.mobile');
            $builder->join('users', 'transactions.client_id = users.u_id');
            $builder->where('transactions.status', $valueStatus);
            $builder->where('users.u_id !=', 1);
            $builder->orderBy('transactions.created_at', 'DESC');
            $query = $builder->get();
            $total_count = $query->getResult();          
            
            
            $builder = $this->db->table('transactions');
            $builder->select('transactions.*,users.name, users.mobile');
            $builder->join('users', 'transactions.client_id = users.u_id');
            $builder->where('transactions.status', $valueStatus);
            $builder->where('users.u_id !=', 1);
            $builder->limit($start, $length);
            $builder->orderBy('transactions.created_at', 'DESC');
            $query2 = $builder->get();
            $data = $query2->getResult();   


        } 
             
        
        else{

                // count all data
                $builder = $this->db->table('transactions');
                $builder->select('transactions.*,users.name, users.mobile');
                $builder->join('users', 'transactions.client_id = users.u_id');
                $builder->where('users.u_id !=', 1);
                $builder->orderBy('transactions.created_at', 'DESC');
                $query = $builder->get();
                $total_count = $query->getResult();          
                
                
                $builder = $this->db->table('transactions');
                $builder->select('transactions.*,users.name, users.mobile');
                $builder->join('users', 'transactions.client_id = users.u_id');
                $builder->where('users.u_id !=', 1);
                $builder->limit($start, $length);
                $builder->orderBy('transactions.created_at', 'DESC');
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
