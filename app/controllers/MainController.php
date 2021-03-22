<?php
namespace controllers;
use models\Order;
use models\Product;
use models\Section;
use Ubiquity\attributes\items\router\Route;
use Ubiquity\controllers\auth\AuthController;
use Ubiquity\controllers\auth\WithAuthTrait;
use Ubiquity\orm\DAO;
use Ubiquity\utils\http\USession;

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

    #[Route ('store', name:'store')]
    public function store(){
        $store = DAO::getAll(Product::class, false, false);
        $this->loadDefaultView(['store'=>$store]);
    }
}