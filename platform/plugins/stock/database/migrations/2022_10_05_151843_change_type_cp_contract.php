<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypeCpContract extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cp_contract', function (Blueprint $table) {
            $table->enum('type',['vnd','ubgxu','vnd-ubgxu'])->default('vnd-ubgxu')->comment('Loại hình trả lãi');
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
            $table->dropColumn('type');
        });
    }
}
