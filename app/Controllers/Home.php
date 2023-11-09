<?php

namespace App\Controllers;
// Load Model
use App\Models\UserModel;


class Home extends BaseController
{
    public function index(): string
    {
        return view('Frontend\login');
    }


    public function login(){

        if ($this->request->getMethod() == 'post') {


            $userInput = $this->request->getvar('user_id');


            $rules = [
                'user_id' => 'required|min_length[3]|max_length[50]|valid_email',
                'password' => 'required|min_length[3]|max_length[255]|validateUserwithEmail[user_id,password]',
            ];

            $errors = [

                'user_id'=>[
                    'required'=> "Email is required",
                    'valid_email'=> "Enter valid Email"
                ],

                'password' => [
                    'required' => "Enter Password",
                    'validateUserwithEmail' => "Credentials donot match"
                ],
            ];
           

            if (!$this->validate($rules, $errors)) {

                $array = array(
                    'error'   => true,
                    'email_error' => $this->validator->getError('user_id'),
                    'password_error' => $this->validator->getError('password'),
             
                );             
                            


            } else {

                $model = new UserModel();

                $user = $model->where('email', $userInput)
                ->where('status', '1')
                ->first();
                if($user){

                    $this->setUserSession($user);
                 }


                 $array = array(
                    'success' => '<div class="alert alert-success">Logging Successfully....</div>'
                );

                //Redirect to Dashboard


            }

            echo json_encode($array);

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
            'isLoggedInAdmin' => true,
        ];

        session()->set($data);
        return true;
    }



}
