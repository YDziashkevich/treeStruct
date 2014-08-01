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



foreach($storage->getRootElements() as $rootElement){
    $child=array();
    $htmlTree.="<ul>";
    $htmlTree.="<li>";
    $htmlTree.=$rootElement["name"];
    $child=$storage->getChild($rootElement["id"]);
    if(!empty($child["id"])){
        $htmlT.="<ul>";
        foreach($child as $newChild){
            $htmlTree.="<li>";
            $htmlTree.=$newChild["name"];
            $child=$storage->getChild($newChild["id"]);
            $htmlTree.=$child["name"];
            $htmlTree.="</li>";
        }
        $htmlTree.="</ul>";
    }
    $htmlTree.="</li>";
    $htmlTree.="</ul>";
}


$htmlSelect="<select>";
$level="-";
foreach($storage->getRootElements() as $rootElement){
    $child=array();
    $htmlSelect.="<optin value='$rootElement[name]'>";
    $htmlSelect.=$rootElement["name"];
    $htmlSelect.="</option>";
    $child=$storage->getChild($rootElement["id"]);
    if(!empty($child["id"])){
        $htmlSelect.="<option value='$child[name]'>";
        $htmlSelect.=$level;
        $htmlSelect.=$child["name"];
        $htmlSelect.="</option>";
        foreach($child as $newChild){
            $htmlSelect.="<option value='$newChild[name]'>";
            $htmlSelect.=$level;
            $htmlSelect.=$newChild["name"];
            $htmlSelect.="</option>";
            $child=$storage->getChild($newChild["id"]);
            $htmlSelect.="<option value='$child[name]'>";
            $htmlSelect.=$level;
            $htmlSelect.=$child["name"];
            $htmlSelect.="</option>";
        }

    }
}
$htmlSelect.="</select>";

$page=str_replace("{{TREE}}",$htmlTree,$page);
$page=str_replace("{{SS}}",$htmlSelect,$page);


echo $page;