<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_number')->comment('業者帳號')->nullable();
            $table->string('account_type')->comment('業者登入方式|帳密註冊 Normal|FB FaceBook|Wechat Wechat')->nullable();
            $table->string('chinese_name')->comment('旅宿中文名稱');
            $table->string('engilsh_name')->comment('旅宿英文名稱')->nullable();
            $table->string('type')->comment('旅宿類型等級')->nullable();
            $table->string('postal')->comment('郵遞區號')->nullable();
            $table->integer('city')->comment('縣市')->nullable();
            $table->integer('town')->comment('地區')->nullable();
            $table->string('address')->comment('地址')->nullable();
            $table->string('map_api_lat')->comment('GoogleMapApiLat')->nullable();
            $table->string('map_api_lng')->comment('GoogleMapApiLng')->nullable();
            $table->string('phone')->comment('訂房專線')->nullable();
            $table->string('fax')->comment('傳真號碼')->nullable();
            $table->string('website')->comment('網站網址')->nullable();
            $table->string('room_count')->comment('房間總數')->default(0);
            $table->string('facebook')->comment('FB連結')->nullable();

            $table->string('main_name')->comment('簽約人姓名')->nullable();
            $table->string('main_title')->comment('簽約人職稱')->nullable();
            $table->string('main_phone')->comment('簽約人手機')->nullable();
            $table->string('main_email')->comment('簽約人郵件')->nullable();

            $table->string('admin_name')->comment('管理員姓名')->nullable();
            $table->string('admin_title')->comment('管理員職稱')->nullable();
            $table->string('admin_phone')->comment('管理員電話')->nullable();
            $table->string('admin_email')->comment('管理員郵件')->nullable();

            $table->string('accounting_name')->comment('會計姓名')->nullable();
            $table->string('accounting_phone')->comment('會計電話')->nullable();
            $table->string('accounting_email')->comment('會計郵件')->nullable();

            $table->string('invoice_number')->comment('統一編號')->nullable();
            $table->string('invoice_title')->comment('統邊抬頭')->nullable();

            $table->string('bank_name')->comment('銀行名稱')->nullable();
            $table->string('bank_branch')->comment('銀行分行')->nullable();
            $table->string('bank_title')->comment('戶名')->nullable();
            $table->string('bank_account')->comment('銀行帳號')->nullable();
            $table->string('pay_type')->comment('訂金付款方式')->nullable();

            $table->string('status')->comment('狀態|-3 解約下架|-2 拒絕簽約|-1 暫不簽約|0 尚未開發尚未簽約|1 已開始拜訪|2 簽約審核中|3 簽約完成')->default(0);
            $table->date('signing_date')->comment('簽約日期')->nullable();
            $table->string('signing_business')->comment('簽約業務')->nullable();

            $table->string('e_contract')->comment('電子合約|0 尚未提供|1 審核中間|2 審核完成')->default(0);
            $table->text('e_contract_image')->comment('電子合約照片清單')->nullable();
            $table->string('p_contract')->comment('紙本合約|0 尚未提供|1 審核中間|2 審核完成')->default(0);
            $table->text('p_contract_image')->comment('紙本合約照片清單')->nullable();
            
            $table->string('dev_level')->comment('開發等級|0 一般開發|1 重點開發')->default(0);
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
        Schema::dropIfExists('hotels');
    }
}
