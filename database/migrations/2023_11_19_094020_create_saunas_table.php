<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('saunas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->references('id')->on('employees');
            $table->integer('sauna');
            $table->integer('massage');
            $table->integer('gym');
            $table->integer('bar_and_kitchen');
            $table->integer('cash_in')->default(0);
            $table->integer('cash_out')->default(0);
            $table->integer('total');
            $table->integer('payout');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saunas');
    }
};
