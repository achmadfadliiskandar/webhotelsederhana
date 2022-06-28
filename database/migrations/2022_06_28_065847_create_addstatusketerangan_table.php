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
        CREATE TRIGGER `addstatusketerangan` AFTER INSERT ON `guest_cetak_pdfs` FOR EACH ROW BEGIN UPDATE guest_bookings INNER JOIN guest_cetak_pdfs ON guest_bookings.id = guest_cetak_pdfs.guest_bookings_id SET guest_bookings.konfirmasi = "DONE" WHERE guest_bookings.id = guest_cetak_pdfs.guest_bookings_id; END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('changestatusguest');
    }
};
