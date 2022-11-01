<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('password');
            $table->ipAddress('ipaddr');
            $table->enum('status', ['ACTIVE', 'PENDING', 'BLOCKED'])->default('PENDING');
            $table->enum('level', ['USER','ADMIN']);
            $table->string('stripe_customer_id')->nullable();
            $table->string('api_token', 64);
            $table->string('password_recovery_token', 64)->nullable();
            $table->timestamps();

            $table->unique('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
