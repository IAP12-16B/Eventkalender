<?php


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class Shows1 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('Vorstellung', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('ID')->unsigned();
            $table->date('datum');
            $table->time('zeit');

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
        Schema::dropIfExists('Vorstellung');
	}

}
