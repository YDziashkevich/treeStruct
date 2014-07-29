<?php

class Form {
    private $mainPage;
    private $addElement;
    private $mainContent;
    private $parent;

    public function __construct(){
        $this->mainPage=file_get_contents("./tpl/page.html");
        $this->mainContent=file_get_contents("./tpl/main.html");
        $this->addElement=file_get_contents("./tpl/add.html");
    }




    public function getPage($array=array()){
        var_dump($array);
        if($array!=null && $array["add"]=="add"){
            $this->parent=$array["parent"];
            $page=str_replace("{{CONTENT}}",$this->addElement,$this->mainPage);
            $page=str_replace("{{parentElement}}",$this->parent,$page);
            return $page;
        }else{
            $page=str_replace("{{CONTENT}}",$this->mainContent,$this->mainPage);
            return $page;
        }
    }

    public function getData($level){
        var_dump($this->parent);
        $element=array();
        $element["level"]=$this->parent;
		(isset($_POST["parentElement"]))?$element["level"]=$_POST["parentElement"]:" ";
        (isset($_POST["nameElement"]))?$element["nameElement"]=$_POST["nameElement"]:$element["nameElement"]=" ";
        (isset($_POST["discriptionElement"]))?$element["discriptionElement"]=$_POST["discriptionElement"]:$element["discriptionElement"]=" ";
        return $element;
    }




} 