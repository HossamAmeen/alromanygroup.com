<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Offers extends Migration
{
    public function up()
    {
        \Illuminate\Support\Facades\Schema::create('elromani_offers_tb', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title', 255);
            $table->string('content', 512);
            $table->string('img',60);

            $table->integer('price');
            $table->integer('discount');
            $table->integer('page_views')->default(0);

            $table->boolean('active')->default(1);

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
        \Illuminate\Support\Facades\Schema::drop('elromani_offers_tb');
    }
}
