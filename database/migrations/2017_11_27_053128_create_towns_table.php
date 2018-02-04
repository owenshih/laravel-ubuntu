<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTownsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('towns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('city_id')->comment('所屬縣市id');
            $table->string('postal')->comment('郵遞區號');
            $table->string('chinese_name')->comment('中文名稱');
            $table->string('engilsh_name')->comment('英文名稱')->nullable();
            $table->string('status')->comment('控制')->default(1);
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
        Schema::dropIfExists('towns');
    }
}
