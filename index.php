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
    $htmlTree.="<ul>";
    $htmlTree.="<li>";
    $htmlTree.=$rootElement["name"];
    $htmlTree .= generateTreeBranch($storage, $rootElement['id']);
    $htmlTree.="</li>";
    $htmlTree.="</ul>";
}

function generateTreeSelect(Storage $storage, $id, $level="-"){
    $children=$storage->getChild($id);
    if(!is_array($children) || empty($children)){
        return '';
    }
    $html = '';
    foreach($children as $child){
        $html .= "<option value='$child[name]'>";
        $html .= $level.$child['name'];
        $html .= "</option>";
        $level.=$level."-";
        $html .= generateTreeSelect($storage, $child['id'],$level);
    }
    return $html;
}

foreach($storage->getRootElements() as $rootElement){
    $htmlSelect.=$rootElement["name"];
    $htmlSelect.="<option value='$rootElement[name]'>";
    $htmlSelect.=$rootElement["name"];
    $htmlSelect.="</option>";
    $htmlSelect .= generateTreeSelect($storage, $rootElement['id']);
}


$page=str_replace("{{TREE}}",$htmlTree,$page);
$page=str_replace("{{SELECT}}",$htmlSelect,$page);

if($addElement){
    header('Location: '.$_SERVER['REQUEST_URI']);
    exit();
}



echo $page;