<?php

require_once("./inc/inc.php");
date_default_timezone_set('UTC');

$form=new Form();
$storage=new Storage();
$level="";
$element=array();
$page="";
$array=array();


if(!empty($_POST) && isset($_POST["newElement"]) && isset($_POST["parent"]) && $_POST["parent"]!=" "){
    $array["add"]="add";
    $array["parent"]=$_POST["parent"];
    $page=$form->getPage($array);
}else{
    $page=$form->getPage();
}

if(isset($_POST["nameElement"])){
    foreach($form->getData($level) as $key=>$value){
        $element[$key]=$value;
    }
}
//var_dump($element);

if(isset($element[":nameElement"]) && $element[":nameElement"]!=" "){
    $storage->putElement($element);
}



//var_dump($element);
echo $page;