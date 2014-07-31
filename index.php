<?php

require_once("./inc/inc.php");
date_default_timezone_set('UTC');

$form=new Form();
$storage=new Storage();
$tree=new Tree();

$element=array();
$page="";
$array=array();
$htmlTree="";


if(!empty($_POST) && isset($_POST["newElement"]) && isset($_POST["parent"]) && $_POST["parent"]!=" "){
    $array["add"]="add";
    $array["parent"]=$_POST["parent"];
    $page=$form->getPage($array);
}else{
    $page=$form->getPage();
}

if(isset($_POST["nameElement"])){
    foreach($form->getData() as $key=>$value){
        $element[$key]=$value;
    }
}

if(isset($element[":nameElement"]) && $element[":nameElement"]!=" "){
    $storage->putElement($element);
}


foreach($storage->getRootElements() as $item){
    $htmlTree="<ul>";
    $htmlTree.="<li>";
    $htmlTree.="$item[name]";
    $htmlTree.="<ul>";
    foreach($storage->getChild($item["name"]) as $item){


    }
    $htmlTree.="</ul>";
    $htmlTree.="</li>";
    $htmlTree.="</ul>";
}




echo $page;