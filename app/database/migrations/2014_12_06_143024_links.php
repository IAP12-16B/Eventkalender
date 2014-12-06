<?php


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Links extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('Link', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('ID')->unsigned();
            $table->string('name', 50)->nullable();
            $table->string('link', 255);

            $table->integer('fk_Veranstaltung_ID')->unsigned();

            $table->foreign('fk_Veranstaltung_ID')
                  ->references('ID')->on('Veranstaltung')
                  ->onDelete('CASCADE')->onUpdate('CASCADE');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists('Link');
	}

}
