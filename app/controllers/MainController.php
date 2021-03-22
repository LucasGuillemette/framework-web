<?php
namespace controllers;
<<<<<<< HEAD
use Ubiquity\attributes\items\router\Route;
use Ubiquity\controllers\auth\AuthController;
use Ubiquity\controllers\auth\WithAuthTrait;

/**
 * Controller MainController
 **/
class MainController extends ControllerBase{

    use WithAuthTrait;

    #[Route ('_default', name:'home')]
    public function index(){
        $this->loadDefaultView();
    }

    protected function getAuthController(): AuthController
    {
        return new MyAuth($this);
    }
}
=======
 /**
  * Controller MainController
  */
class MainController extends ControllerBase{

	public function index(){
        $this->loadDefaultView();
	}
}
>>>>>>> 8dcddf44a2deb6e4b7ba0572629309f3204b1d9a
