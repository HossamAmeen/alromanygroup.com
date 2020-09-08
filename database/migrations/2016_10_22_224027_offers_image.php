<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OffersImage extends Migration
{
    public function up()
    {
        Schema::create('elromani_offers_image_tb', function(Blueprint $table)
        {
            $table->increments('id');
            $table->boolean('active')->default(1);
            $table->string('img',60);

            $table->integer('offers_id')->unsigned();
            $table->foreign('offers_id')
                ->references('id')->on('elromani_offers_tb')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->integer('user_id')->unsigned();
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
        Schema::drop('elromani_offers_image_tb');
    }
}
