<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Coupons extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'cp_id' => [
                'type' => 'INT',
                'constraint'     => 32,
                'auto_increment'=>true,
            ],         

            'coupon' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
                'unique' => true,
            ],
            'promoter_name' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
                'null' =>true,      
            ],

            'discount_percentage' => [
                'type' => 'VARCHAR',
                'constraint'=> '32',
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

        $this->forge->addPrimaryKey('cp_id');
        $this->forge->createTable('coupons');

    }

    public function down()
    {
        $this->forge->dropTable('coupons');
    }
}
