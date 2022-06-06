<?php
namespace core;
require_once('app/database.php');

class model{
    protected $db;
    protected $table;

    public function __construct(){
       $this->db = $this->conn_db();
    }

    private function conn_db(){
        $pdo = \Database::getPdo();
        return $pdo;
    }

    public function findAll(){
        $req = $this->db->query("SELECT * FROM $this->table"); 
        return $req->fetchAll();
    }

    public function findOder(string $order){
        $req = $this->db->query("SELECT * FROM $this->table ORDER BY $order"); 
        return $req;
    }

    public function findLimit(string $limit){
        $req = $this->db->query("SELECT * FROM $this->table LIMIT $limit"); 
        return $req;
    }

    public function findOderLimit(string $order, string $limit){
        $req = $this->db->query("SELECT * FROM $this->table ORDER BY $order LIMIT $limit"); 
        return $req;
    }
}