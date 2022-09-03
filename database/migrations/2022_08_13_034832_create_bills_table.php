<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('grand_total');
            $table->integer('paid_amount');
            $table->integer('balance_amount');
            $table->integer('cash_received');
            $table->integer('cash_return');
            $table->string('ordered_date');
            $table->string('delivery_date');
            $table->foreignId('user_id')->constrained('frontend_users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('qr_code')->unique()->nullable();
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
        Schema::dropIfExists('bills');
    }
}
