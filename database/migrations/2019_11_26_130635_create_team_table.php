<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTeamTable extends Migration {

	public function up()
	{
		Schema::create('team', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 255)->unique();
			$table->integer('point');
		});
	}

	public function down()
	{
		Schema::drop('team');
	}
}