<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTeamOpdrachtTable extends Migration {

	public function up()
	{
		Schema::create('team-opdracht', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('team_id')->unsigned()->index();
			$table->integer('opdracht_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('team-opdracht');
	}
}