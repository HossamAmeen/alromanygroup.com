<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquivalentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equivalents', function (Blueprint $table) {
            $table->increments('id');
            $table->double('value');
            // $table->boolean('is_taken')->default(0);
            $table->boolean('active')->default(1);

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->integer('employee_id')->unsigned();
            $table->foreign('employee_id')
                ->references('id')->on('employees')
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
        Schema::drop('equivalents');
    }
}
