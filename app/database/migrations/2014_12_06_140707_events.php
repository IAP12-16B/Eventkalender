<?php


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class Events extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('Veranstaltung', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('ID')->unsigned();
            $table->string('name', 100);
            $table->string('besetzung', 255)->nullable();
            $table->text('beschreibung');
            $table->time('dauer');
            $table->string('bild', 100)->nullable();
            $table->string('bildbeschreibung', 255)->nullable();
            $table->integer('fk_Genre_ID')->unsigned();

            $table->foreign('fk_Genre_ID')
                  ->references('ID')->on('Genre')
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
        Schema::dropIfExists('Veranstaltung');
	}

}
