<?php

$handle = @fopen("testFrenchChars.json", "r");
$result = "";
if ($handle) {
    while (($buffer = fgets($handle, 4096)) !== false) {
        $result .= $buffer;
    }
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($handle);
}

$frenchText = json_decode($result, true);

foreach($frenchText as $key => $value) {
    $frenchText[$key] = escapeObject($value);
}


function escapeObject($value) {
    if(is_object($value) || is_array($value)) {
        foreach($value as $key => $objectValue) {
            $value[$key] = escapeObject($objectValue);
        }
    }
    else {
        $value = htmlentities($value, 0, 'UTF-8');
    }
    return $value;
}

var_dump(json_encode($frenchText));
var_dump(json_decode(json_encode($frenchText), true));