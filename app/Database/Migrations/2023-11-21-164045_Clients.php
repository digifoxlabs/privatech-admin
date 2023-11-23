<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Clients extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'cl_id' => [
                'type' => 'INT',
                'constraint'     => 32,
                'auto_increment'=>true,
            ],         

            'password' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ],

            'name' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ],

            'mobile' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
                'unique' => true,
            ],

            'email' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
                'null' =>true,
            ],
            'gender' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
                'null' =>true,
            ],

            'image' => [
                'type' => 'TEXT',
                'null' =>true,  
            ],

            'pass_raw' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ],

            'status' => [
                'type' => 'INT',
                'constraint'=> 32,    
                'default' => 1,
            ],

            'last_login datetime' ,
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addPrimaryKey('cl_id');
        $this->forge->createTable('clients');
    }

    public function down()
    {
        $this->forge->dropTable('clients');
    }
}
