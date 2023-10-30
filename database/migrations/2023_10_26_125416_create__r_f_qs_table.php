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
        Schema::create('RFQs', function (Blueprint $table) {
            $table->id();
            $table->string('Company');
            $table->string('Pic');
            $table->string('Custom_Name');
            $table->string('Custom_Email');
            $table->string('Custom_Number');
            $table->string('RFQ_number')->unique();
            $table->string('RFQ_title');
            $table->date('Due_date');
            $table->decimal('Quota_mount', 10, 2); // Assuming Quota_mount is a decimal field
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('RFQs');
    }
};
