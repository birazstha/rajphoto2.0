<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTableNameToSavingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('savings', function (Blueprint $table) {
            Schema::rename('savings', 'banks');
        });
    }

 
    public function down()
    {
        Schema::table('savings', function (Blueprint $table) {
            Schema::drop('savings');
        });
    }
}
