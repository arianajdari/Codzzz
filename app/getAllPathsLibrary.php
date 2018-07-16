<?php


class getAllPaths
{	

	private $paths = [];


	public function get($dir)
	{
		$this->getAll($dir);
		return $this->paths;
	}

	public function getGet($dir)
	{
		$this->getAllFoldersAndFiles($dir);
		return $this->paths;
	}

	private function getAll($dir)
	{
		$result = array();


		$cdir = scandir($dir);

		foreach ($cdir as $key => $value) {
			if ($value === '.' or $value === '..') continue;
			if(is_dir($dir . DIRECTORY_SEPARATOR . $value)){
				$this->paths[] = $dir . DIRECTORY_SEPARATOR . $value;
				$result[$dir . DIRECTORY_SEPARATOR . $value] = $this->getAll($dir . DIRECTORY_SEPARATOR . $value);
			}
		}

		return $result;
	}

	private function getAllFoldersAndFiles($dir)
	{
		$result = array();


		$cdir = scandir($dir);

		foreach ($cdir as $key => $value) {
			if ($value === '.' or $value === '..') continue;
			$this->paths[] = $dir . DIRECTORY_SEPARATOR . $value;
			if(is_dir($dir . DIRECTORY_SEPARATOR . $value)){
				$result[$dir . DIRECTORY_SEPARATOR . $value] = $this->getAllFoldersAndFiles($dir . DIRECTORY_SEPARATOR . $value);
			} 
				
		}

		return $result;
	}
}