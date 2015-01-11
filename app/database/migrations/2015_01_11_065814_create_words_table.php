<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('words', function(Blueprint $t){
			//Primary Key
			$t->increments('id');

			$t->text('word');
			
			//Word Langugae
			$t->enum('lang', array_keys(Languages::getLangs()));

			//When a word is added, it may only have an original sentence,
			//or only a translated sentence so both should be nullable
			
			//Orignal Sentences
			$t->text('originals')->nullable();
			
			//Translated Sentence
			$t->text('translated')->nullable();
			
			// created_at, updated_at DATETIME
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
		Schema::drop('words');
	}

}
