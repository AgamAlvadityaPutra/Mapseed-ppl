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
        Schema::create('wilayahs', function (Blueprint $table) {
            $table->id();
            $table->string("wilayah")->unique();
            $table->string("foto_wilayah");
            $table->string("luas_lahan");
            $table->string("topografi");
            $table->string("tipe_tanah");
            $table->string("kondisi_iklim");
            $table->string("kesuburan_tanah");
            $table->string("drainase");
            $table->string("rekomendasi_tanaman");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wilayahs');
    }
};
