<?php

// Input string is : "aabbcde" and output should be "2a2b1c1d1e" asper the number of character write h program to calulate generate same string for below 2 examples.
//Example: wwwbbbw, wwwggopp

//  ---------------------------------    METHOD - 1  --------------------------------------------------------
function StringChallenge($str) {
  $tmp='';$out='';$len=strlen($str);
  for ($x = 0; $x < $len; $x++) {
    if($str[$x]==$tmp){
      $cnt++;
    }else{
          if($tmp!=''){
            $out.=$cnt.$tmp;
          }
          $cnt=1;
          $tmp=$str[$x];
    }
  }
   echo $out;
}
//  ---------------------------------    METHOD - 1  --------------------------------------------------------

//  ---------------------------------    METHOD - 2  --------------------------------------------------------
function StringChallenge($str) {
	$output = '';
    $set_str = '';
    $counter = 0;
    for($i=0; $i <= strlen($str); $i++) {
    	if (($i != strlen($str)) && ($set_str == $str[$i]  || empty($set_str))) {        	
			$set_str = $str[$i];
        	$counter++;
            continue;
        }
        $output .= $counter.$set_str;
        $counter = 1;
		if($i != strlen($str))
        $set_str = $str[$i];
		        
    }
	return $output;
}
//  ---------------------------------    METHOD - 2  --------------------------------------------------------
// keep this function call here  
echo StringChallenge(fgets(fopen('php://stdin', 'r')));  
// $txt = "aabbcde"; 

?>