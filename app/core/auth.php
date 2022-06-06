<?php
namespace core;

trait auth{
    public function connected(){
        if(isset($_SESSION['id'])){
            return True;
        }else{
            return False;
        }
    }
}