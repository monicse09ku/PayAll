<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('user_id');
            $table->string('fund_type');
            $table->string('status', 15)->default('processing');
            $table->integer('amount');
            $table->string('type');
            $table->string('description');
            $table->string('from_user')->nullable();
            $table->string('to_user')->nullable();
            $table->string('transaction_id')->nullable();
            $table->timestamps();
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
