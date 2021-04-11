<?php
namespace controllers;
use models\Basket;
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
        $listCat = DAO::getAll(Section::class,'', ['products']);
        $listPromo = DAO::getAll(Product::class, 'promotion< ?', false, [0]);
        $this->loadDefaultView(['store'=>$store,'listSection'=>$listCat, 'listProm'=>$listPromo ]);
    }
    #[Route ('order',name:'order')]
    public function order(){
        $order = DAO::getAll(Order::class, 'idUser = ?', false,[USession::get("idUser")]);
        $this->loadDefaultView(['order'=>$order]);
    }

    #[Route ('basket', name:'basket')]
    public function basket(){
        $basket=DAO::getAll(Basket::class, 'idUser = ?',false,[USession::get("idUser")]);
    }

    #[Route ('section/{id}', name:'section')]
    public function section($id){
        $product = DAO::getAll(Product::class, 'idSection= '.$id, [USession::get("idSection")]);
        $section = DAO::getById(Section::class,$id,['products']);
        $listsections = DAO::getAll(Section::class,'', ['products']);
        $this->loadDefaultView(['section'=>$section, 'listSection'=>$listsections, 'product'=>$product]);
    }

    #[Route ('product/{idSection}/{idProduct}', name:'product')]
    public function product($idSection,$idProduct){
        $product = DAO::getAll(Product::class, 'idSection= '.$idProduct, [USession::get("idSection")]);
        $productid = DAO::getById(Product::class,$idProduct,['sections']);
        $section = DAO::getById(Section::class,$idSection,['products']);
        $listsections = DAO::getAll(Section::class,'', ['products']);
        $this->loadDefaultView(['section'=>$section, 'listSection'=>$listsections, 'product'=>$product, 'productid'=>$productid]);
    }

    #[Route('newbasket', name:'newbasket')]
    public function newbasket(){

        $user = DAO::getById(User::class, USession::get("idUser"), false);
    }
}