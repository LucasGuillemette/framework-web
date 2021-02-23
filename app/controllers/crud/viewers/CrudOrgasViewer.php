<?php
namespace controllers\crud\viewers;

use Ajax\semantic\html\elements\HtmlLabel;
use Ubiquity\controllers\crud\viewers\ModelViewer;
use Ubiquity\core\postinstall\Display;

/**
  * Class CrudOrgasViewer
  */
class CrudOrgasViewer extends ModelViewer{
	//use override/implement Methods
    public function getModelDataTable($instances, $model, $totalCount, $page = 1)
    {
        $dt = parent::getModelDataTable($instances, $model, $totalCount, $page); 
        $dt->fieldAsLabel('domain','users');
        $dt->setValueFunction('groups',function($v,$instance){
          return HtmlLabel::tag('',count($v)); 
         });
        return $dt;
    }

    protected function getDataTableRowButtons()
    {
        return ['display','edit','delete']; // TODO: Change the autogenerated stub
    }


}
