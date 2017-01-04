<?php
$arg = $_GET["path"];
$path = $arg."/";


if ($fileContents = file_get_contents($path.$arg.".json"))
{
	$mapInfo = json_decode($fileContents);
	echo '<img src="'.$path.$mapInfo->file.'">';
}
else
	echo "wrong path";

?>