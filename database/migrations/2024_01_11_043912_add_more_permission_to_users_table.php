<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->boolean('can_create_custom')->default(false);
            $table->boolean('can_edit_custom')->default(false);
            $table->boolean('can_delete_custom')->default(false);
            $table->boolean('can_create_meeting')->default(false);
            $table->boolean('can_send_email')->default(false);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
