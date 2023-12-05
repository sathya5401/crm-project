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
            $table->string('rfx_type');
            $table->string('remarks')->nullable();
            $table->string('decline')->nullable();
            $table->date('date_award')->nullable();
            $table->decimal('award_amount', 10, 2)->nullable();


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
