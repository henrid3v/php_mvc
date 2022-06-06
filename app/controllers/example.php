<?php 
namespace controllers;
use app\core\controller;
use app\core\auth;

class Example extends controller{

    use auth;

    public function index(){
        $t['offre'] = $this->Offre->findAll();
        $this->set($t);
        $this->render('index');
    }
}