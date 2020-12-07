<?php
ob_start();
class Main
{
public $conn;
public $per_page;
public $total_page;
public $page;
public $offset;
function __construct()
{
    $db="oopcrud";
    $pass="";
    $user="root";
    $host="localhost";

    $this->conn=new mysqli($host,$user,$pass,$db);

    if($this->conn->connect_error)
    {
     die("connection_failed ".$this->conn->connect_error);
    }
    else 
    {
     //echo "connection successful";
    }
}

public function insert($val=array(),$table)
{
    $getkeys=implode(",",array_keys($val));
    $getval1=$val["first"];
    $getval2=$val["last"];
    $sql="INSERT INTO $table($getkeys) VALUES(?, ?)";
    $cf=$this->conn->prepare($sql);
    $cf->bind_param("ss", $getval1, $getval2);
    $cf->execute();
    header("location:index.php?page=1");
}


public function pagination()
{
  if(isset($_GET['page']))
  {
   $this->page=$_GET['page'];
  } 
  else
  {
    $this->page=1;
  } 
  $this->per_page=3;
  $this->offset=($this->page-1)*$this->per_page;
  $sqlq="SELECT * FROM data";
  $mc=$this->conn->prepare($sqlq);
  $mc->execute();
  $getr=$mc->get_result();
  $act_page=$getr->num_rows;
  $this->total_page=ceil($act_page/$this->per_page); 

  if($this->page>1)
  {
    $pn=$this->page-1;
    echo '<li class="page-item">
    <a class="page-link" href="index.php?page='.$pn.'">Previous</a>
  </li>';
  }
for($i=1;$i<=$this->total_page;$i++)
{
$ac="";
if($this->page==$i)
{
$ac="active";
}  
echo '<li class="page-item '.$ac.'"><a class="page-link" href="index.php?page='.$i.'">'.$i.'</a></li>';
}
if($this->page<$this->total_page)
{
  $pg=$this->page+1;
  echo '<li class="page-item">
  <a class="page-link" href="index.php?page='.$pg.'">Next</a>
</li>';
}

}

public function read()
{

  if(isset($_GET['page']))
  {
   $this->page=$_GET['page'];
  } 
  else
  {
    $this->page=1;
  } 
  $this->per_page=3;
  $this->offset=($this->page-1)*$this->per_page;
  for($i=1;$i<=$this->total_page;$i++)
{
}
  while($i<=$this->total_page)
  {
   $i=$i+1;
  }
  $sqlq="SELECT * FROM data";
  $mc=$this->conn->prepare($sqlq);
  $mc->execute();
  $getr=$mc->get_result();
  $act_page=$getr->num_rows;
  $this->total_page=ceil($act_page/$this->per_page); 

  $sql="SELECT * FROM data ORDER BY id DESC LIMIT ".$this->offset.",".$this->per_page;
  $cn=$this->conn->prepare($sql);
   $cn->execute();
   $res=$cn->get_result();
   if($res->num_rows>0)
   {
     while($row=$res->fetch_assoc())
     {
      echo '<tr>
      <th scope="row" style="border:1px solid black;">'.$row['id'].'</th>
      <td style="border:1px solid black;">'.$row['first'].'</td>
      <td style="border:1px solid black;">'.$row['last'].'</td>
      <td style="border:1px solid black;"><a class="btn btn-success show" href="update.php?fname='.$row['first'].",".$row['id'].'&lname='.$row['last'].'">Update</a></td>
      <td style="border:1px solid black;"><a class="btn btn-danger" href="index.php?id='.$row['id'].'">Delete</a></td>
      <form action=""><input type="hidden" value="'.$row['id'].'" name="amn"></form>
    </tr>';
     }
   }
   else
   {
    echo "no record found";
   }
  
}

public function updated()
{
 $lname=$_GET['lname'];
 $ln=explode(",",$_GET['fname']);
 $fname=$ln[0];
 $id=$ln[1];
 echo ' 
 <div style="padding:30px 171px;">
<form method="POST" action="">
<div class="form-group">
<input type="text" class="form-control" value="'.$fname.'" placeholder="First Name" name="uname">
</div>
<div class="form-group">
<input type="text" class="form-control" value="'.$lname.'" placeholder="Last Name" name="ulname">
</div>
<input type="hidden" class="form-control" value="'.$id.'"  name="uid">
<input type="submit" value="Update" class="btn btn-primary" name="sbmit">
</form>
</div>
 
 ';
}

public function deleted()
{
  if(isset($_GET['id']))
  {
  $q="DELETE from data WHERE id=?";
  $bl=$this->conn->prepare($q);
  $idn=$_GET['id'];
  $bl->bind_param("i",$idn);
  $bl->execute();
  header("location:index.php?page=1");

  }
}

public function updating($up=array(),$tbl,$nid)
{

  $getkeys=implode(",",array_keys($up));
  $getval1=$up["first"];
  $getval2=$up["last"];
  $sqp="UPDATE $tbl SET first=?,last=? WHERE id=?";
  $tv=$this->conn->prepare($sqp);
  $tv->bind_param("ssi",$getval1,$getval2,$nid);
  $tv->execute();
}


public function __destruct()
{
  $this->conn->close();
}

}

?>