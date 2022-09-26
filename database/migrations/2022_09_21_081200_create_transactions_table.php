<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('income_id')->nullable()->constrained('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('expense_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('saving_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('bill_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('bill_type')->default(0);
            $table->integer('amount');
            $table->string('date');
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
        Schema::dropIfExists('transactions');
    }
}
