<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOpdrachtTable extends Migration {

	public function up()
	{
		Schema::create('opdracht', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 255);
			$table->integer('description_id')->unsigned();
			$table->date('start-date');
			$table->date('end-date');
			$table->integer('klant_id')->unsigned();
            $table->timestamps();
            $table->foreign('description_id')->references('id')->on('description')
                ->onDelete('cascade');
            $table->foreign('klant_id')->references('id')->on('users')
                ->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::drop('opdracht');
	}
}
