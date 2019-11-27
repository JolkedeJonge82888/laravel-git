<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTeamUserTable extends Migration {

	public function up()
	{
		Schema::create('team-user', function(Blueprint $table) {
			$table->integer('users_id')->unsigned();
			$table->integer('team_id')->unsigned();
            $table->foreign('team_id')->references('id')->on('team')
                ->onDelete('cascade');
            $table->foreign('users_id')->references('id')->on('users')
                ->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::drop('team-user');
	}
}
