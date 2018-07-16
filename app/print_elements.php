<?php

function printelements($array)
{
	foreach ($array as $key => $value) {
		if(is_array($value)){
			echo "<img src='resources/closed.png' style='width:20px;height:20px;position:relative;top:25px;' /><ul class='closed'>&nbsp; " . $key ;
			printelements($array[$key]);
			echo "<div class='hidden' style='display:none;'>".$key."</div></ul>";
		}
		else
		{
			echo "<li  class='files'>" . $value . '</li>';
		}
	}

}






