<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDescriptionTable extends Migration {

	public function up()
	{
		Schema::create('description', function(Blueprint $table) {
			$table->increments('id');
			$table->text('text');

		});
	}

	public function down()
	{
		Schema::drop('description');
	}
}
