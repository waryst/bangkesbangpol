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
        Schema::create('suaratidaksahs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('tps_id');
            $table->uuid('desa_id');
            $table->uuid('kecamatan_id');
            $table->integer('presiden')->default(0);
            $table->integer('gubernur')->default(0);
            $table->integer('bupati')->default(0);
            $table->integer('dpd')->default(0);
            $table->integer('dpr_ri')->default(0);
            $table->integer('dpr_prov')->default(0);
            $table->integer('dpr_kab')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suaratidaksahs');
    }
};
