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
            $table->boolean('can_create_rfx')->default(false);
            $table->boolean('can_edit_rfx')->default(false);
            $table->boolean('can_delete_rfx')->default(false);
            $table->boolean('can_connect_rfqs_data')->default(false);
            $table->boolean('can_connect_leads_data')->default(false);
            $table->boolean('can_download_data')->default(false);
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
