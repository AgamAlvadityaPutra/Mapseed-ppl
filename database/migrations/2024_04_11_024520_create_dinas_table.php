<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dinas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('credential_id')->constrained('credentials')->onUpdate('cascade')->onDelete('cascade')->unique();
            $table->string("foto_dinas");
            $table->string("nama_dinas");
            $table->string("alamat_dinas");
            $table->string("email_dinas");
            $table->string("telepon_dinas");
            $table->text("informasi_dinas");
            $table->timestamps();
        });
        // DB::table("dinas")->insert(
        //     array(
        //         'credential_id' => 2,
        //         'foto_dinas' => 'jatim.png',
        //         'nama_dinas' => 'Kantor Dinas Ketahanan Pangan dan Peternakan Kabupaten Jember',
        //         'alamat_dinas' => 'Jl. Letjend Suprapto No.139, Lingkungan Krajan, Kebonsari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68122',
        //         'email_dinas' => 'dipertajatim@yahoo.com',
        //         'telepon_dinas' => '0331 337275',
        //         'informasi_dinas' => 'Dinas Pertanian dan Ketahanan Pangan Provinsi Jawa Timur Pusat Agribisnis Tanaman Pangan dan Hortikultura Terkemuka, Berdaya Saing dan Berkelanjutan',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     )
        // );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dinas');
    }
};
