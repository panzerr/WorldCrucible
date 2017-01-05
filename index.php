<?php
$arg = $_GET["path"];
$path = "Maps/".str_replace('|','/',$arg)."/";
$arg = strchr($arg,'|');
$arg = substr($arg,1);

if ($fileContents = file_get_contents($path.$arg.".json"))
{
	$mapInfo = json_decode($fileContents);
	echo '<img src="'.$path.$mapInfo->file.'">';
	foreach ($mapInfo->submaps as &$submap)
	{
			echo "<div style=\"position: absolute; top:".$submap->position[0]."px;left:".$submap->position[1]."px; width:200px; height:25px\">";
			echo $submap->name;
			echo "</div>";
	}
}
else
	echo "wrong path";

?>