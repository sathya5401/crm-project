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
        Schema::table('rfqs', function (Blueprint $table) {
            //
        $table->string('document_name')->nullable();
        $table->string('document_type')->nullable();
        $table->json('file')->nullable(); // Assuming you're storing file paths as JSON array
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rfqs', function (Blueprint $table) {
            //
        });
    }
};
