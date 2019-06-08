<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE TRIGGER create_masuk AFTER INSERT ON inventaris_masuk FOR EACH ROW

        BEGIN
            UPDATE inventaris SET jumlah = jumlah + new.jumlah_masuk WHERE id_inventaris = new.id_inventaris;
        END');
        DB::unprepared('CREATE TRIGGER update_masuk AFTER UPDATE ON inventaris_masuk FOR EACH ROW

        BEGIN
            UPDATE inventaris SET jumlah = jumlah - old.jumlah_masuk WHERE id_inventaris = new.id_inventaris;
            UPDATE inventaris SET jumlah = jumlah + new.jumlah_masuk WHERE id_inventaris = new.id_inventaris;
        END');
        DB::unprepared('CREATE TRIGGER create_keluar AFTER INSERT ON inventaris_keluar FOR EACH ROW

        BEGIN
            UPDATE inventaris SET jumlah = jumlah - new.jumlah_keluar WHERE id_inventaris = new.id_inventaris;
        END');
        DB::unprepared('CREATE TRIGGER update_keluar AFTER UPDATE ON inventaris_keluar FOR EACH ROW

        BEGIN
            UPDATE inventaris SET jumlah = jumlah + old.jumlah_keluar WHERE id_inventaris = new.id_inventaris;
            UPDATE inventaris SET jumlah = jumlah - new.jumlah_keluar WHERE id_inventaris = new.id_inventaris;
        END');
        DB::unprepared('CREATE TRIGGER create_pinjam AFTER INSERT ON peminjaman FOR EACH ROW

        BEGIN
            UPDATE inventaris SET jumlah = jumlah - new.jumlah_pinjam WHERE id_inventaris = new.id_inventaris;
        END');
        DB::unprepared('CREATE TRIGGER update_pinjam AFTER UPDATE ON peminjaman FOR EACH ROW

        BEGIN
            UPDATE inventaris SET jumlah = jumlah + new.jumlah_pinjam WHERE id_inventaris = new.id_inventaris;
        END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `create_masuk`');
    }
}
