<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        DB::unprepared('
        CREATE TRIGGER `backstatusguest` AFTER DELETE ON `guest_bookings` FOR EACH ROW BEGIN INSERT INTO guest_booking_cancels(guest_bookings_id,nama,nomortelpon,email,kamar_id,kodebooking,kodedelete,jumlah_penginap,rencanacheckin,rencanacheckout,totalharga,lama_menginap,dp_dibayar,created_at, updated_at)VALUES(OLD.id,OLD.nama, OLD.nomortelpon,OLD.email,OLD.kamar_id,OLD.kodebooking,OLD.kodedelete,OLD.jumlah_penginap,OLD.rencanacheckin,OLD.rencanacheckout,OLD.totalharga,OLD.lama_menginap,OLD.dp_dibayar,OLD.created_at,OLD.updated_at); END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('backstatusguest');
    }
};
