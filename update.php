<?php
require_once("index.php");
ob_start();
$ob->updated();

if(isset($_POST['sbmit']))
{
$fname=$_POST['uname'];
$lname=$_POST['ulname'];
$idl=$_POST['uid'];
$ob->updating(["first"=>$fname,"last"=>$lname],"data",$idl);
header("location:index.php?page=1");

}

?>