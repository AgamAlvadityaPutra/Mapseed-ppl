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
        Schema::create('benih', function (Blueprint $table) {
            $table->id();
            $table->string("foto_produk");
            $table->string("nama_produk");
            $table->string("nama_varietas");
            $table->text("deskripsi");
            $table->string("berat_produk");
            $table->string("nomor_sertifikasi");
            $table->string("masa_berlaku_produk");
            $table->string("informasi_musim_tanam");
            $table->foreignId("mitra_id")->constrained("credentials")->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('benih');
    }
};
