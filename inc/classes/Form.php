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

    public function getData(){
        $element=array();
<<<<<<< HEAD
        $element[":parentElement"]=(isset($_POST["parentElement"]))?$_POST["parentElement"]:" ";
        $element[":nameElement"]=(isset($_POST["nameElement"]))?$_POST["nameElement"]:" ";
        $element[":descriptionElement"]=(isset($_POST["descriptionElement"]))?$_POST["descriptionElement"]:" ";
        $element[":level"]=null;

=======
        $element["level"]=(isset($_POST["parentElement"]))?$_POST["parentElement"]:" ";
        $element["nameElement"]=(isset($_POST["nameElement"]))?$_POST["nameElement"]:" ";
        $element["discriptionElement"]=(isset($_POST["discriptionElement"]))?$_POST["discriptionElement"]:" ";
>>>>>>> origin/master
        return $element;
    }




} 