<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topups', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('user_id');
            $table->string('topup_transaction_id')->nullable();
            $table->string('number')->nullable();
            $table->string('amount');
            $table->string('country');
            $table->string('status', 15)->default('pending');
            $table->string('type')->nullable();
            $table->string('operator')->nullable();
            $table->string('pradesh')->nullable();
            $table->string('provider')->nullable();
            $table->string('subscriber_id')->nullable();
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
        Schema::dropIfExists('topups');
    }
}
