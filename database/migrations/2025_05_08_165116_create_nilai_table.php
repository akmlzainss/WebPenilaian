<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiTable extends Migration
{
    public function up(): void
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->id(); // Primary key: id (tetap seperti semula)
            $table->string('nip'); // Merujuk ke nip di guru
            $table->string('nis'); // Merujuk ke nis di murid
            $table->string('kode'); // Merujuk ke kode di mapel
            $table->integer('nilai');
            $table->string('predikat');
            $table->string('semester');
            $table->timestamps();

            $table->foreign('nip')->references('nip')->on('guru')->onDelete('cascade');
            $table->foreign('nis')->references('nis')->on('murid')->onDelete('cascade');
            $table->foreign('kode')->references('kode')->on('mapel')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
}