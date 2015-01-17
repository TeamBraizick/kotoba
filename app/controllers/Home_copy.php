<?php

class Home_COPY extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	*/

	/**
	 * @return mixed
     */
	public function main()
	{
		return View::make('main', ['languages' => Languages::getLangs()]);
	}

	/**
	 * @return mixed
     */
	public function add(){
		//Seeding
		/*
		$sentence = new OriginalSentence();
		$sentence->language = 'en';
		$sentence->sentence = 'This a sample sentence.';
		$sentence->words = serialize(array('this', 'sample', 'sentence'));
		$sentence->save();
		*/
		return View::make('add');
	}

	public function insert()
	{
		if(empty($_POST)){
			return View::make('empty_post');
			//header('location: ' . 'nothing');
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
			//Quick and dirty. Change to scale. CBT
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
//				return View::make('data_dump', ['data' => $word]);
				$originalsArr = unserialize($word->originals);
				$originalsArr[] = $original_id;
//				return View::make('data_dump', ['data' => $originalArr]);
				$word->originals = serialize($originalsArr);
				$word->save();
//				return View::make('data_dump', ['data' => ['id' => $original_id, 'wordOrg' => $word->originals, 'orgs' => $originalsArr, $word]]);
				
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
			//header('location: ' . 'insertion_complete');
		}
	}

	/**
	 * @return mixed
     */
	public function search(){
		return View::make('search');
	}

	public function find(){
		if(empty($_POST)){
			return View::make('empty_post');
		} else {
			$orignal = OriginalSentence::all();

			$result = [];
			foreach($orignal as $sentence){
				if($sentence->language != $_POST['lang']){
					continue;
				}
				foreach(unserialize($sentence->words) as $word){
					if(strcasecmp($word,$_POST['word']) == 0){
						//echo($sentence->sentence);
						$result[] = $sentence;
						//echo "||||||||||||||||||||||";
						//print_r($result);
						continue;
					}
				}
			}

			//Needs to be moved to a view
			return View::make('found',['results' => $result]);
			foreach($result as $indv){
				echo($indv->sentence . '  @  ' . $indv->id . '<br/>');
			}
		}
	}

}
