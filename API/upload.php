<?php
$path = $_POST["path"];
echo $path;
$targetDir = "..\\Maps\\".str_replace("/","\\",$path);
$root = "..\\Maps\\".$path;
$path = "..\\Maps\\".$path.basename($path);
echo "<br/>".$path;
$uploadOk = 1;
$targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);
echo "<br/".$targetFile;
$imageFileType = pathinfo($targetFile,PATHINFO_EXTENSION);
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
 // Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		if ($fileContents = file_get_contents($path.".json"))//modif du json
		{
		$mapInfo = json_decode($fileContents);
		//unlink($root.$mapInfo->file);
		$mapInfo->file = basename($targetFile);
		$mapFile = fopen($path.".json", "w");
		fwrite($mapFile,json_encode($mapInfo));
		fclose($mapFile);
		}
   } else {
        echo "Sorry, there was an error uploading your file.";
    }
}



?>