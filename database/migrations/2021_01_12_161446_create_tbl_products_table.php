<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTblProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_products', function (Blueprint $table) {
            $table->increments('productCode');
            $table->text('loadingNo');
            $table->text('productName');
            $table->text('productRate');
            $table->text('productVat');
            $table->text('quantity');
            $table->text('receivedDate');
            $table->text('expDate');
            $table->text('empid');
            $table->integer('status')->default(0);
            $table->timestamps();
        });
        DB::statement("ALTER TABLE tbl_products AUTO_INCREMENT = 5000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_products');
    }
}
