<?php

namespace App\Controllers\Frontend;

use App\Controllers\FrontendController;
// Load Model
use App\Models\UserModel;
use App\Models\ClientModel;
use App\Models\OTPModel;
use App\Models\SubscriptionModel;

class HomeController extends FrontendController
{

    public function __construct(){
        parent::__construct();
        $this->db = db_connect();
    }


    //Client HomePage 
    public function index(){

        $data = array( 
            'pageTitle' => 'PRIVATECH'                                         
        );      
            
         $this->render_view('Frontend/pages/index',$data); 
    }

    //Login Option page
    public function optionforLogin(){

        $session = session();
        if($session->getTempdata('user_input')){

            $data = array( 
                'pageTitle' => 'PRIVATECH-LOGIN'                                         
            );      
                
                $this->render_view('Frontend/pages/login_option',$data); 
        }

        else {

            return redirect()->to(base_url(''));
        }

   

    }


    //Registration
    public function register(){

        $data = array( 
            'pageTitle' => 'PRIVATECH-REGISTER',                                    
        );      

        //POST Request from register page
        if($this->request->getPost()){

            $rules = [
                'name' => 'required|trim',
                'email' => 'required|trim|valid_email|is_unique[clients.email]',
                'mobile' => 'trim|min_length[10]|max_length[10]|required|numeric|is_unique[clients.mobile]',  
                'password' => 'trim|required|min_length[3]|max_length[255]',       
                'passconf' => 'trim|required|min_length[3]|max_length[255]|matches[password]',       
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
               
            ];

            //Error in Registration
            if (!$this->validate($rules,$errors)) {
                $data['validation'] = $this->validator;   
                $this->render_view('Frontend/pages/register',$data);     
    
            }
            //Successfully Register and Login
            else {

                $model = new ClientModel();

                $clientData = [
                    'name' => $this->request->getVar('name'),
                    'mobile' => $this->request->getVar('mobile'),
                    'email' => $this->request->getVar('email'),
                    'gender'   => null,
                    'status' => 1,   
                    'password' => $this->request->getVar('password'),
                    'pass_raw' => $this->request->getVar('password'),

                ];

                $model->save($clientData);

                $lastInsertID = $model->getInsertID();

                if($lastInsertID){

                        //Create a Subscription Entry
                        $subsmodel = new SubscriptionModel();

                        $subsData = [
                            'client_id' => $lastInsertID,                            
                            'txn_id' => null,
                            'started_at' => null,
                            'ends_on' => null,
                            'validity'=>null,
                            'status' => 2, //1 Active | 2 Pending                       
                        ];
                        $subsmodel->save($subsData);

                        //Login Client to Dashboard
                        $user = $model->where('cl_id', $lastInsertID)
                                    ->where('status', '1')
                                    ->first();


                        // Storing session values and Login 

                        if($user){
                            $this->setUserSession($user);
                            // Redirecting to dashboard after login
                            return redirect()->to(base_url('dashboard'));
                        }

                        else {

                            return redirect()->to(base_url('login/client'));
    
                        }
                }         

            } //else
         
        }
        //Else GET Request
        else {

            $this->render_view('Frontend/pages/register',$data); 
        }
           
    }

    //Dashboard
    public function dashboard(){

        $data = array( 
            'pageTitle' => 'PRIVATECH-LOGIN'                                         
        );      
            
            $this->render_view('Frontend/pages/dashboard',$data); 

    }

    //Privacy Policy
    public function privacyPolicy(){

        $data = array( 
            'pageTitle' => 'PRIVATECH-LOGIN'                                         
        );      
            
            $this->render_view('Frontend/pages/privacy-policy.php',$data); 

    }


    //Reset Password page by Login
    public function resetPassword(){

        $session = session();
        if($session->getTempdata('user_input')){


            $userInput = $session->getTempdata('user_input');

            //Generate OTP
            $tempOTP = random_string('numeric', 6);     
         
            $model = new OtpModel(); 

            //Sent OTP to mobile no
            if(is_numeric($userInput)){

                $data = [
                    'otp'=> $tempOTP,
                    'isexpired' =>1,
                    'mobile' => $userInput,
                ];
            //Save OTP in DB
            $model->save($data);

            $message = $tempOTP.' is the OTP to login at RTS. Valid for 1 min only. RTS LLP';
            //Send OTP
            $this->sendOTP($userInput,$message);
            
            }
            else { //send OTP to email id

                $data = [
                    'otp'=> $tempOTP,
                    'isexpired' =>1,
                    'email' => $userInput,
                ];
            //Save OTP in DB
            $model->save($data);
            //Send Email Otp
            $this->sendEmailOtp($userInput, $tempOTP);

            }


            $data = array( 
                'pageTitle' => 'PRIVATECH-LOGIN'                                         
            );      
                
            $this->render_view('Frontend/pages/reset_password',$data); 
        }

        else {

            return redirect()->to(base_url(''));
        }
    }

    //Set New Password affer Reset
    public function setNewPassword(){

        $data = array( 
            'pageTitle' => 'PRIVATECH-LOGIN'                                         
        ); 

        if ($this->request->getMethod() == 'post') {

            $userInput = strtolower($this->request->getvar('user_id'));

            //Chek if input is number go for mobile login
            if(is_numeric($userInput)){

                  $rules = [
                    'user_id' => 'required|min_length[10]|max_length[10]|is_natural',
                    'otp' =>      'required|validateMobilewithOTP[user_id,password]',
                    'password' => 'required|min_length[3]|max_length[255]',
                    'passconf' => 'trim|required|min_length[3]|max_length[255]|matches[password]',  
                ];

                $errors = [

                    'user_id'=>[
                        'min_length'=> "Enter 10 digit Mobile no.",
                        'max_length'=> "Enter 10 digit Mobile no.",
                    ],
                    'otp'=>[
                        'required'=>'Enter OTP sent to Mobile',
                        'validateMobilewithOTP'=> 'Invalid OTP',
                    ],
                    'password'=>[
                        'required'=> "Password is required",
                        'min_length'=> 'Minimum 3 digit password'
                    ],        
                    'passconf'=>[
                        'required'=> "Confirm the password",
                        'matches'=>'Passwords do not match',
                    ],
                ];

            }
            else { // go for email login

                $rules = [
                    'user_id' => 'required|trim|valid_email',
                    'otp' =>      'required|validateEmailwithOTP[user_id,password]',
                    'password' => 'required|min_length[3]|max_length[255]',
                    'passconf' => 'trim|required|min_length[3]|max_length[255]|matches[password]',  
                ];

                $errors = [

                    'user_id'=>[
                        'required'=> "Email ID is required",
                        'valid_email'=> "Enter valid email",
                    ],
                    'otp'=>[
                        'required'=>'Enter OTP sent to Mobile',
                        'validateEmailwithOTP'=> 'Invalid OTP',
                    ],
                    'password'=>[
                        'required'=> "Password is required",
                        'min_length'=> 'Minimum 3 digit password'
                    ],        
                    'passconf'=>[
                        'required'=> "Confirm the password",
                        'matches'=>'Passwords do not match',
                    ],
                ];
            }


            if (!$this->validate($rules, $errors)) {

                $data['validation'] = $this->validator;   
                $this->render_view('Frontend/pages/reset_password',$data);     


            } else {  //ELse No error proceed login
                
                $model = new ClientModel();
               // $array = array('email' => $this->request->getVar('email'), 'status'=> 1);

               if(is_numeric($userInput)){  //Mobile Login

                    $user = $model->where('mobile', $userInput)
                            ->set('password', $this->request->getvar('password'))
                            ->set('pass_raw', $this->request->getvar('password'))
                            ->update();
               }
               else {   //Email Login
   
                $user = $model->where('email', $userInput)
                                ->set('password', $this->request->getvar('password'))
                                ->set('pass_raw', $this->request->getvar('password'))
                                ->update();
               }

                if($user){

                    $session = session();
                    $session->setFlashdata('success', 'Password Updated');
                    return redirect()->to(base_url('login/client'));

                }

                else {

                    return redirect()->to(base_url(''));

                }
              
            }
        }

        else {

            return redirect()->to(base_url(''));

        }
    }


    //Set New Password from Profile
    public function setPasswordbyClient(){

        if ($this->request->getMethod() == 'post') {

            $rules = [
                'password' => 'required|min_length[3]|max_length[255]',
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

                $array = array(
                    'error'   => true,
                    'password_error' => $this->validator->getError('password'),             
                    'passconf_error' => $this->validator->getError('passconf'),             
                ); 


            } else {  //ELse No error proceed


                $model = new ClientModel();
  
                $user = $model->where('cl_id' , session()->get('id'))
                        ->where('mobile', session()->get('mobile'))                   
                        ->set('password', $this->request->getvar('password'))
                        ->set('pass_raw', $this->request->getvar('password'))
                        ->update();

                $array = array(
                    'success'=>true,
                    'message' => '<div class="alert alert-success">Password Updated</div>'
                );


            }


            echo json_encode($array);


        }

        else {

            return redirect()->to(base_url(''));

        }


    }


    //UPdate Profile by Client
    public function profile(){

        $logged_user = session()->get('id');
        $userModel = new ClientModel();

        if ($this->request->getMethod() == 'post') {

            $rules = [
                'name' => 'required|trim',
                'email' => 'required|trim|valid_email|is_unique[clients.email,cl_id,'.$logged_user.']',
                'mobile' => 'trim|min_length[10]|max_length[10]|required|numeric|is_unique[clients.mobile,cl_id,'.$logged_user.']',    
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


            if (!$this->validate($rules,$errors)) {
                $data['validation'] = $this->validator;
                $data['client_data'] = $userModel->where('u_id',$logged_user)->first();  
                $this->render_view('Frontend/pages/profile',$data);  
                // return redirect()->to(base_url('profile'));
  

            }else {


                $data = [
                    'cl_id' => $logged_user,
                    'name' => strtoupper($this->request->getVar('name')),
                    'email' => $this->request->getVar('email'),
                    'mobile' => $this->request->getVar('mobile'),
                  
                ];
    
                $userModel->save($data);
                $session = session();
                $session->setFlashdata('success', 'Profile Updated');
                return redirect()->to(base_url('profile'));



            }



        }

        else {
                       
            $data = array( 
                
                'pageTitle' => 'PRIVATECH-PROFILE',
                'client_data'=>$userModel->where('cl_id',$logged_user)->first(),                                                         

            );      
                
                $this->render_view('Frontend/pages/profile',$data); 


        }
    }





    private function setUserSession($user)
    {
        $data = [
            'id' => $user['cl_id'],
            'name' => $user['name'],
            'mobile' => $user['mobile'],
            'email' => $user['email'],
            'isLoggedInClient' => true,
        ];

        session()->set($data);
        return true;
    }



}
