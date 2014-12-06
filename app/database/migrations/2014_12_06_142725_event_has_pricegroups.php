<?php


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EventHasPricegroups extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('Veranstaltung_hat_Preisgruppe', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->integer('fk_Preisgruppe_ID')->unsigned();
            $table->integer('fk_Veranstaltung_ID')->unsigned();

            $table->foreign('fk_Preisgruppe_ID')
                  ->references('ID')->on('Preisgruppe')
                  ->onDelete('CASCADE')->onUpdate('CASCADE');
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
        Schema::dropIfExists('Veranstaltung_hat_Preisgruppe');
	}

}
