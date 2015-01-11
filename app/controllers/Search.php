<?php

class Search extends BaseController {

	public function search(){
		return View::make('search');
	}
	
	public function find(){
		$allWords = Words::all();
		$results = [];
		
		foreach($allWords as $spec){
			if(strcasecmp($spec->lang, $_POST['target']) == 0)
			{
				$queries = explode(" ", $_POST['query']);
				foreach($queries as $query){
					if(strcasecmp($spec->word, $query) == 0){
						$sentences = unserialize($spec->originals);
						foreach($sentences as $single){
							$org = OriginalSentence::find($single);
							if(strcasecmp($org->lang, $_POST['target']) == 0){
								foreach(unserialize($org->translated) as $trs){
									$possTrs = TranslatedSentence::find($trs);
									if(strcasecmp($possTrs->lang, $_POST['known']) == 0){
										$results[] = ['original' => $org, 'translation' => $possTrs];
									}
								}
							}
						}
					}
				}
			}
		}
		
		return $this->results($results);
	}

	public function results($results){
		return View::make('results',['results' => $results]);
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
