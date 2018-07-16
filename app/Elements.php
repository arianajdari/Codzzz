<?php


class Elements
{
	private $elements = '';


	public function get($array)
	{
		$this->printelements($array);
		return $this->elements;
	}

	private function printelements($array)
	{
		foreach ($array as $key => $value) {
			if(is_array($value)){
				$this->elements .= "<img src='resources/closed.png' style='width:20px;height:20px;position:relative;top:25px;' /><ul class='closed'>&nbsp; " . $key ;
				$this->printelements($array[$key]);
				$this->elements .= "<div class='hidden' style='display:none;'>".$key."</div></ul>";
			}
			else
			{
				$this->elements .= "<li  class='files'>" . $value . '</li>';
			}
		}

	}
}