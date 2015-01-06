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
			return View::make('nothing_to_insert');
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

}
