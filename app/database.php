<?php

class Database {
    /**
    * retourne une connection a la base de donnee
    * @return PDO
    */
    public static function getPdo(): PDO{
       $pdo = new PDO('mysql:host=localhost;dbname=recrutement;charset=utf8', 'root', '', [
           PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
           PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
       ]);
       return $pdo;    
   }
}
