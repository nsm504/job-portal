<?php 

$page=0;
$page1=0;

if(isset($_GET['pg']))
{
    $page=$_GET['pg'];
}
else
{
    $page=1;
}

$page1= ($page-1)*5;
               
