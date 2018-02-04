<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShortMessageServiceExamplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('short_message_service_examples', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('標題');
            $table->string('content')->comment('內容');
            $table->string('status')->comment('狀態 | -1 刪除 | 1 正常')->default(1);
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
        Schema::dropIfExists('short_message_service_examples');
    }
}
