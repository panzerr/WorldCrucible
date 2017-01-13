<?php
$arg = $_GET["path"];
$path = "Maps".str_replace('|','/',$arg)."/";
$arg = basename($path);
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

	// edit button
	echo '<form action="API/upload.php" method="post" enctype="multipart/form-data">';
	echo 'select image to upload';
	echo '<input type="file" name="fileToUpload" id="fileToUpload">';
	echo '<input type="submit" value="Upload Image" name="submit">';
	echo '<input type="hidden" name="path" value="'.$rootpath.'" id="path">';
	
?>