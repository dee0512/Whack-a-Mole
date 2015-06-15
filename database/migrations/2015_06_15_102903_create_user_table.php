<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 20);
			$table->integer('score');
			$table->timestamp('date')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->integer('mole');
			$table->integer('mole1');
			$table->integer('mole2');
			$table->integer('mole3');
			$table->integer('mole4');
			$table->integer('mole5');
			$table->integer('mole6');
			$table->integer('mole7');
			$table->integer('mole8');
			$table->integer('mole9');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user');
	}

}
