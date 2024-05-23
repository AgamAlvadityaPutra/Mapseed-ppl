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
        Schema::create('credentials', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email');
            $table->string('password');
            $table->enum('role', ['admin', 'mitra', 'dealer', 'dinas']);
            $table->timestamps();
        });
        DB::table("credentials")->insert(
            array(
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'password' => 'admin',
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            )
        );
        // DB::table("credentials")->insert(
        //     array(
        //         'username' => 'DinasJember123',
        //         'email' => 'dipertajatim@yahoo.com',
        //         'password' => '123456',
        //         'role' => 'dinas',
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
        Schema::dropIfExists('credentials');
    }
};
