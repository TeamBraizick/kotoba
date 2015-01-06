<?php

class Home extends BaseController {

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
	|
	*/

	/**
	 * @return mixed
     */
	public function main()
	{
		return View::make('main');
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
			$original->language = $_POST['lang'];
			$original->sentence = $_POST['sentence'];
			$original->words = serialize(Sentences::getWords($_POST['sentence']));
			//Write entry to DB
			$original->save();
			//Get entry's id to link with translation
			$original_id = $original->id;

			//Create an entry for thet translated sentence
			$translated = new TranslatedSentence();
			//Quick and dirty. Change to scale. CBT
			$translated->language = ($_POST['lang'] == 'en') ? 'jp' : 'en';
			$translated->sentence = $_POST['translation'];
			$translated->words = serialize(Sentences::getWords($_POST['translation']));
			$translated->original = serialize($original_id);
			$translated->save();
			$translated_id = $translated->id;

			//Update the original entry to include the id of the translation
			$original->translated = serialize($translated_id);
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
						array_push($result ,$sentence);
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
