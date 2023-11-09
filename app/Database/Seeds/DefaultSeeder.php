<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DefaultSeeder extends Seeder
{
    public function run()
    {
              //Default User 
              $data = [
                'password' => password_hash("password", PASSWORD_DEFAULT),
                'name' => 'ADMIN',
                'mobile' => '9435173626',
                'email'    => 'admin@gmail.com',
                'gender'   => 'male',
                'user_type' => 'admin',
                'created_by' => 1,
                'status' => 1,    
            ];       
            
            $u_id= $this->db->table('users')->insert($data);
    
            //Admin permissions
            $gdata = [
                    
                    'group_name' => 'superadmin',
                    'permissions' => 'a:4:{i:0;s:9:"createAll";i:1;s:7:"viewAll";i:2;s:9:"updateAll";i:3;s:9:"deleteAll";}',             
        
            ];        
            $g_id = $this->db->table('groups')->insert($gdata);    
    
            //Map Default user-group
            $ugdata = [
                'u_id'=> $u_id,
                'g_id' => $g_id,
            ];
            $this->db->table('user_group')->insert($ugdata);
    }
}
