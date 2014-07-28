<?php

require_once("./inc/inc.php");
date_default_timezone_set('UTC');

$form=new Form();
$storage=new Storage();
$element=array();
$page="";

if(!empty($_POST) && isset($_POST["newElement"]) && isset($_POST["select"]) && $_POST["select"]!=" "){
    $element["level"]=$_POST["select"];
    $form->putSelect($element);
    $page=$form->getPage("add");
}else{
    $page=$form->getPage();
}


echo $page;