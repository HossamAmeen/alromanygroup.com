<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ApplicationUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('application_user', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('tel');
            $table->string('email');
            $table->string('job');
            $table->string('macAddress');
            $table->integer('user_no');

            $table->boolean('has_gotten_discount') ->default(0);
            $table->dateTime('discount_datetime') ->nullable();

            $table->boolean('active')->default(1);

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

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
        Schema::drop('application_user');
    }
}
