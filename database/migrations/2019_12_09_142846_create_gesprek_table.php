<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGesprekTable extends Migration {

	public function up()
	{
		Schema::create('gesprek', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('team_id')->unsigned()->index();
			$table->integer('opdracht_id')->unsigned()->index();
			$table->tinyInteger('check');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('gesprek');
	}
}