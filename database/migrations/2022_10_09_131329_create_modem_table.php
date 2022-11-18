<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('server_id');
            $table->string('port');
            $table->string('apn');
            $table->string('ip_type');
            $table->string('password');
            $table->string('username');
            $table->string('imei');
            $table->integer('modem_id');
            $table->string('operator_code');
            $table->string('operator_name');
            $table->string('bands');
            $table->string('device_identifier');
            $table->string('revision');
            $table->string('model');
            $table->string('signal_quality');
            $table->string('state');
            $table->dateTime('last_seen');
            $table->boolean('available')->default(0);
            $table->timestamps();

            $table->foreign('server_id')->on('servers')
                ->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->unique('device_identifier');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modem');
    }
}
