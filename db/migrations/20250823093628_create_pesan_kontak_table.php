<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreatePesanKontakTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
         // Membuat tabel bernama 'pesan_kontak'
        $table = $this->table('pesan_kontak');
        
        // Menambahkan kolom-kolom
        $table->addColumn('nama', 'string', ['limit' => 100])
              ->addColumn('email', 'string', ['limit' => 100])
              ->addColumn('pesan', 'text')
              // Phinx otomatis menambahkan kolom 'created_at' dan 'updated_at'
              ->addTimestamps() 
              ->create();
    }
}
