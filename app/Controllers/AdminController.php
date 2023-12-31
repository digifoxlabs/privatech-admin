<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AdminController extends BaseController
{


	public function __construct() 
	{
		$this->db = db_connect(); // Loading database
        $group_data = array();
		if(empty(session()->get('isLoggedInAdmin'))) {
			$session_data = array('isLoggedInAdmin' => FALSE);
            session()->set($session_data);
		}
		else {
			$user_id = session()->get('id');
			$group_data = $this->getUserGroupByUserId($user_id);			
            if(isset($group_data['permissions'])){
               $permission['user_permission'] = unserialize($group_data['permissions']);
               $this->permission = unserialize($group_data['permissions']);   
            }        
		}	

    }

    public function getUserGroupByUserId($user_id) 
	{
        $builder = $this->db->table("user_group");
        $builder->select('user_group.u_id,user_group.g_id, groups.group_name, groups.permissions');
        $builder->join('groups', 'user_group.ug_id = groups.g_id');
        $builder->where('user_group.u_id',$user_id);
        return $builder->get()->getRowArray();
	}


    public function render_view($page = null, $data = array())
    {
         echo view('Backend/template/master/header',$data)
                . view('Backend/template/master/navbar', $data)
                . view('Backend/template/master/sidebar',$data)
                . view($page,$data)
                . view('Backend/template/master/footer',$data);
    }


    //Get Setings Value
    public function getSettings($key){

        $builder = $this->db->table("settings");
        $builder->select('value');
        $builder->where('key', $key);
        return $builder->get()->getRow('value');
    }


    //Get Role Name by ID
    public function roleNameByID($role){
        $builder = $this->db->table("groups");
        $builder->select('group_name');
        $builder->where('g_id', $role);
        return $builder->get()->getRow('group_name');
    }

    //Ger Role ID of User
    public function userRoleID($user){
        $builder = $this->db->table("user_group");
        $builder->select('g_id');
        $builder->where('u_id', $user);
        return $builder->get()->getRow('g_id');
    }


}
