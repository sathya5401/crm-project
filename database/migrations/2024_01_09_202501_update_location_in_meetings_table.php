<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('meetings', function (Blueprint $table) {
        $table->string('location', 500)->change();
    });
}

public function down()
{
    Schema::table('meetings', function (Blueprint $table) {
        $table->string('location', 255)->change();
    });
}
};
