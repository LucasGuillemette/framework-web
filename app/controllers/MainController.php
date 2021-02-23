<?php
namespace controllers;

use models\Organization;
use models\User;
use services\dao\OrgaRepository;
use Ubiquity\attributes\items\di\Autowired;
use Ubiquity\attributes\items\router\Get;
use Ubiquity\attributes\items\router\Route;
use Ubiquity\controllers\auth\AuthController;
use Ubiquity\controllers\auth\WithAuthTrait;
use Ubiquity\orm\DAO;
use Ubiquity\utils\http\USession;

/**
  * Controller MainController
  */
class MainController extends ControllerBase{
use WithAuthTrait;

#[Autowired]
private OrgaRepository $repo;
	#[Route('_default', name:'home')]
	public function index(){
		$this->jquery->getHref('a[data-target]', parameters:['historize'=>false,
		'hashLoader'=>'internal','listenerOn'=>'body']);
		$this->jquery->renderView("MainController/index.html");
		//$this->loadView("MainController/index.html");
	}

	protected function getAuthController(): AuthController
	{
		return new MyAuth($this);
	}

	#[Route(path: "test/Ajax",name: "main.testAjax")]
	public function testAjax(){
		$user=DAO::getById(User::class,[1],false);
		//var_dump($user);
		$this->loadDefaultView('MainController/testAjax.html',['user'=>$user]);
	}

	#[Route('user/details/{id}', name:'user.details')]
	public function userDetails($id){
		$user=DAO::getById(User::class,[$id],true);
		echo "Organisation :".$user->getOrganization();
	}

	#[Route('groups/list', name:'groups.list')]
	public function listGroups(){
		$idOrga = USession::get('idOrga');
		$user=DAO::getAll(Group::class,'idOrganization= ?',false,[$idOrga]);
		$this->uiService->listGroups($groups);
		$this->jquery->renderDefaultView();
	}

	 #[Get('newOrga',name:'newOrga')]
	public function orgaForm(){
		$this->uiService->orgaForm(new Organization());
	} 
}
