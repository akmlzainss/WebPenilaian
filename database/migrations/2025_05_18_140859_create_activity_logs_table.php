<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityLogsTable extends Migration
{
    public function up()
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('user_type')->nullable(); // Admin, Guru, Murid
            $table->string('username')->nullable(); // ID pengguna (misalnya username)
            $table->string('action'); // create, update, delete
            $table->string('table_name'); // Nama tabel yang diubah (guru, murid, nilai, mapel)
            $table->text('description')->nullable(); // Deskripsi aktivitas
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('activity_logs');
    }
}