<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOfferteTable extends Migration {

	public function up()
	{
		Schema::create('offerte', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('team_id');
			$table->integer('opdracht_id');
		});
	}

	public function down()
	{
		Schema::drop('offerte');
	}
}