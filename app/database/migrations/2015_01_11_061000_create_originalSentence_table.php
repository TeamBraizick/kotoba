<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriginalSentenceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('originalSentence', function(Blueprint $t){
			//Primary Key
			$t->increments('id');
			
			//Sentence Langugae
			$t->enum('lang', array_keys(Languages::getLangs()));
			
			//Sentence
			$t->text('sentence');
			
			//Words
			$t->text('words');
			
			$t->text('translated');
			
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
		Schema::drop('originalSentence');
	}

}
