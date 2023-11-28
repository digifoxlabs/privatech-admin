<?php

namespace App\Controllers\Backend;

use App\Controllers\AdminController;

// Load Model
use App\Models\UserModel;
use App\Models\RoleModel;

class UserController extends AdminController
{

    public function login(){
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


    private function setUserSession($user){
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

    public function logout(){
        session()->destroy();
        // return redirect()->to('admin/login');
        return redirect()->to(base_url('admin/login'));
    }


    /**
     * MANAGE EMPLOYEES
     */
    public function employees(){

        $data = array( 
            'pageTitle' => 'MCS-Customers',             
           
        );
        $this-> render_view("Backend/pages/users/index",$data);
    }

    //AJAX Call GET all users
    public function ajaxCallAllUsers(){


        $params['draw'] = $_REQUEST['draw'];
        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];
        /* If we pass any extra data in request from ajax */
        //$value1 = isset($_REQUEST['key1'])?$_REQUEST['key1']:"";

        /* Value we will get from typing in search */
        $search_value = $_REQUEST['search']['value'];

        if(!empty($search_value)){


            $builder = $this->db->table('users');
            $builder->select('*');
            $builder->join('user_group', 'user_group.u_id = users.u_id', 'left');
            $builder->join('groups', 'groups.g_id = user_group.g_id', 'left');
            $builder->like('users.name', $search_value);
            $builder->where('users.u_id !=', 1);
            $query = $builder->get();
            $total_count = $query->getResult();       


            $builder = $this->db->table('users');
            $builder->select('*');
            $builder->join('user_group', 'user_group.u_id = users.u_id', 'left');
            $builder->join('groups', 'groups.g_id = user_group.g_id', 'left');
            $builder->like('users.name', $search_value);
            $builder->where('users.u_id !=', 1);
            $builder->limit($start, $length);
            $query2 = $builder->get();
            $data = $query2->getResult();

    
        }


        else if(!empty($valueStatus)){


            $builder = $this->db->table('users');
            $builder->select('*');
            $builder->join('user_group', 'user_group.u_id = users.u_id', 'left');
            $builder->join('groups', 'groups.g_id = user_group.g_id', 'left');
            $builder->where('clients.status', $valueStatus);
            $builder->where('users.u_id !=', 1);
            $query = $builder->get();
            $total_count = $query->getResult();       


            $builder = $this->db->table('users');
            $builder->select('*');
            $builder->join('user_group', 'user_group.u_id = users.u_id', 'left');
            $builder->join('groups', 'groups.g_id = user_group.g_id', 'left');
            $builder->where('clients.status', $valueStatus);
            $builder->where('users.u_id !=', 1);
            $builder->limit($start, $length);
            $query2 = $builder->get();
            $data = $query2->getResult();


        } 
             
        
        else{
           
                 
            $builder = $this->db->table('users');
            $builder->select('*');
            $builder->join('user_group', 'user_group.u_id = users.u_id', 'left');
            $builder->join('groups', 'groups.g_id = user_group.g_id', 'left');
            $builder->where('users.u_id !=', 1);
            $query = $builder->get();
            $total_count = $query->getResult();       


            $builder = $this->db->table('users');
            $builder->select('*');
            $builder->join('user_group', 'user_group.u_id = users.u_id', 'left');
            $builder->join('groups', 'groups.g_id = user_group.g_id', 'left');
            $builder->where('users.u_id !=', 1);
            $builder->limit($start, $length);
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



    public function addEmployee(){


        $model = new RoleModel();


        $data = array( 
            'pageTitle' => 'PRIVATECH-USER ROLES',  
            'userRoles'=> $model->where('g_id !=', 1)->findAll(),        
           
        );

        if ($this->request->getMethod() == 'post') {

            $rules = [
                'name' => 'required|trim',
                'email' => 'required|trim|valid_email|is_unique[users.email]',
                'mobile' => 'trim|min_length[10]|max_length[10]|required|numeric|is_unique[users.mobile]',  
                'password' => 'trim|required|min_length[3]|max_length[255]',       
                'passconf' => 'trim|required|min_length[3]|max_length[255]|matches[password]',       
                'status'=> 'trim|required',
                'role'=>'trim|required',
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
                'status'=>[
                    'required'=> "Status is required",
                ],           
                'role'=>[
                    'required'=> "Role is required",
                ],
               
            ];

            
            if (!$this->validate($rules,$errors)) {
                $data['validation'] = $this->validator; 
                $this->render_view('backend/pages/users/add',$data);               
            }else {


                $logged_user = session()->get('id');
                $g_id = $this->request->getVar('role');
                $userType = $this->roleNameByID($g_id);

                $model = new UserModel();

                $userData = [
                    'name' => $this->request->getVar('name'),
                    'mobile' => $this->request->getVar('mobile'),
                    'email' => $this->request->getVar('email'),
                    'gender'   => null,
                    'status' => $this->request->getVar('status'),   
                    'password' => $this->request->getVar('password'),                  
                    'created_by' => $logged_user,
                    'user_type'=> $userType,
                ];

                if($logged_user)
                    $model->save($userData);



                    $lastUserID = $model->getInsertID();

                    if($lastUserID){

    
                            //Create a User Groups Entry                      
                            $groupData = [
                                'u_id' => $lastUserID,                            
                                'g_id' => $g_id,                                         
                            ];

                            $builder = $this->db->table('user_group');
                            $builder->insert($groupData);

                            $session = session();
                            $session->setFlashdata('success', 'User Created');
                            return redirect()->to(base_url('admin/users'));
    
                    }              

            }

        }

        else {

            $this-> render_view("Backend/pages/users/add",$data);

        }  

    }



    //Update Employee
    public function updateEmployee($empID){

        $model = new RoleModel();
        $userModel = new UserModel();
        $user_role_id = $this->userRoleID($empID);

        $data = array( 
            'pageTitle' => 'PRIVATECH-USER ROLES',  
            'userRoles'=> $model->where('g_id !=', 1)->findAll(),   
            'role_id'=> $user_role_id,
            'employeeData'=>$userModel->where('u_id',$empID)->first(),        
           
        );

        if($this->request->getMethod() == 'post') {

            $rules = [
                'name' => 'required|trim',
                'email' => 'required|trim|valid_email|is_unique[users.email,u_id,'.$empID.']',
                'mobile' => 'trim|min_length[10]|max_length[10]|required|numeric|is_unique[users.mobile,u_id,'.$empID.']',  
                'password' => 'trim|required|min_length[3]|max_length[255]',       
                'passconf' => 'trim|required|min_length[3]|max_length[255]|matches[password]',       
                'status'=> 'trim|required',
                'role'=>'trim|required',
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
                'status'=>[
                    'required'=> "Status is required",
                ],           
                'role'=>[
                    'required'=> "Role is required",
                ],
               
            ];

            
            if (!$this->validate($rules,$errors)) {
                $data['validation'] = $this->validator; 
                $this->render_view('backend/pages/users/update',$data);               
            }else {


                $logged_user = session()->get('id');
                $g_id = $this->request->getVar('role');
                $userType = $this->roleNameByID($g_id);

                $model = new UserModel();

                $userData = [

                    'u_id'=>$empID,
                    'name' => $this->request->getVar('name'),
                    'mobile' => $this->request->getVar('mobile'),
                    'email' => $this->request->getVar('email'),
                    'gender'   => null,
                    'status' => $this->request->getVar('status'),   
                    'password' => $this->request->getVar('password'),                  
                    'user_type'=> $userType,
                ];

                if($logged_user)
                    $model->save($userData);


                //Update User Groups Entry                      
                $groupData = [                     
                    'g_id' => $g_id,                                         
                ];

                $builder = $this->db->table('user_group');
                $builder->where('u_id',$empID);
                $builder->update($groupData);

                $session = session();
                $session->setFlashdata('success', 'User updated');
                return redirect()->to(base_url('admin/users'));
    

            }




        }

        else {

            $this-> render_view("Backend/pages/users/update",$data);

        }

    }



       //Delete User
       public function delete(){

        if (isset($_POST['row_id'])) {      

            $id = $this->request->getVar('row_id');                
            $model = new UserModel();
            $model->delete($id);


            //Delete User Group
            $builder = $this->db->table("user_group");
            $builder->where('u_id',$id);
            $builder->delete();

            $session = session();
            $session->setFlashdata('success', 'User Deleted');
            return redirect()->to(base_url('admin/users'));
      }
      
      else {
            //Pass error message in key value pair
            $errorMsg = array('Msg:'=> 'Error occurred!');
            $session = session();
            $session->setFlashdata('error', $errorMsg);
            return redirect()->to(base_url('admin/users'));
      } 


    }




}