<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuruTable extends Migration
{
    public function up(): void
    {
        Schema::create('guru', function (Blueprint $table) {
            $table->string('nip')->primary(); // Primary key: nip
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('no_telp');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->date('tgl_lahir');
            $table->string('username_user'); // Merujuk ke username di users
            $table->string('kode'); // Merujuk ke kode di mapel
            $table->timestamps();

            $table->foreign('username_user')->references('username')->on('users')->onDelete('cascade');
            $table->foreign('kode')->references('kode')->on('mapel')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guru');
    }
}