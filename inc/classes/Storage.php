<?php


class Storage {

    private $db;
    //private $tree=array();

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
        $insertElement = $this->db->prepare('INSERT INTO st_elements (`name` ,`description` ,`level`) VALUES (:nameElement, :descriptionElement, :level)');
        $insertElement->execute(array(":nameElement"=>$element[":nameElement"], ":descriptionElement"=>$element[":descriptionElement"], ":level"=>$element[":level"]));
        $idElement=$this->db->lastInsertId();
        $insertParent = $this->db->prepare('INSERT INTO st_parent (`idName` ,`idParent`) VALUES (:idName, :idParent)');
        return $insertParent->execute(array(":idName"=>$idElement,":idParent"=>$parent[0]["id"]));
    }

    public function getElement($element){
        $queryElement = $this->db->prepare('SELECT * FROM st_elements WHERE (`name`)=(:nameElement)');
        $queryElement->execute(array(":nameElement"=>$element));
        return $queryElement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTree(){
        $queryTree = $this->db->query('SELECT st_elements.`id`, st_elements.`name`, st_parent.`idParent` FROM st_elements INNER JOIN st_parent WHERE st_elements.`id`=st_parent.`idName`');
        return $queryTree->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRootElements(){
        $queryRootElements=$this->db->prepare('SELECT st_elements.`id`, st_elements.`name` FROM st_elements INNER JOIN st_parent
        WHERE st_elements.`id`=st_parent.`idName` AND st_parent.`idParent` IS NULL');
        $queryRootElements->execute();
        return $queryRootElements->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getChild($parent){
        $queryChild=$this->db->prepare('SELECT st_elements.`id`, st_elements.`name`, st_parent.`idParent` FROM st_elements INNER JOIN st_parent
        WHERE st_elements.`id`=st_parent.`idName` AND st_parent.`idParent`=:parent');
        $queryChild->bindParam(':parent',$parent,PDO::PARAM_INT);
        $queryChild->execute();
        return $queryChild->fetchAll(PDO::FETCH_ASSOC);
    }

} 