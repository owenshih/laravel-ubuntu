<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFundingItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funding_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serial_number')->comment('經費編號');
            $table->string('invoice')->comment('發票號碼')->nullable();
            $table->date('date')->comment('消費日期')->nullable();
            $table->text('title')->comment('項目')->nullable();
            $table->string('amount')->comment('發票金額')->default(0);
            $table->string('compiled')->comment('是否打統編| 1 有打統編 | 2 沒打統編')->default(0);
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
        Schema::dropIfExists('funding_items');
    }
}
