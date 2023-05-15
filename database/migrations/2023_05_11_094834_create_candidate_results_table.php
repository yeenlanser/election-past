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
        Schema::create('candidate_result', function (Blueprint $table) {
            $table->id();
            $table->string('province');
            $table->integer('zone');
            $table->string('candidate_no');
            $table->string('title');
            $table->string('name_first_nameth');
            $table->string('last_name');
            $table->string('party');
            $table->integer('score');
        });
        Schema::create('candidate_result_geometries', function (Blueprint $table) {            
            $table->string('geometries_id');          
            $table->unsignedBigInteger('candidate_result_id');  
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_result');
    }
};