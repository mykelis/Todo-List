<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropTables extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::dropIfExists('todo_items');
		Schema::dropIfExists('todo_lists');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	}
		Schema::drop('tasks');
	}