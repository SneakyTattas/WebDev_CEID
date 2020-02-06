<?php
printArray($_POST);
var_dump($_POST);
$rest_json = file_get_contents("php://input");
$_POST = json_decode($rest_json, true);

/*
 * $pad='' gives $pad a default value, meaning we don't have 
 * to pass printArray a value for it if we don't want to if we're
 * happy with the given default value (no padding)
 */
function printArray($array, $pad=''){
     foreach ($array as $key => $value){
        echo $pad . "$key => $value";
        if(is_array($value)){
            printArray($value, $pad.' ');
        }  
    } 
}
?>