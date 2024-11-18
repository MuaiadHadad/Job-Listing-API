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
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Owner of the listing
            $table->string('title');
            $table->text('description');
            $table->string('company_name');
            $table->string('location');
            $table->decimal('salary', 10, 2)->nullable();
            $table->enum('job_type', ['full-time', 'part-time', 'remote','Internship','Temporary'])->default('full-time');
            $table->string('industry')->nullable();
            $table->integer('experience_level')->nullable(); // e.g., years of experience
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_listings');
    }
};
