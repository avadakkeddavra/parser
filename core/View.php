<?php
namespace core;
class View{

  function generate($content, $template, $data = null)
	{
		include 'views/' . $template;
	}
}

 ?>
