<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFundingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fundings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serial_number')->comment('申請編號');
            $table->string('title')->comment('申請名稱');
            $table->text('content')->comment('備註說明')->nullable();
            $table->date('date_start')->comment('開始日期')->nullable();
            $table->date('date_end')->comment('結束日期')->nullable();
            $table->string('total')->comment('金額總計')->default(0);
            $table->string('item_lists')->comment('項目清單')->nullable();
            $table->string('status')->comment('狀態 | 0 編輯經費 | 1 經費審核 | 3 審核完成')->default(0);
            $table->string('business')->comment('申請人員');
            $table->date('apply_date')->comment('申請日期')->nullable();
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
        Schema::dropIfExists('fundings');
    }
}
