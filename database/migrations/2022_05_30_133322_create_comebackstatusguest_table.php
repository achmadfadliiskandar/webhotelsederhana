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
        CREATE TRIGGER `comebackstatusguest` AFTER INSERT ON `guest_booking_cancels` FOR EACH ROW BEGIN UPDATE kamars INNER JOIN guest_booking_cancels ON kamars.id = guest_booking_cancels.kamar_id SET kamars.status = "tersedia" WHERE kamars.id = guest_booking_cancels.kamar_id; END'
    );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('comebackstatusguest');
    }
};
