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

/*
foreach($storage->getRootElements() as $rootElement){
    $htmlTree="<ul>";
    $htmlTree.="<li>";
    $htmlTree.="$rootElement[name]";
    $htmlTree.="<ul>";
    do{
        $child=$storage->getChild($rootElement);
    }while(!$child);
    foreach($storage->getChild($rootElement) as $childElement){

    }
    $htmlTree.="</ul>";
    $htmlTree.="</li>";
    $htmlTree.="</ul>";
}
*/


$html="";
foreach($storage->getRootElements() as $rootElement){
    $html.="<ul>";
    $html.=$rootElement["name"];
    $html.="<li>";
    $child=$storage->getChild($rootElement["id"]);
    if(!empty($child["id"])){
        $html.="<ul>";
        foreach($child as $newChild){
            $html.="<li>";
            $html.=$newChild["name"];
            $html.=$storage->getChild($newChild["id"])["name"];
            $html.="</li>";
        }
        $html.="</ul>";
    }
    $html.="</li>";
    $html.="</ul>";
}


echo $page;