<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Settings extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'id' => [
                'type' => 'INT',
                'constraint'     => 32,
                'auto_increment'=>true,
            ],         

            'key' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
                'unique' => true,
            ],
            'value' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
                'null' =>true,      
            ],

            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('settings');
    }

    public function down()
    {
        $this-forge->dropTable('settings');
    }
}
