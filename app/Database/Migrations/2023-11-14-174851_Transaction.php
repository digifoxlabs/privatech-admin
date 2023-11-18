<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transaction extends Migration
{
    public function up()
    {
        $this->forge->addField([

            't_id' => [
                'type' => 'INT',
                'constraint'     => 32,
                'auto_increment'=>true,
            ],         

            'txn_id' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
                'unique'=>true,
            ],

            'client_id' => [
                'type' => 'INT',
                'constraint'=> 32,
            ],

            'txn_type' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ],

            'txn_mode' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ],

            'net_amount' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',            
            ],
            'tax_amt' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
                'default' => 0,
            ],          

            'price' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',                
            ],
                        
            'discount_amt' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
                'default' => 0,
            ],
                        
            'paid_amt' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ],        

            'plan_validity_days' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ],

            'package_name'=>[
                'type' => 'VARCHAR',
                'constraint'=> '256',    
                'null'=>true

            ],
            'activation_code'=>[
                'type' => 'VARCHAR',
                'constraint'=> '256',    
                'null'=>true

            ],
            'coupon_code'=>[
                'type' => 'VARCHAR',
                'constraint'=> '256',    
                'null'=>true
            ],

            'status' => [
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

        $this->forge->addPrimaryKey('t_id');
        $this->forge->createTable('transactions');
    }

    public function down()
    {
        $this->forge->dropTable('transactions');
    }
}
