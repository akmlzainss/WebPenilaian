<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMuridTable extends Migration
{
    public function up(): void
    {
        Schema::create('murid', function (Blueprint $table) {
            $table->string('nis')->primary(); // Primary key: nis
            $table->string('nama');
            $table->string('kelas');
            $table->string('no_telp')->unique();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->date('tgl_lahir');
            $table->string('username_user'); // Merujuk ke username di users
            $table->timestamps();

            $table->foreign('username_user')->references('username')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('murid');
    }
}