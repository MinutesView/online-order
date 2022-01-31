<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblInventoryIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_inventory_issues', function (Blueprint $table) {
            $table->increments('issueCode');
            $table->text('productCode');
            $table->text('productName');
            $table->text('loadingNo');
            $table->text('date');
            $table->text('issueDetails');
            $table->text('quantity');
            $table->text('empid');
            $table->integer('issuestatus')->default(0);
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
        Schema::dropIfExists('tbl_inventory_issues');
    }
}
