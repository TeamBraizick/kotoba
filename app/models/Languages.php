<?php

/**
  Contains an array ($langs) that are in kotoba.
  Keys are in ISO 639-2 codes.
  If there is a 'B' and 'T' code, then the 'B' code is used.
  Values are that Language's name in that language.
 */
final class Languages {

	public static final function getLangs() {
		return array(
			"eng" => "English", //English
			"jpn" => "Nippon", //Japanese; 日本
			"fre" => "Francais", //French; Français
			"spa" => "Espanol", //Spanish; Español
			"por" => "Portugues", //Portuguese
			"kor" => "Hangugeo", //Korean; 한국어
			"ita" => "Italiano", //Italian
			"ger" => "Deutsch", //German
			"gre" => "Ellinika", //Greek; ελληνικά
			"chi" => "Hanyu" //Chinese; 汉语
		);
	}

}
