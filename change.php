<?php

session_start();
include('costanti.php');
$lang = $_REQUEST['lang'];

//$_SESSION['lang'] = $lang;

//header("Location:".$_SERVER['HTTP_REFERER']);
header("Location:"._URL_.'/'.$lang.'/');

?>
