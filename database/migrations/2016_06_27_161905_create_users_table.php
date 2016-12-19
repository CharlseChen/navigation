<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//
// Auto-generated Migration Created: 2016-06-27 16:19:05
// ------------------------------------------------------------

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	*/
	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id')->unsigned();
			$table->string('name', 255);
			$table->string('email', 255)->unique();
			$table->string('password', 255);
			$table->string('remember_token', 100)->nullable();
			$table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->nullable();
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	*/
	public function down()
	{
		Schema::drop('users');
	}
}