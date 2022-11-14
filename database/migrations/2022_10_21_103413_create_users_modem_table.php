<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersModemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_modem', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('modem_id');
            $table->string('username');
            $table->string('password');
            $table->string('comment');
            $table->dateTime('last_ip_change');
            $table->dateTime('expire_date');
            $table->timestamps();

            $table->foreign('user_id')->on('users')->references('id')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('modem_id')->on('modems')->references('id')
                ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_modem');
    }
}
