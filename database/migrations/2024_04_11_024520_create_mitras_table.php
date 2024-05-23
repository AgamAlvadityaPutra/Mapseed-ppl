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
        Schema::create('mitras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('credential_id')->constrained('credentials')->onUpdate('cascade')->onDelete('cascade')->unique();
            $table->string("nama_pimpinan_perusahaan");
            $table->string("nama_perusahaan");
            $table->string("telepon_perusahaan");
            $table->string("email_perusahaan");
            $table->string("alamat_perusahaan");
            $table->string("nomor_induk_berusaha");
            $table->string("akta_perusahaan");
            $table->string("npwp");
            $table->string("surat_pernyataan_usaha_perseorangan");
            $table->string("surat_izin_usaha_produksi_benih");
            $table->text("informasi_perusahaan");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mitras');
    }
};
