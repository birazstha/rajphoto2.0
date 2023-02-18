<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangesColToAdjustmentsTable extends Migration
{

    public function up()
    {
        Schema::table('adjustments', function (Blueprint $table) {
            $table->dropColumn('closing_balance');
            $table->bigInteger('amount');
            $table->string('type')->nullable();
        });
    }


    public function down()
    {
        Schema::table('adjustments', function (Blueprint $table) {
            $table->integer('closing_balance');
            $table->dropColumn('type')->nullable();
            $table->dropColumn('amount');
        });
    }
}
