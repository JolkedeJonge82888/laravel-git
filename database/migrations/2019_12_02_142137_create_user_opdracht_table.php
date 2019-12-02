<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserOpdrachtTable extends Migration {

	public function up()
	{
		Schema::create('user-opdracht', function(Blueprint $table) {
			$table->integer('users_id')->unsigned();
			$table->integer('opdracht_id')->unsigned();
            $table->foreign('users_id')->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('opdracht_id')->references('id')->on('opdracht')
                ->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::drop('user-opdracht');
	}
}
