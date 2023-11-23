<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Controllers\AdminController;

use CodeIgniter\I18n\Time;

class Dashboard extends AdminController
{

    public function __construct(){

        parent::__construct();
        $this->db = db_connect();
  
    }


    public function index()
    {

        $data = array(
            'activeClients'=> $this->countActiveClients(),
            'pendingClients'=> $this->countPendingClients(),
            'expiredClients'=> $this->countExpiredClients(),
            'allClients'=> $this->countAllClients(),
            'allTransactions'=> $this->countAllTxn(),
            'allPackages'=> $this->countAllPackages(),
            'allActivationCodes'=> $this->countAllActivationCodes(),
            'allCoupons'=> $this->countAllCoupons(),
        );

        $this-> render_view("Backend/pages/dashboard",$data);
    }


    //Clients Counter
    public function countActiveClients(){

        $today = Time::today('Asia/Kolkata', 'en_IN');

        $builder = $this->db->table('clients');
        $builder->select('clients.cl_id,clients.name, clients.mobile , clients.email, clients.status, subscriptions.status as subscription');
        $builder->join('subscriptions', 'clients.cl_id = subscriptions.client_id', 'left');
        $builder->where('subscriptions.status', 1);
        $builder->where('subscriptions.ends_on >=', $today);
        return $builder->countAllResults();
    }

    //Pending Clients
    public function countPendingClients(){

        $builder = $this->db->table('clients');
        $builder->select('clients.cl_id, clients.name, clients.mobile , clients.email, clients.status, 0 as subscription');
        $builder->join('subscriptions', 'clients.cl_id = subscriptions.client_id', 'left');
        $builder->where('subscriptions.validity_days', null);
        return $builder->countAllResults();


    }

    //Expired Clients
    public function countExpiredClients(){
        $today = Time::today('Asia/Kolkata', 'en_IN');

        $builder = $this->db->table('clients');
        $builder->select('clients.cl_id, clients.name, clients.mobile , clients.email, clients.status, 0 as subscription');
        $builder->join('subscriptions', 'clients.cl_id = subscriptions.client_id', 'left');
        $builder->where('subscriptions.status', 1);
        $builder->where('subscriptions.ends_on <', $today);
        return $builder->countAllResults();

    }

    //All Clients
    public function countAllClients(){

        $builder = $this->db->table('clients');
        $builder->select('*');
        return $builder->countAllResults();

    }

    //Subscriptions
    public function countAllTxn(){

        $builder = $this->db->table('transactions');
        return $builder->countAllResults();

    }

    //Packages
    public function countAllPackages(){

        $builder = $this->db->table('packages');
        return $builder->countAllResults();

    }

    //Activation COdes
    public function countAllActivationCodes(){

        $builder = $this->db->table('activation_codes');
        return $builder->countAllResults();

    }

    //Coupons
    public function countAllCoupons(){

        $builder = $this->db->table('coupons');
        return $builder->countAllResults();

    }



    //YTest Function
    public function test(){


        $id=2;

        //check subscription

        // $builder = $this->db->table('subscriptions');
        // $builder->select('*');
        // // $query = $builder->get();
        // // $total_count = $query->getResult();   
        // echo $builder->countAll();





        $today = Time::today('Asia/Kolkata', 'en_IN');

        $builder = $this->db->table('transactions');
        $builder->select('transactions.*,users.name, users.mobile');
        $builder->join('users', 'transactions.client_id = users.u_id');
        $builder->where('users.u_id !=', 1);
        $query = $builder->get();
        $data = $query->getResult();          
        

                echo "<pre>";
                print_r($data);




    }



    




    }


?>