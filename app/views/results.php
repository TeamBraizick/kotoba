<?php

if(empty($results)){
	echo('Sorry but none were found.');
} else {
	foreach($results as $spec){
		echo($spec['original']->sentence.'   --->   '.$spec['translation']->sentence);
		echo('<br/><br/>');
	}
}