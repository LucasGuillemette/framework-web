<?php
namespace controllers;
use Ajax\php\ubiquity\JsUtils;
use Ubiquity\attributes\items\router\Get;
use Ubiquity\attributes\items\router\Route;
use Ubiquity\attributes\items\router\Post;
use Ubiquity\controllers\Router;
use Ubiquity\utils\http\URequest;
use Ubiquity\utils\http\USession;

/**
  * Controller TodosController
 * @property JsUtils $jquery
  */
class TodosController extends ControllerBase{

    const CACHE_KEY = 'datas/lists/';
    const EMPTY_LIST_ID='not saved';
    const LIST_SESSION_KEY='list';
    const ACTIVE_LIST_SESSION_KEY='active-list';


    #[Route('_default',name: 'home')]
	public function index(){
        if(USession::exists(self::LIST_SESSION_KEY)) {
            $list=USession::get(self::LIST_SESSION_KEY,[]);
            return $this->displayList($list);
        }
        $this->showMessage('Bienvenue !','TodoList','info','info circle', [['url' =>Router::path('todos.new'),'caption'=>'Créer une nouv liste','style'=>'basic inverted']]);
	}

	#[Post(path: "todos/add",name: 'todos.add')]
	public function addElement(){
		$list=USession::get(self::LIST_SESSION_KEY);
		if(URequest::has('element')){
		    $elements=explode("\n",URequest::post('element'));
		    foreach ($elements as $elem){
		     $list[] = $elem;
            }
        }else{
            $list[]=URequest::post('element');
        }
		USession::set(self::LIST_SESSION_KEY,$list);
		$this->displayList($list);
	}


	#[Get(path: "todos/delete/{index}", name: 'todos.delete')]
	public function deleteElement($index){
		
	}


	#[Post(path: "todos/edit/{index}",name: 'todos.edit')]
	public function editElement($index){
		
	}


	#[Get(path: "todos/loadList/{uniqid}",name: 'todos.loadList')]
	public function loadList($uniqid){
		
	}


	
	private function menu(){
		
		$this->loadView('TodosController/menu.html');

	}

	public function initialize()
{
    parent::initialize();
    $this->menu();
}


	#[Get(path: "todos/new/{force}",name: 'todos.new')]
	public function newList($force = false){
        if($force != false | !USession::exists(self::LIST_SESSION_KEY)){
            USession::set(self::LIST_SESSION_KEY,[]);
            $this->displayList(USession::get(self::LIST_SESSION_KEY));
        }else if (USession::exists(self::LIST_SESSION_KEY)) {
            $this->showMessage("nouvelle Liste", "Une liste existe deja. Voulez vous la vider?", "", "",
            [['url' =>Router::path('todos.new'),'caption'=>'créer une new liste','style'=>'basic inverted'],
                ['url' =>Router::path('todos.menu'),'caption'=>'Annuler','style'=>'basic inverted']]);
            $this-> displayList(USession::get(self::LIST_SESSION_KEY));
        }

	}


	#[Get(path: "todos/saveList", name: 'todos.save')]
	public function saveList(){
		
	}


	#[Post(path: "todos/loadList/",name: 'todos.loadListPost')]
	public function loadListFromForm(){

	}


	
	private function displayList($list){
        if(\count($list)>0){
            $this->jquery->show('._saveList','','',false);
        }
        $this->jquery->change('#multiple','$("._form").toggle();');
        $this->jquery->renderView('TodosController/displayList.html', ['list'=>$list]);

	}


	
	public function showMessage(string $header,string $message,string $type='info',string $icon='info circle',array $buttons=[]){
		
		$this->loadView('TodosController/showMessage.html',compact('header','type','icon','message','buttons'));
        
	}

}
