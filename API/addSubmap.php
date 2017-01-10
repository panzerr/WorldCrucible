<?php
include "../map.php";


$name = $_GET["name"];
$x = $_GET["x"];
$y = $_GET["y"];
$root = $_GET["root"];
$rootMap = "../Maps".str_replace('|','/',$root);
echo $rootMap;
echo "<br/>";
$rootMapFile = strrchr($rootMap,'/');
$rootMapFile = substr($rootMapFile,1);
$rootMapFile .= '.json';

if ($fileContents = file_get_contents($rootMap.'/'.$rootMapFile))
{
	echo $fileContents;
	$mapInfo = json_decode($fileContents);
	$toInsert = new submap;
	$toInsert->name = $name;
	$toInsert->position = [$x,$y];
	array_push($mapInfo->submaps,$toInsert);
	echo "<br/>";
	echo json_encode($mapInfo);
	$submapInfo = new map;
	$submapInfo->name = $name;
	$submapInfo->file = null;
	$submapInfo->rootmap = strstr(str_replace('/','|',$rootMap),"|");
	echo json_encode($submapInfo);
	mkdir($rootMap.'/'.$name);
	$subMapFile = fopen($rootMap.'/'.$name.'/'.$name.".json", "w");
	fwrite($subMapFile,json_encode($submapInfo));
	fclose($subMapFile);
	$rootMapFile = fopen($rootMap.'/'.$rootMapFile,"w");
    fwrite($rootMapFile,json_encode($mapInfo));
	fclose($rootMapFile);
}
?>