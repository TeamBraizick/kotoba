<?php

/**
 * User: Nick
 * Date: 1/6/2015
 * Time: 4:50 AM
 */
class Sentences extends Eloquent {

	public final static function getWords($sentence) {
		return explode(" ", $sentence);
	}

}
