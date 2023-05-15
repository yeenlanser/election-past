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
        Schema::create('election_geometries', function (Blueprint $table) {
            $table->string('id');
            $table->string('id_geometries');
            $table->string('arcs');
            $table->string('type');
            $table->integer('zone_id');
            $table->integer('province_id');
            $table->string('code_name');
            $table->string('code_name_en');
            $table->integer('region_id');
            $table->string('zone_detail1');
            $table->string('zone_name');
            $table->integer('election_object_id');
        });
        Schema::create('election_object_geometries', function (Blueprint $table) {
            $table->unsignedBigInteger('election_object_id');
            $table->string('geometries_id');            
        });
    }

    /**
     * Reverse the migrations. 
     */
    public function down(): void
    {
        Schema::dropIfExists('election_geometries');
    }
};