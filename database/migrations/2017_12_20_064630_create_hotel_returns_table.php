<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_returns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('business')->comment('員工編號');
            $table->string('hotel_id')->comment('旅宿代號');
            $table->text('content')->comment('內容');
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
        Schema::dropIfExists('hotel_returns');
    }
}
