<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnActiveDateToContract extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cp_contract', function (Blueprint $table) {
            $table->timestamp('active_date')->nullable()->comment('Ngày hiệu lực hợp đồng');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cp_contract', function (Blueprint $table) {
            //
        });
    }
}
