<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMenuIdToAppointmentsTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('appointments', [
            'menu_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
                'comment' => '選択メニューID',
            ],
        ]);
        
        // 外部キー制約を追加
        $this->forge->addForeignKey('menu_id', 'menus', 'id', 'CASCADE', 'SET NULL');
    }

    public function down()
    {
        // 外部キー制約を削除
        $this->forge->dropForeignKey('appointments', 'appointments_menu_id_foreign');
        
        // カラムを削除
        $this->forge->dropColumn('appointments', 'menu_id');
    }
}
