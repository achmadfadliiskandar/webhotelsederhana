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
        Schema::create('detail_kamar_orders', function (Blueprint $table) {
            $table->id();
            $table->integer("kamar_orders_id")->nullable();
            // $table->integer("kamars_id");
            $table->date('tanggal_checkin');
            $table->date('tanggal_checkout');
            // $table->integer("jumlah_penginap");
            $table->integer("bookings_id");
            $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('detail_kamar_orders');
    }
};
