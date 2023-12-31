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
        Schema::create('suaracapres', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('capres_id');
            $table->uuid('tps_id');
            $table->uuid('desa_id');
            $table->uuid('kecamatan_id');
            $table->integer('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suaracapres');
    }
};
