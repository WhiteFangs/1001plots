<?php

function generate_markov_table($text, $table) {
    
    $wordsTable = explode(' ',trim($text)); 
    $tableLength = sizeof($wordsTable);
	foreach($wordsTable as $key => $word){
		if (!isset($table[$word])){
			$table[$word] = array();
		};
        if($key < $tableLength - 1){
            $nextWord = $wordsTable[$key + 1];
            if (isset($table[$word][$nextWord])) {
                $table[$word][$nextWord] += 1;
            } else {
                $table[$word][$nextWord] = 1;     
            }
        }
	}
	
    return $table;
}

function sentenceBegin($str){
	return $str == ucfirst($str) && strpos($str, '.') === FALSE 
    && strpos($str, ')') === FALSE && strpos($str, '(') === FALSE && strpos($str, "'") === FALSE;
}

function generate_markov_text($length, $table, $beginnings) {
    // get first word
    shuffle($beginnings);
    $word = $beginnings[0];
		
    $o = $word;
    $count = 1;
    while($count < $length || substr($o, -1) != "."){
        $newword = return_weighted_word($table[$word]);            
        
        if ($newword) {
            $word = $newword;
            $o .= " " . $newword;
        } else {       
            $o .= ".";
            shuffle($beginnings);
            $word = $beginnings[0];
        }
        $count++;
    }

    return $o;
}
    

function return_weighted_word($array) {
    if (!$array) return false;
    
    $total = array_sum($array);
    $rand  = mt_rand(1, $total);
    foreach ($array as $item => $weight) {
        if ($rand <= $weight) return $item;
        $rand -= $weight;
    }
}
?>