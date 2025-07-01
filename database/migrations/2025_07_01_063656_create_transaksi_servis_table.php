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
        Schema::create('transaksi_servis', function (Blueprint $table) {
            $table->id();
                $table->foreignId('antrian_servis_id')->constrained('antrian_servis');
    $table->foreignId('karyawan_id')->constrained('karyawans');
    $table->decimal('total_biaya', 10, 2);
    $table->enum('metode_pembayaran', ['tunai', 'transfer', 'kredit']);
    $table->timestamp('tanggal_pembayaran')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_servis');
    }
};
