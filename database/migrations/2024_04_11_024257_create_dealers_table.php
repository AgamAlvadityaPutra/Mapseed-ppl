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
        Schema::create('dealers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('credential_id')->constrained('credentials')->onUpdate('cascade')->onDelete('cascade')->unique();
            $table->string("nama_dealer");
            $table->string("telepon_dealer");
            $table->string("email_dealer");
            $table->string("alamat_dealer");
            $table->string("surat_izin_distribusi");
            $table->string("foto_ktp");
            $table->text("riwayat_kerjasama");
            $table->string("pas_foto_dealer");
            $table->text("informasi_dealer");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dealers');
    }
};
