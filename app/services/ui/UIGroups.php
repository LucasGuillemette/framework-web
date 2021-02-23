<?php
namespace services\ui;

use models\Group;

use Ubiquity\controllers\Controller;
use Ubiquity\controllers\Router;


 /**
  * Class UIGroups
  */
class UIGroups extends \Ajax\php\ubiquity\UIService {
    public function __construct(Controller $controller) {
      parent::__construct($controller);
      $this->jquery->getHref('a[data-target]',
      parameters:['historize'=>false,'hasLoader'=>'internal','listenerOn'=>'body']);
    }
    
    public function listGroup(array $groups){
      $dt = $this->semantic->dataTable('dt-groups',Group::class,$groups);
      $dt->setFields(['name','email']);
      $dt->fieldAsLabel('email','mail');
      $dt->addDeleteButton();
    }

    public function orgaForm(\models\Organization $orga){
      $frm=$this->semantic->dataFrom('frmOrga',$orga);
      $frm->setFields(['id','name','domain']);
      $frm->fieldAsHidden('id');
      $frm->fieldAsLabelInput('name',['rules'=>'empty']);
      $frm->fieldAsLabelInput('domain',['rules'=>['empty','email']]);
      $frm->setValidationParams(["on"=>"blur","inline"=>true]);
      $frm->addSubmit('submit','valider','positive', Router::path('addOrga'),"#response");

  }
}
