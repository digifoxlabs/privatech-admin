<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ActivationCodes extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'c_id' => [
                'type' => 'INT',
                'constraint'     => 32,
                'auto_increment'=>true,
            ],         

            'code' => [
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
            ],

            'is_active' => [
                'type' => 'INT',
                'constraint'=> 32,    
                'default' => 1, 
            ],
            'used_by' => [
                'type' => 'INT',
                'constraint'=> 32,    
            ],
            'created_by' => [
                'type' => 'INT',
                'constraint'=> 32,    
            ],

            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addPrimaryKey('c_id');
        $this->forge->createTable('activation_codes');
    }

    public function down()
    {
        $this->forge->dropTable('activation_codes');
    }
}
