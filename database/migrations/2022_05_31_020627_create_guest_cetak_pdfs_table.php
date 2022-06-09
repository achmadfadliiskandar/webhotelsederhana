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
        Schema::create('guest_cetak_pdfs', function (Blueprint $table) {
            $table->id();
            $table->integer("guest_bookings_id")->nullable();
            $table->integer("kodebooking")->nullable();
            $table->integer("kodeupdate")->nullable();
            $table->integer("hargakamar")->nullable();
            $table->integer("lamamenginap")->nullable();
            $table->integer("totalbayar")->nullable();
            $table->enum('metodepembayaran',['cash','transfer'])->nullable();
            $table->enum('statuspembayaran',['lunas','belumlunas'])->nullable();
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
        Schema::dropIfExists('guest_cetak_pdfs');
    }
};
