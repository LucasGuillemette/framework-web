<?php
namespace controllers;
 use models\Organization;
 use Ubiquity\attributes\items\router\Route;
 use Ubiquity\orm\DAO;
use Ubiquity\orm\repositories\ViewRepository;

/**
  * Controller OrgaController
  */
class OrgaController extends ControllerBase{
    #[Route('org')]
	public function index(){
		//$orgas=DAO::getAll(Organization::class, "like '%uni%'",true);
		//$this->loadView("OrgaController/index.html",['orga'=>$orgas]);
	} 

	public function initialize()
	{
		parent::initialize();
		$this->repo=new ViewRepository($this, Organization::class);
	}

	#[Route(path: "orga",name: "orga.index2")]
	public function index2(){
        //$orgas=DAO::getAll(Organization::class, "",false);
        //$this->loadView("OrgaController/index.html",['orgas'=>$orgas]);
		$this->repo->all("",false);
		$this->loadView("OrgaController/index.html");
	}


	#[Route(path: "orga/{idOrga}",name: "orga.getOne")]
	public function getOne($idOrga){
		//$orga=DAO::getById(Organization::class, $idOrga,['groupe.users']);
		$this->repo->byId($idOrga,['users.groupes','groupes.users']);
		//$this->loadDefaultView(['orga'=>$orga]);
		$this->loadDefaultView();
	}

}
