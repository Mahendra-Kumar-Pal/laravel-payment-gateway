<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('strips', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->nullable();
            $table->longText('customer_id')->nullable();
            $table->longText('card_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('amount')->nullable();
            $table->string('message')->nullable();
            $table->string('status')->nullable();
            $table->longText('response')->nullable();
            $table->string('payment_datetime')->nullable();
            $table->longText('collective_id')->nullable();
            $table->longText('team_id')->nullable();
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
        Schema::dropIfExists('strips');
    }
};
