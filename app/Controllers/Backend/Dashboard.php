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

        $data = array();

        $this-> render_view("Backend/pages/dashboard",$data);
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

        // $subquery = $this->db->table('subscriptions')
        //                 ->select('*')                       
        //                 ->where('status', 1)
        //                 ->where('ends_on <', $today)
        //                 ->where('ends_on >=!', $today)
        //                 ->countAllResults();

        //                 echo $subquery;
        //                 exit;
            

        // $builder = $this->db->table('users');
        // $builder->select('users.name, users.email , users.mobile, users.status, (' . $subquery . ') as subscription');
        // $builder->where('users.u_id !=', 1);
        // $query = $builder->get();
        // $total_count = $query->getResult();     


        $hasRecord = $this->db->table('users')
                            ->select('*')
                            ->join('subscriptions', 'users.u_id = subscriptions.client_id')
                            ->where('users.u_id !=', 1)
                            ->groupBy('users.u_id')
                            ->get();

                if(count($hasRecord->getResult()) > 0){

                //Check if active and expired record exists
                $checkRecord = $this->db->table('users')
                    ->select('*')
                    ->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left')
                    ->where('subscriptions.status >', 0)
                    ->where('users.u_id !=', 1)
                    ->groupBy('users.u_id')
                    ->get();

                //Records available are only pending
                if(count($checkRecord->getResult()) == 0){


                $builder = $this->db->table('users')
                            ->select('users.name, users.mobile , users.email,users.status, subscriptions.status as subscription')
                            ->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left')
                            ->where('subscriptions.status <', 1)
                            ->where('users.u_id !=', 1)
                            ->groupBy('users.u_id')
                            ->get();
                $total_count = $builder->getResult();    

                $builder = $this->db->table('users')
                            ->select('users.name, users.mobile , users.email,users.status, subscriptions.status as subscription')
                            ->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left')
                            ->where('subscriptions.status <', 1)
                            ->where('users.u_id !=', 1)
                            ->groupBy('users.u_id')
                            // ->limit($start, $length)
                            ->get();

                    

                }


               

                $data = $builder->getResult();    

                echo "<pre>";
                print_r($data);




    }



    




    }}


?>