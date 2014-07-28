<?php
session_start();
error_reporting(E_ALL);

include_once("inc/putElement.php");

function __autoload($class_name) {
    include_once("inc/classes/$class_name.php");
}