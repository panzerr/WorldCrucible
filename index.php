<?php
$arg = $_GET["path"];
$path = "Maps".str_replace('|','/',$arg)."/";
$arg = strrchr($arg,'|');
$arg = substr($arg,1);
if ($fileContents = file_get_contents($path.$arg.".json"))
{
	$mapInfo = json_decode($fileContents);
	echo '<img src="'.$path.$mapInfo->file.'">';
	$rootpath = substr(strstr($path,'/'),1);
	foreach ($mapInfo->submaps as &$submap)
	{
			echo "<div style=\"position: absolute; top:".$submap->position[0]."px;left:".$submap->position[1]."px; width:200px; height:25px\">";
			$subPath = str_replace('/','|',$rootpath.$submap->name);
			echo "<a href=\"index.php?path=|".$subPath."\">";
			echo $submap->name;
			echo "</a></div>";
	}
}
else
	echo "wrong path";

?>