<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('team-opdracht', function(Blueprint $table) {
			$table->foreign('team_id')->references('id')->on('team')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('team-opdracht', function(Blueprint $table) {
			$table->foreign('opdracht_id')->references('id')->on('opdracht')
						->onDelete('no action')
						->onUpdate('no action');
		});
	}

	public function down()
	{
		Schema::table('team-opdracht', function(Blueprint $table) {
			$table->dropForeign('team-opdracht_team_id_foreign');
		});
		Schema::table('team-opdracht', function(Blueprint $table) {
			$table->dropForeign('team-opdracht_opdracht_id_foreign');
		});
	}
}