<?php
// fetch data from file input.1.txt
$file = fopen("input.1.txt", "r");
$input= array();
while (!feof($file)) {
   $input[] = fgets($file);
}
fclose($file);

$validated_strings=array(); // array for validated string
$non_validated_strings=array(); // array for non-validated string

// Validate each line/string of input file
if(!empty($input)){
	foreach($input as $val){
		// $val=strtoupper($val);
		$results_inside = get_inner_string($val); // Get string of inner brackets
		$found_pair=array();
		if(!empty($results_inside)){
			foreach($results_inside as $in_str){
				$possible_arrays = create_possible_arrays($in_str); // Get total possible pair from inner string
				if(!empty($possible_arrays)){
					foreach($possible_arrays as $s){
						$res = areCornerEqual($s); // Find if corners are equal for pair
						if ($res == 1){
							$found_pair[]=$s; // array of pair which have equal corners
						}
					}
				}
			}
		}
		$results_outside = get_outer_string($val); // Get string from outside of brackets
		if(!empty($found_pair) && !empty($results_outside)){   // if there is an pair in side of brackets & outside of brackets is not blank
			$reslt = find_posssible_pair_in_outer_string($results_outside,$found_pair);
			if($reslt==1){
				$validated_strings[]=$val;  // array of validated strings
			}else{	
				$non_validated_strings[]=$val; // array of non-validated strings
			}
			// echo $reslt;
		}
	}
}


// echo "<pre>"; 
echo 'No. Of validated Strings:'.count($validated_strings);
// echo '<br>';
// print_r($validated_strings); //Displaying all validated strings
// echo '<br>';
// echo 'Display all non-validated strings';
// echo '<br>';
// print_r($non_validated_strings); //Displaying all non-validated strings
// echo '<br>';


// Regular expression for get string inside the brackets
function get_inner_string($str){
	$regex = '~\[([^]]*)\]~';
	$data = preg_match_all($regex, $str, $matches);
	return $matches[1];
}

// Create total possible pair of 3 letters from inner string
function create_possible_arrays($str){
	$result = [];
	if (strlen($str) < 3) {
		return $result;
	}
	$totalPossibleString = strlen($str) - 2;
	for ($i = 0; $i < $totalPossibleString; $i++) {
		$result[] = substr($str,$i,3);
	}
	return $result;
}

// Check if in 3 latters word corners are same
function areCornerEqual($s){
    $n = strlen($s);
    if ($n < 2)
        return 0;
    if ($s[0] == $s[$n - 1])
        return 1;
    else
        return 0;
}

// Regular expression for get string outside the brackets
function get_outer_string($str){
	$data = preg_split('/\s*\[.*?\]\s*/',$str);
	return $data;
}

// Check if possible pair will find out in outer string
function find_posssible_pair_in_outer_string($results_outside,$psb_pair){
	foreach($psb_pair as $pair){
		$revrt_str=$pair[1].$pair[0].$pair[1];
		foreach($results_outside as $out){
			if(strpos($out, $revrt_str) !== false){
				return 1;
				// return $pair;
			}
		}
	}
	return 0;
}
?>