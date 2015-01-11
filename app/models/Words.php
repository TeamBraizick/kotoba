<?php
/**
 * User: Nick
 * Date: 1/6/2015
 * Time: 4:53 AM
 */

class Words extends Sentences{
    protected $table = 'translatedsentence';
	
	public static function getWordID($word, $lang){
		$all = Words::all();
		
		foreach($all as $spec){
			if(strcasecmp($spec->lang, $lang) == 0 &&
			strcasecmp($spec->word, $word) == 0){
				return $spec->id;
			}
		}
		
		return -1;
	}
}