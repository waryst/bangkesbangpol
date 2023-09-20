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
        Schema::create('suaracalegprovs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('partai_id');
            $table->uuid('caleg_id');
            $table->uuid('tps_id');
            $table->uuid('desa_id');
            $table->uuid('kecamatan_id');
            $table->integer('jumlah');
            $table->timestamps();
        });
        Schema::table('suaracalegprovs', function (Blueprint $table) {
            $table->foreign('tps_id')->references('id')->on('tps')->onDelete('cascade');
            $table->foreign('caleg_id')->references('id')->on('calegs')->onDelete('cascade');
            $table->foreign('partai_id')->references('id')->on('partais')->onDelete('cascade');
            $table->foreign('desa_id')->references('id')->on('desas')->onDelete('cascade');
            $table->foreign('kecamatan_id')->references('id')->on('kecamatans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suaracalegprovs');
    }
};
