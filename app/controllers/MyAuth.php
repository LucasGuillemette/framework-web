<?php
namespace controllers;
<<<<<<< HEAD

use models\User;
use Ubiquity\orm\DAO;
use Ubiquity\utils\flash\FlashMessage;
use Ubiquity\utils\http\USession;
use Ubiquity\utils\http\URequest;
use controllers\auth\files\MyAuthFiles;
use Ubiquity\controllers\auth\AuthFiles;
use Ubiquity\attributes\items\router\Route;
use Ubiquity\utils\http\UResponse;

#[Route(path: "/login",inherited: true,automated: true)]
=======
use models\User;
use Ubiquity\attributes\items\router\Route;
use Ubiquity\controllers\Router;
use Ubiquity\orm\DAO;
use Ubiquity\utils\flash\FlashMessage;
use Ubiquity\utils\http\UResponse;
use Ubiquity\utils\http\USession;
use Ubiquity\utils\http\URequest;
use Ubiquity\controllers\auth\AuthFiles;


>>>>>>> 8dcddf44a2deb6e4b7ba0572629309f3204b1d9a
class MyAuth extends \Ubiquity\controllers\auth\AuthController{

    protected function onConnect($connected) {
        $urlParts=$this->getOriginalURL();
        USession::set($this->_getUserSessionKey(), $connected);
        if(isset($urlParts)){
            $this->_forward(implode("/",$urlParts));
        }else{
<<<<<<< HEAD
            UResponse::header('location','/');
=======
            //TODO
            UResponse::header('location','/'.Router::path('menu'));
>>>>>>> 8dcddf44a2deb6e4b7ba0572629309f3204b1d9a
        }
    }

    protected function _connect() {
        if(URequest::isPost()){
            $email=URequest::post($this->_getLoginInputName());
            $password=URequest::post($this->_getPasswordInputName());
<<<<<<< HEAD
            if($email!=null){
                $user=DAO::getOne(User::class,'email= ?', false,[$email]);
                return $user;
            }
=======
>>>>>>> 8dcddf44a2deb6e4b7ba0572629309f3204b1d9a
            //TODO
            //Loading from the database the user corresponding to the parameters
            //Checking user creditentials
            //Returning the user
<<<<<<< HEAD
=======
            if($email != null){
                $user = DAO::getOne(User::class, 'email= ?',false, [$email]);
                if (isset($user)){
                    USession::set('idOrga', $user->getOrganization());
                    return $user;
                }
            }
            //       return 'jul';

>>>>>>> 8dcddf44a2deb6e4b7ba0572629309f3204b1d9a
        }
        return;
    }

    /**
     * {@inheritDoc}
     * @see \Ubiquity\controllers\auth\AuthController::isValidUser()
     */
    public function _isValidUser($action=null) {
        return USession::exists($this->_getUserSessionKey());
    }

    public function _getBaseRoute() {
        return '/login';
    }

<<<<<<< HEAD
    protected function getFiles(): AuthFiles{
        return new MyAuthFiles();
=======
    public function _displayInfoAsString() {
        return true;
>>>>>>> 8dcddf44a2deb6e4b7ba0572629309f3204b1d9a
    }

    protected function finalizeAuth() {
        if(!URequest::isAjax()){
            $this->loadView('@activeTheme/main/vFooter.html');
        }
    }
<<<<<<< HEAD
=======

>>>>>>> 8dcddf44a2deb6e4b7ba0572629309f3204b1d9a
    protected function initializeAuth() {
        if(!URequest::isAjax()){
            $this->loadView('@activeTheme/main/vHeader.html');
        }
    }

    public function _getBodySelector() {
        return '#page-container';
    }

<<<<<<< HEAD
    protected function noAccessMessage(FlashMessage $fMessage) {
        $fMessage->setTitle('Acces interdit');
        $fMessage->setContent("vous n'êtes pas autorisé à acceder à cette ressource");
    }

    public function _displayinfoAsString() {
        return true; //affiche dans la page et non apres la page (false)
=======
    protected function noAccessMessage(FlashMessage $fMessage)
    {
        $fMessage->setTitle('Accès interdit');
        $fMessage->setContent('Vous ne pouvez accèder à cette ressource');
>>>>>>> 8dcddf44a2deb6e4b7ba0572629309f3204b1d9a
    }

}