<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTblPsosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_psos', function (Blueprint $table) {
            $table->increments('psocode');
            $table->text('psoname');
            $table->text('designation');
            $table->text('password');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE tbl_psos AUTO_INCREMENT = 1000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_psos');
    }
}
