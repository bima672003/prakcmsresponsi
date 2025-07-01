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
        Schema::create('antrian_servis', function (Blueprint $table) {
            $table->id();
                $table->foreignId('kendaraan_id')->constrained('kendaraans');
    $table->foreignId('pelanggan_id')->constrained('pelanggans');
    $table->foreignId('karyawan_id')->nullable()->constrained('karyawans');
    $table->timestamp('waktu_daftar')->useCurrent();
    $table->enum('status', ['dalam antrian', 'sedang diservis', 'selesai'])->default('dalam antrian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antrian_servis');
    }
};
