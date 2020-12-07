<?php
require_once("main.php");
ob_start();
$ob=new Main();
if(isset($_POST['submit']))
{
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$ob->insert(["first"=>$fname,"last"=>$lname],"data");
header("index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>oops_crud</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
</head>
<body>
<div style="width:100%;height:100vh;position:absolute;background:rgba(0,0,0,0.4);z-index:2;" class="hideshow">
<div style="margin-left:auto;margin-right:auto;margin-top:16%;background:white;width:400px;height:225px;">
<div style="border-bottom:1px solid black;width:100%;height:34px;padding-right:5px;padding-top:2px;">
<span style='font-size:24px;float:right;cursor:pointer;' class="close">&#10008;</span>
</div>
<?php 
$ob->updated();
?>
</div>
</div>
<div class="container">
<div style="height:95px;padding:20px;text-align:center;background:violet;color:white;">
<h1><b>OOPS CRUD</b></h1>
</div>
<div style="height:75px;padding:20px;text-align:center;background:lightgreen;text-align:center;justify-content:center;">
<form method="POST" action="">
<input type="text" name="fname" class="form" >
<input type="text" name="lname" class="form" >
<input type="submit" name="submit" class="form">
</form>
</div>
<div style="padding:30px 100px;background:pink;">

<table class="table table-striped table-bordered table-hover " style="border:1px solid black;">
<thead>
    <tr style="background:violet;">
      <th scope="col" style="border:1px solid black;color:white;">Id</th>
      <th scope="col" style="border:1px solid black;color:white;">First_Name</th>
      <th scope="col" style="border:1px solid black;color:white;">Last_Name</th>
      <th scope="col" style="border:1px solid black;color:white;">Update</th>
      <th scope="col" style="border:1px solid black;color:white;">Delete</th>
    </tr>
    <?php
    $ob->deleted();
    ?>
  </thead>
  <tbody>
  <?php
$ob->read();
?>  
  </tbody>
</table>
<nav aria-label="..." style="margin-top:45px;">
  <ul class="pagination justify-content-center">
    <!--<li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1">Previous</a>
    </li>-->
    <?php 
    $ob->pagination();
    ?>
    <!--<li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>-->
  </ul>
</nav>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
$(".show").on("click",function(){
$(".hideshow").fadeIn('slow');
});
$(".close").on("click",function(){
$(".hideshow").fadeOut('slow');
});
});
</script>
</body>
</html>