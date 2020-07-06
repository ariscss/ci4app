<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Komik extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			],
			'judul'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'slug' => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
				'null'           => TRUE,
			],
			'penulis' => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
				'null'           => TRUE,
			],
			'penerbit' => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
				'null'           => TRUE,
			],
			'sampul' => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'null'           => TRUE,
			],
			'created_at' => [
				'type'           => 'DATETIME',
				'null'           => TRUE,
			],
			'updated_at' => [
				'type'           => 'DATETIME',
				'null'           => TRUE,
			],
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('komik');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('komik');
	}
}
