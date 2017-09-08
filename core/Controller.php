<?php
namespace core;
use core\Model;
use core\View;

session_start();
class Controller
{
	  public $view;
	  function __construct($controllerName)
	  {
	    $this -> view = new View();
	  }

}

 ?>

