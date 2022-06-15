<?php
namespace core;
require_once('app/database.php');

abstract class model{
    protected $db;
    protected $table;
    protected $show;

    public function __construct(){
       $this->db = $this->conn_db();
       $this->show = $this->show_fields();
    }

    private function conn_db(){
        $pdo = \Database::getPdo();
        return $pdo;
    }

    public function show_fields(){
        $req = $this->db->query("Show fields from $this->table");$i = 0; $t="";
        while($a = $req->fetch()){
            $i = $i + 1;
            if($i === sizeof($a)){
                $t .= $a['Field'];
            }else{
                $t .= $a['Field'].',';
            }
        }
        $t = explode(',', $t);
        array_shift($t);
        $t = implode(',',$t);

        return $t;
    }

    public function findAll(?string $order, ?string $limit){
        if(empty($order) && empty($limit)){
            $req = $this->db->query("SELECT * FROM $this->table");
        }elseif(!empty($order) && empty($limit)){
            $req = $this->db->query("SELECT * FROM $this->table ORDER BY $order"); 
        }elseif(empty($order) && !empty($limit)){
            $req = $this->db->query("SELECT * FROM $this->table LIMIT $limit"); 
        }elseif(!empty($order) && !empty($limit)){
            $req = $this->db->query("SELECT * FROM $this->table ORDER BY $order LIMIT $limit"); 
        }
        return $req;
    }

    public function findWhere(string $condition, array $array){
        $req = $this->db->prepare("SELECT * FROM $this->table WHERE $condition");
        $req->execute($array);
        return $req;
    }

    public function add(string $value, array $array){
        $req = $this->db->prepare("INSERT INTO $this->table($this->show) Values ($value)");
        $req->execute($array);
        return  $this->db->lastInsertId();
    }

    public function delete(string $condition, array $array){
        $req = $this->db->prepare("DELETE FROM $this->table WHERE $condition");
        $req->execute($array);
    }
}