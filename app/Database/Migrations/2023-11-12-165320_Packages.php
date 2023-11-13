<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Packages extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'pck_id' => [
                'type' => 'INT',
                'constraint'     => 32,
                'auto_increment'=>true,
            ],         

            'name' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ],

            'duration_in_days' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ],

            'net_amount' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',            
            ],
            'tax' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
                'default' => 0,
            ],
            'price' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
                'null' =>true,
            ],

            'is_active' => [
                'type' => 'INT',
                'constraint'=> 32,    
                'default' => 1, 
            ],

            'created_by' => [
                'type' => 'INT',
                'constraint'=> 32,    
            ],

            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addPrimaryKey('pck_id');
        $this->forge->createTable('packages');
    }

    public function down()
    {
        $this->forge->dropTable('packages');
    }
}
