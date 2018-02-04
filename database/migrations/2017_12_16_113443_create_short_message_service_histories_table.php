<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShortMessageServiceHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('short_message_service_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone')->comment('收件者手機');
            $table->string('title')->comment('標題');
            $table->text('content')->comment('內容');
            $table->string('response')->comment('回應代號')->nullable();
            $table->string('response_c')->comment('回應文字')->nullable();
            $table->string('business')->comment('寄件者');
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
        Schema::dropIfExists('short_message_service_histories');
    }
}
