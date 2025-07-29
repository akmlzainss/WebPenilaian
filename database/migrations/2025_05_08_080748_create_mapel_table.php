<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapelTable extends Migration
{
    public function up(): void
    {
        Schema::create('mapel', function (Blueprint $table) {
            $table->string('kode')->primary(); // Primary key: kode
            $table->string('mata_pelajaran');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mapel');
    }
}