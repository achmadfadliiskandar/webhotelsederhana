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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('kamar_id');
            $table->integer('kodebooking');
            $table->integer('jumlah_penginap');
            $table->date('tanggal_rencanacheckin');
            $table->date('tanggal_rencanacheckout');
            $table->integer("totalharga");
            $table->integer("lama_menginap");
            $table->integer("dp_dibayar")->nullable();
            $table->enum('status',['confirmed','uncorfirmed','done']);
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
        Schema::dropIfExists('bookings');
    }
};
