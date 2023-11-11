<?php

namespace App\Controllers\Frontend;

use App\Controllers\FrontendController;
// Load Model
use App\Models\UserModel;
use App\Models\OTPModel;


class ClientAuthenticate extends FrontendController
{

    public function __construct(){

        parent::__construct();
        $this->db = db_connect();


    }


    public function check_user(){

        if ($this->request->getMethod() == 'post') {

            $userInput = strtolower($this->request->getvar('user_id'));

            //Chek if input is number go for mobile login
            if(is_numeric($userInput)){

                $rules = [
                    'user_id' => 'trim|required|min_length[10]|max_length[10]|is_natural',
                ];

                $errors = [
                    'user_id'=>[
                        'min_length'=> "Enter 10 digit Mobile no.",
                        'max_length'=> "Enter 10 digit Mobile no.",
                    ],
                ];


            }
            //Email Login
            else {

                $rules = [
                    'user_id' => 'required|trim|valid_email|strtolower', 
                ];

                $errors = [
                    'user_id'=>[
                        'required'=> "Email or Mobile No",
                        'valid_email'=> "Enter Valid Email",
                    ],
                ];
            }

            if (!$this->validate($rules, $errors)) {

                $array = array(
                    'error'   => true,
                    'user_error' => $this->validator->getError('user_id'),             
                ); 


            } else {  //ELse No error proceed


                $model = new UserModel();
                $session = session();
          
                //Delete existing session
                $session->removeTempdata('default_mobile');
                $session->removeTempdata('default_email');

                if(is_numeric($userInput)){  //Check Mobile
 
                    $session->setTempdata('default_mobile', $userInput, 30);

                     $user = $model->where('mobile', $userInput)
                                     ->where('status', '1')
                                       ->first();
                }
                else {   //Check Email
    
                    $session->setTempdata('default_email', $userInput, 30);
                     $user = $model->where('email', $userInput)
                                    ->where('status', '1')
                                    ->first();
                }

                if($user){  //User Exists
                                
                    //Delete existing session
                    $session->removeTempdata('default_mobile');
                    $session->removeTempdata('default_email');

                    $session->setTempdata('user_input', $userInput, 45);

                    $array = array(
                        'success'=>true,
                        'message' => '<div class="alert alert-success">User validated</div>'
                    );

                } else{

                    $array = array(
                        'info'=>true,
                        'message' => '<div class="alert alert-warning">New User</div>'
                    );
                }


            }

            echo json_encode($array);

        }

    }


    //Password Login
    public function passwordLogin(){


        $session = session();
        if($session->getTempdata('user_input')){

            $data = array( 
                'pageTitle' => 'PRIVATECH-LOGIN'                                         
            );      
                
                $this->render_view('Frontend/pages/login_password',$data); 
        }

        else {

            return redirect()->to(base_url(''));
        }


    }


    //Authenticate Client for password login
    public function authPassword(){

        $data = array( 
            'pageTitle' => 'PRIVATECH-LOGIN'                                         
        ); 

        if ($this->request->getMethod() == 'post') {

            $userInput = strtolower($this->request->getvar('user_id'));

            //Chek if input is number go for mobile login
            if(is_numeric($userInput)){

                  $rules = [
                    'user_id' => 'required|min_length[10]|max_length[10]|is_natural',
                    'password' => 'required|min_length[3]|max_length[255]|validateUserwithMobile[user_id,password]',
                ];

                $errors = [

                    'user_id'=>[
                        'min_length'=> "Enter 10 digit Mobile no.",
                        'max_length'=> "Enter 10 digit Mobile no.",
                    ],
                    'password' => [
                        'validateUserwithMobile' => "Credentials do not match",
                    ],
                ];

            }
            else { // go for email login

                $rules = [
                    'user_id' => 'required|min_length[3]|max_length[50]|valid_email',
                    'password' => 'required|min_length[3]|max_length[255]|validateUserwithEmail[user_id,password]',
                ];

                $errors = [

                    'user_id'=>[
                        'valid_email'=> "Enter Valid Email"
                    ],
                    'password' => [
                        'validateUserwithEmail' => "Credentials do not match",
                    ],
                ];

            }


            if (!$this->validate($rules, $errors)) {

                // return view('Frontend/pages/login_password', [
                //     "validation" => $this->validator,'pageTitle' => 'Login',
                // ]);

                $data['validation'] = $this->validator;   
                $this->render_view('Frontend/pages/login_password',$data);     


            } else {  //ELse No error proceed login
                
                $model = new UserModel();
               // $array = array('email' => $this->request->getVar('email'), 'status'=> 1);

               if(is_numeric($userInput)){  //Mobile Login

                    $user = $model->where('mobile', $userInput)
                    ->where('status', '1')
                    ->where('u_id !=' , '1')
                    ->first();
               }
               else {   //Email Login
   
                $user = $model->where('email', $userInput)
                                ->where('status', '1')
                                ->where('u_id !=' , '1')
                                ->first();
               }

                // Storing session values

                if($user){

                    $this->setUserSession($user);
                    // Redirecting to dashboard after login
                    return redirect()->to(base_url('dashboard'));

                }

                else {

                    return redirect()->to(base_url('login/client'));

                }
              
            }
        }

        else {

            return redirect()->to(base_url(''));

        }


    }


    //Otp Login
    public function otpLogin(){


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
                
                $this->render_view('Frontend/pages/login_otp',$data); 
        }

        else {

            return redirect()->to(base_url(''));
        }

    }


    //Authenticate Client for OTP login
    public function authOTP(){

        $data = array( 
            'pageTitle' => 'PRIVATECH-LOGIN'                                         
        ); 

        if ($this->request->getMethod() == 'post') {



            $userInput = strtolower($this->request->getvar('user_id'));

            //Chek if input is number go for mobile login
            if(is_numeric($userInput)){

                  $rules = [
                    'user_id' => 'required|min_length[10]|max_length[10]|is_natural',
                    'otp' => 'required|validateMobilewithOTP[user_id,password]',
                ];

                $errors = [

                    'user_id'=>[
                        'min_length'=> "Enter 10 digit Mobile no.",
                        'max_length'=> "Enter 10 digit Mobile no.",
                    ],
                    'otp' => [
                        'validateMobilewithOTP' => "Credentials do not match",
                    ],
                ];

            }
            else { // go for email login

                $rules = [
                    'user_id' => 'required|min_length[3]|max_length[50]|valid_email',
                    'otp' => 'required|validateEmailwithOTP[user_id,password]',
                ];

                $errors = [

                    'user_id'=>[
                        'valid_email'=> "Enter Valid Email"
                    ],
                    'otp' => [
                        'validateEmailwithOTP' => "Credentials do not match",
                    ],
                ];

            }


            if (!$this->validate($rules, $errors)) {

                // return view('Frontend/pages/login_password', [
                //     "validation" => $this->validator,'pageTitle' => 'Login',
                // ]);

                $data['validation'] = $this->validator;   
                $this->render_view('Frontend/pages/login_otp',$data);     


            } else {  //ELse No error proceed login
                
                $model = new UserModel();
               // $array = array('email' => $this->request->getVar('email'), 'status'=> 1);

               if(is_numeric($userInput)){  //Mobile Login

                    $user = $model->where('mobile', $userInput)
                    ->where('status', '1')
                    ->where('u_id !=' , '1')
                    ->first();
               }
               else {   //Email Login
   
                $user = $model->where('email', $userInput)
                                ->where('status', '1')
                                ->where('u_id !=' , '1')
                                ->first();
               }

                // Storing session values

                if($user){

                    $this->setUserSession($user);
                    // Redirecting to dashboard after login
                    return redirect()->to(base_url('dashboard'));

                }

                else {

                    return redirect()->to(base_url('login/client'));
                }
              
            }

        }
        else {

            return redirect()->to(base_url(''));

        }

    }


    //Default Login through Email and Passwrd
    public  function defaultClientLogin(){


                //Send Email Otp
                $this->sendEmailOtp('axomiakaran@gmail.com', '123456');


        $data = array( 
            'pageTitle' => 'PRIVATECH-LOGIN'                                         
        ); 

        if ($this->request->getMethod() == 'post') {

            $userInput = strtolower($this->request->getvar('user_id'));

            //Chek if input is number go for mobile login
            if(is_numeric($userInput)){

                  $rules = [
                    'user_id' => 'required|min_length[10]|max_length[10]|is_natural',
                    'password' => 'required|min_length[3]|max_length[255]|validateUserwithMobile[user_id,password]',
                ];

                $errors = [

                    'user_id'=>[
                        'min_length'=> "Enter 10 digit Mobile no.",
                        'max_length'=> "Enter 10 digit Mobile no.",
                    ],
                    'password' => [
                        'validateUserwithMobile' => "Credentials do not match",
                    ],
                ];

            }
            else { // go for email login

                $rules = [
                    'user_id' => 'required|min_length[3]|max_length[50]|valid_email',
                    'password' => 'required|min_length[3]|max_length[255]|validateUserwithEmail[user_id,password]',
                ];

                $errors = [

                    'user_id'=>[
                        'valid_email'=> "Enter Valid Email"
                    ],
                    'password' => [
                        'validateUserwithEmail' => "Credentials do not match",
                        'min_length'=>'Password is too short'
                    ],
                ];

            }


            if (!$this->validate($rules, $errors)) {

                $data['validation'] = $this->validator;   
                $this->render_view('Frontend/pages/login_default',$data);     


            } else {  //ELse No error proceed login
                
                $model = new UserModel();
               // $array = array('email' => $this->request->getVar('email'), 'status'=> 1);

               if(is_numeric($userInput)){  //Mobile Login

                    $user = $model->where('mobile', $userInput)
                    ->where('status', '1')
                    ->where('u_id !=' , '1')
                    ->first();
               }
               else {   //Email Login
   
                $user = $model->where('email', $userInput)
                                ->where('status', '1')
                                ->where('u_id !=' , '1')
                                ->first();
               }

                // Storing session values

                if($user){

                    $this->setUserSession($user);
                    // Redirecting to dashboard after login
                    return redirect()->to(base_url('dashboard'));

                }

                else {

                    return redirect()->to(base_url('login/client'));

                }
              
            }
        }

        else {

            $this->render_view('Frontend/pages/login_default',$data); 

        }




    }



    private function setUserSession($user)
    {
        $data = [
            'id' => $user['u_id'],
            'name' => $user['name'],
            'mobile' => $user['mobile'],
            'email' => $user['email'],
            'user_type' => $user['user_type'],
            'isLoggedInClient' => true,
        ];

        session()->set($data);
        return true;
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url(''));
    }


}