<?php
namespace core;
use app\core\models;

class controller{
    protected $model;
    protected $modelName;
    var $vars = [];
    var $layout = 'default';

    public function __construct(){
        /*if(isset($this->models)){
            foreach($this->models as $model){
                $this->loadModel($model);
            }
        }*/
        $this->model = new $this->modelName();
    }

    public function set($tab){
        $this->vars = array_merge($this->vars,$tab);
    }

    public function render(string $filename){
        extract($this->vars);
        ob_start();
        $dir_name = get_class($this);
        $dir_name = explode('\\', $dir_name); 
        require(ROOT.'views/'.end($dir_name).'/'.$filename.'.php');
        $content = ob_get_clean();
        if($this->layout == false){
            echo $content;
        }else{
            require(ROOT.'views/layout/'.$this->layout.'.php'); 
        }
    }

    public function loadModel($name){
        require_once(ROOT.'models/'.strtolower($name).'.php');
        $this->$name = new $name();
    }
}