<?php

namespace App\Controllers\Frontend;

use App\Controllers\FrontendController;
use CodeIgniter\I18n\Time;
use App\Models\UserModel;
use App\Models\PackageModel;
use Razorpay\Api\Api;

class SubscriptionController extends FrontendController
{
    public function index()
    {

        $logged_user = session()->get('id');
        $userModel = new UserModel();

        $data = array(                 
            'pageTitle' => 'PRIVATECH-PROFILE',       
            'subs_status'=>$this->getSubStatus($logged_user),                                                          

        );      
            
            $this->render_view('Frontend/pages/subscription/index',$data); 
    }


    //View packages
    public function packages(){

        $model = new PackageModel();
        $data = array(
            'packages'=>$model->get()->getResultArray(),
        );
        $this->render_view('Frontend/pages/subscription/packages',$data); 

    }


    //Purchase Package
    public function purchasePackage($id){

            $packageModel= new PackageModel();

            $data = array(
                'package'=>$packageModel->where('pck_id',$id)->first(),
            );

            $this->render_view('Frontend/pages/subscription/purchase',$data); 

    }

    //Pay Razorpay
    public function checkout(){


        $api = new Api(getenv('RAZORPAY_KEY_ID'), getenv('RAZORPAY_KEY_SECRET'));

       $razorCreate= $api->order->create(array(
            'receipt' => '123', 
            'amount' => 1000, 
            'currency' => 'INR', 
            'notes'=> array('key1'=> 'value3','key2'=> 'value2')
    
        ));

        $data['razorPay']= $razorCreate;

       $this->render_view('Frontend/razorpay/checkout',$data); 

    }



    //Check Payment Status
    public function checkPaymentStatus(){

        if ($this->request->getMethod() == 'post') {

            $payment_id = $this->request->getVar('razorpay_payment_id');
            $order_id = $this->request->getVar('razorpay_order_id');
            $signature = $this->request->getVar('razorpay_signature');

            if(!empty($payment_id)){

                $session = session();
                $session->setFlashdata('success', 'Payment Success');
                return redirect()->to(base_url('dashboard'));

            }
        }


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
