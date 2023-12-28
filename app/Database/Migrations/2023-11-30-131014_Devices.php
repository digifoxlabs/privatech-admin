<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Devices extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'id' => [
                'type' => 'INT',
                'constraint'     => 32,
                'auto_increment'=>true,
            ],                 

            'client_id' => [
                'type' => 'INT',
            ],

            'mobile' => [
                'type' => 'VARCHAR',
                'constraint'=> '256'
            ],

            'device_id' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
                'null' => true,                
            ],
            'device_name' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
                'null' => true,                
            ],
            'device_token' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
                'null' => true,
            ],
            'status' => [
                'type' => 'INT',
                'constraint'=> '32',
                'default'=> 1   // 1::active 2:: disabled
            ],          

            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('devices');
    }

    public function down()
    {
        $this->forge->dropTable('devices');
    }
}
