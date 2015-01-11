<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTranslatedSentenceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('translatedSentence', function(Blueprint $t){
			//Primary Key
			$t->increments('id');
			
			//Sentence Langugae
			$t->enum('lang', array_keys(Languages::getLangs()));
			
			//Sentence
			$t->text('sentence');
			
			//Words
			$t->text('words');
			
			$t->text('original');
			
			$t->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('translatedSentence');
	}

}
