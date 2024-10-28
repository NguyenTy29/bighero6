<?php
session_start();
error_reporting(0);
include('./class/class.php');

$obj = new databse();
if(isset($_SESSION['dangnhap'])){
    // if($page = 'admin' && $_SESSION['dangnhap'] = 1 ){
    //     // echo"122222222223123";
    //     include("./page/admin/index.php");
    // }else{

   
    include('./layout/header.php');
    if(isset($_REQUEST['page'])){
        $page = $_REQUEST['page'];
    }else{
        $page = 'trangchu';
    }
    include('./page/'.$page.'/index.php');
    include('./layout/footer.php'); 
// }
}else{
    include('./page/dangnhap/index.php');

}


?>

    