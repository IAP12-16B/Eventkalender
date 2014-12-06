<?php


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pricegroups extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('Preisgruppe', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('ID')->unsigned();
            $table->string('name', 20);
            $table->string('preis', 20);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists('Preisgruppe');
	}

}
