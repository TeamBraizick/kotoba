<?php

if(empty($results)){
    echo('None found');
} else {
    foreach ($results as $indv) {
        echo($indv->sentence . '  @  ' . $indv->id . '<br/>');
    }
}
