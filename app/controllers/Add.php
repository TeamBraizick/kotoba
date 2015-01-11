<?php

class Add extends BaseController {

	/**
	 * @return mixed
     */
	public function add(){
		return View::make('add');
	}

	/**
	* @return mixed
	*/
	public function insert()
	{
		if(empty($_POST)){
			return View::make('empty_post');
		} else {
			//Create an entry for the original sentence
			$original = new OriginalSentence();
			$original->lang = $_POST['target_lang'];
			$original->sentence = $_POST['sentence'];
			$original->words = serialize([]);
			$orgWords = Sentences::getWords($_POST['sentence']);
			//Write entry to DB
			$original->save();
			//Get entry's id for further use
			$original_id = $original->id;

			//Create an entry for thet translated sentence
			$translated = new TranslatedSentence();
			$translated->lang = $_POST['source_lang'];
			$translated->sentence = $_POST['translation'];
			$translated->words = serialize([]);
			$translated->original = serialize([$original_id]);
			$trWords = Sentences::getWords($_POST['translation']);
			//Write entry to DB
			$translated->save();
			//Get entry's id for further use
			$translated_id = $translated->id;

			//Add original sentence to the words
			foreach($orgWords as $spec){
				$wordID = Words::getWordID($spec, $_POST['target_lang']);
				if($wordID == -1){
					$newWord = new Words();
					$newWord->word = $spec;
					$newWord->lang=$_POST['target_lang'];
					$newWord->originals = serialize(array());
					$newWord->translated = serialize(array());
					$newWord->save();
					$wordID = $newWord->id;
				}
				$word = Words::find($wordID);
				$originalsArr = unserialize($word->originals);
				$originalsArr[] = $original_id;
				$word->originals = serialize($originalsArr);
				$word->save();
				
				$wordArr = unserialize($original->words);
				$wordArr[] = $wordID;
				$original->words = serialize($wordArr);
				$original->save();
			}
			
			//Add translated sentence to the words
			foreach($trWords as $spec){
				$wordID = Words::getWordID($spec, $_POST['source_lang']);
				if($wordID == -1){
					$newWord = new Words();
					$newWord->word = $spec;
					$newWord->lang=$_POST['source_lang'];
					$newWord->originals = serialize([]);
					$newWord->translated = serialize([]);
					$newWord->save();
					$wordID = $newWord->id;
				}
				$word = Words::find($wordID);
				$translatedArr = unserialize($word->translated);
				$translatedArr[] = $translated_id;
				$word->translated = serialize($translatedArr);
				$word->save();
	
				$wordArr = unserialize($translated->words);
				$wordArr[] = $wordID;
				$translated->words = serialize($wordArr);
				$translated->save();
			}
		
			//Update the original entry to include the id of the translation
			$original->translated = serialize([$translated_id]);
			$original->save();

			return View::make('insertion_complete');
		}
	}

}
