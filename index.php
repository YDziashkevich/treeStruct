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
$htmlSelect="";
$addElement=false;


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
    $addElement=$storage->putElement($element);
}


function generateTreeBranch(Storage $storage, $id){
    $children=$storage->getChild($id);
    if(!is_array($children) || empty($children)){
        return '';
    }
    $html = '<ul>';
    foreach($children as $child){
        $html .= '<li>';
        $html .= $child['name'];
        $html .= generateTreeBranch($storage, $child['id']);
        $html .= '</li>';
    }
    $html .= '</ul>';

    return $html;
}

foreach($storage->getRootElements() as $rootElement){
    $child=array();
    $htmlTree.="<ul>";
    $htmlTree.="<li>";
    $htmlTree.=$rootElement["name"];
    $htmlTree .= generateTreeBranch($storage, $rootElement['id']);

//    if(!empty($child[0]["id"])){
//        $htmlTree.="<ul>";
//        foreach($child as $newChild){
//            $htmlTree.="<li>";
//            $htmlTree.=$newChild["name"];
//            $newChild=$storage->getChild($newChild[0]["id"]);
//            $htmlTree.=$child["name"];
//            $htmlTree.="</li>";
//        }
//        $htmlTree.="</ul>";
//    }
    $htmlTree.="</li>";
    $htmlTree.="</ul>";
}


$level="-";
foreach($storage->getRootElements() as $rootElement){

    $child=array();
    $htmlSelect.="<option value='$rootElement[name]'>";
    $htmlSelect.=$rootElement["name"];
    $htmlSelect.="</option>";/*
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

    }*/
}


$page=str_replace("{{TREE}}",$htmlTree,$page);
$page=str_replace("{{SELECT}}",$htmlSelect,$page);

if($addElement){
    header('Location: '.$_SERVER['REQUEST_URI']);
    exit();
}



echo $page;