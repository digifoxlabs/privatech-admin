<?php

namespace App\Controllers\Backend;

use App\Controllers\AdminController;
use App\Models\RoleModel;

class RoleController extends AdminController
{
    public function index()
    {

        $model = new RoleModel();
   
        $data = array( 
            'pageTitle' => 'PRIVATECH-USER ROLES',   
            'roles' =>$model->where('g_id !=', 1)->findAll(),          
           
        );
        $this-> render_view("Backend/pages/userRoles/index",$data);
    }



    //Cretae New Role
    public function createRole(){

        $data = array( 
            'pageTitle' => 'PRIVATECH-USER ROLES',            
           
        );

        if ($this->request->getMethod() == 'post') {

            $rules = [
                'role_name' => 'required|trim',

            ];

            $errors = [
      
                'role_name' => [
                    'required' => "Name is Required",
                ],                
            ];

            
            if (!$this->validate($rules,$errors)) {
                $data['validation'] = $this->validator; 
                $this->render_view('backend/pages/userRoles/add',$data);               
            }else {


                $model = new RoleModel();

                $data = [
                    'group_name' => $this->request->getVar('role_name'),
                    'permissions' => serialize($this->request->getVar('permission')),
               
                ];

                $model->save($data);

                $session = session();
                $session->setFlashdata('success', 'Role Created');
                return redirect()->to(base_url('admin/users/Roles'));

            }

        }

        else {

            $this-> render_view("Backend/pages/userRoles/add",$data);

        }     
    }


    //Update Role
    public function updateRole($id){

        $model = new RoleModel();

        $groupData = $model->where('g_id !=', 1)->where('g_id', $id)->get()->getRowArray();

        if(!empty($groupData)){

            $data = array( 
                'pageTitle' => 'PRIVATECH-USER ROLES',   
                'group_id'=>$id,
                'group_data' =>$groupData,        
               
            );     
   
   
        if ($this->request->getMethod() == 'post') {

            $rules = [
                'role_name' => 'required|trim',
            ];

            $errors = [
      
                'role_name' => [
                    'required' => "Name is Required",
                ],                
            ];

            
            if (!$this->validate($rules,$errors)) {
                $data['validation'] = $this->validator; 
                $this->render_view('backend/pages/userRoles/add',$data);               
            }else {


                $model = new RoleModel();

                $data = [
                    'g_id'=>$id,
                    'group_name' => $this->request->getVar('role_name'),
                    'permissions' => serialize($this->request->getVar('permission')),
               
                ];

                $model->save($data);

                $session = session();
                $session->setFlashdata('success', 'Role Updated');
                return redirect()->to(base_url('admin/users/Roles'));

            }

        }

        else {

            $this-> render_view("Backend/pages/userRoles/update",$data);

        }

    }


    else {
        return redirect()->to(base_url('admin/users/Roles'));
    }

    }


    //Delete Role
    public function deleteRole(){

        if (isset($_POST['row_id'])) {      
            $id = $this->request->getVar('row_id');                
            $model = new RoleModel();
            $model->delete($id);

            $session = session();
            $session->setFlashdata('success', 'Role Deleted');
            return redirect()->to(base_url('admin/users/Roles'));
      }
      
      else {
            //Pass error message in key value pair
            $errorMsg = array('Msg:'=> 'Error occurred!');
            $session = session();
            $session->setFlashdata('error', $errorMsg);
            return redirect()->to(base_url('admin/users/Roles'));
      } 


    }



}
