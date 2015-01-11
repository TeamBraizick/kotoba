<?php

class Search extends BaseController {

	public function results(){
		if(empty($_POST)){
			return View::make('main', ['error' => 'empty_post']);
		}
		
		//return View::make('results',['post_data' => $_POST]);
		
		
		
		return View::make('results', [
			'target' => $_POST['target'],
			'known' => $_POST['known'],
			'query' =>$_POST['query']
			]);
		
	}
	
	
	/**
	 * @return mixed
     */
	public function CBTresults()
	{
		//return View::make('main');
	
		if(empty($_POST)){
			return View::make('main',['error' => 'empty_post']);
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
