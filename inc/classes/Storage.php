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

        $insertElement = $this->db->prepare('INSERT INTO st_elements (`name` ,`description` ,`level`) VALUES (:name, :description, :level');
        $insertElement->execute(array(':name' => $element["name"], ':description' => $element["description"], ':level' => $element["level"]));

    }

    public function getTree(){
        $queryTree = $this->db->query('SELECT * FROM st_elements');
        $this->tree=$queryTree->fetchAll(PDO::FETCH_ASSOC);

    }

} 