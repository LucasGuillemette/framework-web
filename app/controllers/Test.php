<?php
namespace controllers;
 /**
  * Controller Test
  */
class Test extends ControllerBase{

	public function index(){
		$this->loadView("Test/index.html");
	}
}
