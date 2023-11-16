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



        $hasSubscription = $this->db->table('users')
                        ->select('*')
                        ->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left')
                        ->where('users.u_id !=', 1)
                        ->where('subscriptions.status', 1)
                        ->where('subscriptions.ends_on <', $today)
                        ->groupBy('users.u_id')
                        ->get();
                        

        echo count($hasSubscription->getResult());

        if(count($hasSubscription->getResult()) > 0){

        
            $isSubscriptionExpired = $this->db->table('users')
                                        ->select('*')
                                        ->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left')
                                        ->where('users.u_id !=', 1)
                                        ->where('subscriptions.status', 1)
                                        ->where('subscriptions.ends_on >=', $today)
                                        ->groupBy('users.u_id')
                                        ->get();

           
        echo count($isSubscriptionExpired->getResult());
            //Expired Subscription
            if(count($isSubscriptionExpired->getResult()) == 0){

                    $builder = $this->db->table('users')
                                    ->select('users.name, users.mobile , users.email,users.status, subscriptions.status as subscription')
                                    ->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left')
                                    ->where('users.u_id !=', 1)
                                    ->where('subscriptions.status', 1)
                                    ->where('subscriptions.ends_on <', $today)
                                    ->groupBy('users.u_id');
                                  //  ->get();

               // $total_count = $builder->getResult();    

                    $query = $builder->get();
                    $total_count = $query->getResult();   
                    echo "<pre>";
                    print_r($total_count);

            }
          

        }
  

        // $builder = $this->db->table('users');
        // $builder->select('users.name, users.mobile , users.email,users.status, subscriptions.status as subscription');
        // $builder->join('subscriptions', 'users.u_id = subscriptions.client_id', 'left');
        // $builder->where('users.u_id !=', 1);
        // $builder->where('subscriptions.status', 1);
        // $builder->where('subscriptions.ends_on <', $today);
        // $builder->where('subscriptions.ends_on >=', $today);
        // $builder->groupBy('users.u_id');
        // $query = $builder->get();
        // $total_count = $query->getResult();    


        // $builder = $this->db->table('users');
        // $builder->select('name, mobile , email, status, (SELECT COUNT(*) FROM subscriptions WHERE (subscriptions.client_id = users.u_id AND subscriptions.client_id != "1" AND subscriptions.ends_on >= now() )) as subscription');
        // $builder->where('users.u_id !=', 1);
        // $query = $builder->get();
        // $total_count = $query->getResult();        





    }



    




}


?>