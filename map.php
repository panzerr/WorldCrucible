<?php

// more like structs than classes

class submap
{
	public $name;
	public $position;
}

class map
{
	public $name;
	public $file;
	public $rootmap;
	public $submaps = array();
}


?>