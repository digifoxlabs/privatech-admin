<?php

namespace App\Controllers\Frontend;

use App\Controllers\FrontendController;
// Load Model
use App\Models\UserModel;

class HomeController extends FrontendController
{

    public function __construct(){

        parent::__construct();
        $this->db = db_connect();

    }


    //HomePage
    public function index(){

        $data = array( 
            'pageTitle' => 'PRIVATECH-LOGIN'                                         
        );      
            
            $this->render_view('Frontend/pages/login',$data); 
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
            'pageTitle' => 'PRIVATECH-LOGIN',                                    
        );      

        //POST Request
        if($this->request->getPost()){

            $rules = [
                'name' => 'required|trim',
                'email' => 'required|trim|valid_email|is_unique[users.email]',
                'mobile' => 'trim|min_length[10]|max_length[10]|required|numeric|is_unique[users.mobile]',  
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

                $model = new UserModel();

                $userData = [
                    'name' => $this->request->getVar('name'),
                    'mobile' => $this->request->getVar('mobile'),
                    'email' => $this->request->getVar('email'),
                    'gender'   => null,
                    'user_type' => 'client',
                    'created_by' => 1,
                    'status' => 1,   
                    'password' => $this->request->getVar('password')                  
                ];

                $model->save($userData);

                $lastID = $model->getInsertID();
                if($lastID){


                    //Login Client to Dashboard
                    $user = $model->where('u_id', $lastID)
                                ->where('status', '1')
                                ->where('u_id !=' , '1')
                                ->first();


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



}
