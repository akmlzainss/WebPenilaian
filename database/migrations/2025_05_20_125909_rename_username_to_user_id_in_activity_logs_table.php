<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameUsernameToUserIdInActivityLogsTable extends Migration
{
    public function up()
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            $table->renameColumn('username', 'user_id'); // Mengganti nama kolom dari username ke user_id
        });
    }

    public function down()
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            $table->renameColumn('user_id', 'username'); // Kembali ke username jika rollback
        });
    }
}