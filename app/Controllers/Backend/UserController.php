<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;

// Load Model
use App\Models\UserModel;

class UserController extends BaseController
{
    public function login()
    {
        $data = array( 
            'pageTitle' => 'NILACHAL-Login',             
        ); 

        if ($this->request->getMethod() == 'post') {

            $userInput = $this->request->getvar('user_id');

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

                return view('Backend/pages/login', [
                    "validation" => $this->validator,'pageTitle' => 'Login',
                ]);
            } else {  //ELse No error proceed login
                
                $model = new UserModel();
               // $array = array('email' => $this->request->getVar('email'), 'status'=> 1);

               if(is_numeric($userInput)){  //Mobile Login

                    $user = $model->where('mobile', $userInput)
                    ->where('status', '1')
                    ->first();
               }
               else {   //Email Login
   
                $user = $model->where('email', $userInput)
                                ->where('status', '1')
                                ->first();
               }

                // Storing session values

                if($user){

                    $this->setUserSession($user);
                    // Redirecting to dashboard after login
                    return redirect()->to(base_url('admin/dashboard'));

                }

                else {

                    $session = session();
                    $session->setFlashdata('error', 'Invalid User ID');
                    return view('Backend/pages/login', ['pageTitle' => 'Login',
                    ]);

                }
              
            }
        }

        return view('Backend/pages/login', $data);
    }


    private function setUserSession($user)
    {
        $data = [
            'id' => $user['u_id'],
            'name' => $user['name'],
            'mobile' => $user['mobile'],
            'email' => $user['email'],
            'user_type' => $user['user_type'],
            'isLoggedInAdmin' => true,
        ];

        session()->set($data);
        return true;
    }


        //Check Input
        // public function user_id_type($input){

        //     if(preg_match("/^\d+\.?\d*$/",$input) && strlen($input)==10){
    
        //        echo "mobile";
                
        //         }else{
                
        //             echo "email";
                
        //         }
    
    
        // }

        public function logout()
        {
            session()->destroy();
            // return redirect()->to('admin/login');
            return redirect()->to(base_url('admin/login'));
        }




}
