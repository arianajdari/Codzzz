<?php

class Looper
{
	  private $result = [];
  	private $files = [];
  	private $folders = [];

  	public function getResult($dir)
  	{
    	$this->result = $this->ScanDir($dir);
     	return $this->result;
  	}

  	private function ScanDir($dir)
  	{

    	$result = [];
     	$this->files = [];
     	$this->folders = [];
     	$cdir = scandir($dir);

     	foreach ($cdir as $key => $value) {
        	if ($value === '.' or $value === '..') continue;
        	if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
           		$this->folders[] = $value;
        	} else {
           		$this->files[] = $value;
        	}
     	}

     	$this->sortArray($this->folders); 
     	$this->sortArray($this->files); 
     	$this->refill($result);

     	foreach ($result as $key => $value) {
        	if (is_dir($dir . '/' . $key)) {
           		$result[$key] = $this->ScanDir($dir . '/' . $key);
        	}
     	}

     	return $result;
  	}

  	private function sortArray(&$array)
  	{
     	for($i = 0; $i < count($array) - 1; $i++){
        	$j = $i + 1;
        	for($j; $j < count($array); $j++){
           		if($array[$i][0] > $array[$j][0]){
              		$temp = $array[$i];
              		$array[$i] = $array[$j];
              		$array[$j] = $temp;
           		}
        	}
     	}
  	}

  	private function refill(&$array)
  	{
     	for($i = 0; $i < count($this->folders); $i++){
        	$array[$this->folders[$i]] = [];
     	}
     	for($i = 0; $i < count($this->files); $i++){
        	$array[] = $this->files[$i];
     	}
  	}
}