<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class Users extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('Benutzer', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('ID')->unsigned();
            $table->string('benutzername', 50)->unique();
            $table->string('passwort', 120);

            $table->rememberToken();

            //$table->primary('id');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists('Benutzer');
	}

}
