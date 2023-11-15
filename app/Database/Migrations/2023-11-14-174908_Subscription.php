<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Subscription extends Migration
{
    public function up()
    {
            $this->forge->addField([

            'subs_id' => [
                'type' => 'INT',
                'constraint'     => 32,
                'auto_increment'=>true,
            ],         

            'client_id' => [
                'type' => 'INT',
                'constraint'=> 32,
            ],

            'txn_id' => [
                'type' => 'INT',
                'constraint'=> 32,
            ],

            'subs_type' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
                'default'=>'plan'
            ],

            'started_at' => [
                'type' => 'DATE',
            ],        
            'ends_on' => [
                'type' => 'DATE',
            ],           
            'validity_days' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ],
            'status' => [
                'type' => 'INT',
                'constraint'=> 32,    
                'default' => 0, 
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addPrimaryKey('subs_id');
        $this->forge->createTable('subscriptions');

    }

    public function down()
    {
        $this->forge->dropTable('subscripions');
    }
}
