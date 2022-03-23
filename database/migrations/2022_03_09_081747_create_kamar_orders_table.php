<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kamar_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('booking_kode')->unique();
            $table->date('tanggal_checkin');
            $table->date('tanggal_checkout');
            $table->integer('jumlahdibayar');
            $table->enum('metodepembayaran',['cash','transfer']);
            $table->enum('statuspembayaran',['lunas','belumlunas']);
            $table->integer('user_id');
            $table->integer('resepsionis_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kamar_orders');
    }
};
