<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCpContractTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cp_contract', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->default(0);
            $table->string('name')->nullable()->comment('Tên khách hàng');
            $table->string('datebirth',10)->nullable()->comment('Ngày sinh');
            $table->string('phone')->nullable()->comment('Số điện thoại khách hàng');
            $table->text('ethnic')->nullable()->comment('Dân tộc');
            $table->text('nationality')->nullable()->comment('Quốc tịch');
            $table->text('passport_number')->nullable()->comment('CMND, Hộ chiếu, CCCD');
            $table->string('ngaycap')->nullable()->comment('Ngày cấp CMND');
            $table->text('current_address')->nullable()->comment('Nơi ở hiện tại');
            $table->text('address')->nullable()->comment('Địa chỉ thường trú');
            $table->string('card_front')->nullable()->comment('Mặt trước CMND');
            $table->string('card_back')->nullable()->comment('Mặt sau CMND');
            $table->text('bank_name')->nullable()->comment('Tên ngân hàng');
            $table->string('account_number')->nullable()->comment('Số tài khoản');
            $table->text('branch')->nullable()->comment('Chi nhánh');
            $table->text('account_holder')->nullable()->comment('Chủ tài khoản');
            $table->double('suat_dau_tu')->nullable()->comment('Suất đầu tư');
            $table->integer('ky_han')->nullable()->comment('Kỳ hạn');
            $table->double('price')->nullable()->comment('Giá 1 cổ phần');
            $table->integer('total')->nullable()->comment('Số lượng cổ phần');
            $table->integer('profit')->nullable()->comment('lợi nhuận');
            $table->integer('profit_vnd')->nullable()->comment('lợi nhuận VNĐ');
            $table->integer('profit_xu')->nullable()->comment('lợi nhuận VNĐ');
            $table->string('contract_code')->nullable()->comment('Mã hợp đồng');            
            $table->enum('status',['unsigned','signed','active','expired'])->default('unsigned')->comment('Trạng thái hợp đồng');
            $table->integer('confirm_id')->default(0)->comment('Người duyệt hợp đồng');
            $table->integer('presenter_id')->default(0)->comment('Người giới thiệu');
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
        Schema::dropIfExists('cp_contract');
    }
}
