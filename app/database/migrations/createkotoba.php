<?php

use Illuminate\Database\Migrations\Migration;

class CreateKotobaTables extends Migration {
		$original = true;
		$translated = false;
		
		public function up(){
			createSentences($original);
			createSentences($translated);
			createWords();
		}
		
		public function down(){
			dropSentence($original);
			dropSentence($translated);
			dropWords();
		}
		
		public function createSentences($type){
			if($type != $original && $type != $translated){
				return;
			}
			
			$createName = ($type == $original) ?
				'originalSentences' : 'translatedSentences';
			
			Schema::create($createName, function($t){
				//Primary Key
				$t->increments('id');
				
				//Sentence Langugae
				$t->enum('lang', array_keys(Langugaes::getLangs()));
				
				//Sentence
				$t->text('sentence');
				
				//Words
				$t->text('words');
				
				if ($type == original){
					//Original Sentences
					$t->text('original');
				} else {
					//Translated Sentences
					$t->text('translated');
				}
				
				$t->timestamps();
			});
		}
		
		public function createWords(){
			Schema::create('words', function($t){
				//Primary Key
				$t->increments('id');

				//Word Langugae
				$t->enum('lang', array_keys(Langugaes::getLangs()));

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
		
		public function dropSentence($type){
			return ($type == $original) ?
				Schema::drop('originalSentences'):
				Schema::drop('translatedSentences');
		}

		public function dropWords(){
				Schema::drop('words');
		}

}