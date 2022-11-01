<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('company');
            $table->string('address');
            $table->string('city');
            $table->unsignedBigInteger('province_id')->nullable();
            $table->string('postal_code');
            $table->unsignedBigInteger('country_id');
            $table->string('vat')->nullable();
            $table->string('fiscal_code')->nullable();
            $table->string('unique_code')->nullable();
            $table->string('pec')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->on('users')
                ->references('id')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('country_id')->on('countries')
                ->references('id')->onDelete('restrict')->onUpdate('cascade');

            $table->foreign('province_id')->on('provinces')
                ->references('id')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billing');
    }
}
