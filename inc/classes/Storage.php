<?php
/**
 * Created by PhpStorm.
 * User: Y.Dziashkevich
 * Date: 28.07.14
 * Time: 14:37
 */

class Storage {

    private $db;
    private $tree=array();

    public function __construct($host="localhost", $dbName="tree_st", $user="root", $password=""){
        try{
            $this->db = new PDO("mysql: host=$host; dbname=$dbName", $user, $password);
            $this->db->exec("set names utf8");
        }
        catch (PDOException $e){
            echo $e->getMessage();
        }
    }
    public function __destruct(){
        $this->db=null;
    }

    public function putElement($element=array()){
        $parent=array();
        if($element[":parentElement"]=="root"){
            $parent["id"]=null;
        }else{
            $parent=$this->getElement($element[":parentElement"]);
        }
        var_dump($parent);
        var_dump($element);
        $insertElement = $this->db->prepare('INSERT INTO st_elements (`name` ,`description` ,`level`) VALUES (:nameElement, :descriptionElement, :level');
        $insertElement->execute(array(":nameElement"=>$element[":nameElement"], ":descriptionElement"=>$element[":descriptionElement"], ":level"=>$element[":level"]));
        $dataElement=$this->getElement($element[":nameElement"]);
        var_dump($dataElement);
        $insertParent = $this->db->prepare('INSERT INTO st_parent (`idName` ,`idParent`) VALUES (:idName, :idParent');
        $insertParent->execute(array(":idName"=>$dataElement["id"],":idParent"=>$parent["id"]));
    }

    public function getElement($element){
        $queryElement = $this->db->prepare('SELECT * FROM st_elements WHERE `name`=:nameElement');
        $queryElement->execute(array(":nameElement"=>$element[":nameElement"]));
        return $queryElement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTree(){
        $queryTree = $this->db->query('SELECT * FROM st_elements');
        $this->tree=$queryTree->fetchAll(PDO::FETCH_ASSOC);

    }

} 