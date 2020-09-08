<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Prefs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prefs_tb', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',99);
            $table->string('slogan', 99)->nullable();
            $table->string('address',99)->nullable();
            //$table->string('address2',99)->nullable();
            $table->string('email',45)->nullable();
            $table->string('tel',45)->nullable();
            $table->string('facebook',100)->nullable();
/*            $table->string('youtube',31)->nullable();*/
/*            $table->string('instagram',31)->nullable();*/
/*            $table->string('android',31)->nullable();*/
/*            $table->string('twitter',31)->nullable();*/
            $table->string('manager_talk',2048)->nullable();
            $table->timestamps();

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('prefs_tb');
    }
}//end prefs
