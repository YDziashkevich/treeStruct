<?php

class Form {
    private $mainPage;
    private $addElement;
    private $mainContent;

    public function __construct(){
        $this->mainPage=file_get_contents("./tpl/page.html");
        $this->mainContent=file_get_contents("./tpl/main.html");
        $this->addElement=file_get_contents("./tpl/add.html");
    }

    public function putSelect($element=array()){

    }

    public function getPage($pageContent="main"){
        if($pageContent=="add"){
            $page=str_replace("{{CONTENT}}",$this->addElement,$this->mainPage);
            return $page;
        }else{
            $page=str_replace("{{CONTENT}}",$this->mainContent,$this->mainPage);
            return $page;
        }
    }



} 