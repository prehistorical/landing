<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatetimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datetimes', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('block_name');
            $table->integer('group_id');

            $table->string('name');

            $table->boolean('time');

            $table->dateTime('value');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('datetimes');
    }
}
