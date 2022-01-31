<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateProductOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_orders', function (Blueprint $table) {
            $table->increments('orderNo');
            $table->text('memoNo');
            $table->text('psocode');
            $table->text('customerCode');
            $table->text('address');
            $table->text('date');
            $table->text('totalQuantity');
            $table->text('subTotal');
            $table->text('productVat');
            $table->text('grandTotal');
            $table->integer('orderStatus')->default(0);
            $table->integer('empid')->default(0);
            $table->timestamps();
        });
        DB::statement("ALTER TABLE product_orders AUTO_INCREMENT = 7000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_orders');
    }
}
