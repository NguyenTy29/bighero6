<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="layout.css?v=2">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div id="container">
        <header>
            <ul>
                <li><a href="index.php?page=trangchu">Trang Chủ </a></li>
                <?php
                if(isset($_SESSION['dangnhap'])){
                    $username = $_SESSION['dangnhap'];
                    $sql ="select * from taikhoan where username = '$username'";
                    $result = $obj->laydulieu($sql);
                    $num = $result[0]['Loaiquyen'];
                    if($num == 'admin'){
                        echo'<li><a href="index.php?page=admin">Quản lí</a></li>';
                    }else{
                        echo'<li><a href="index.php?page=changePass&id='.$result[0]['username'].'">Đổi mật khẩu</a></li>';
                        echo'<li><a href="index.php?page=history&id='.$result[0]['username'].'">Lịch sử hoạt động</a></li>';
                    }
                }
                ?>
                <li><a href="index.php?page=dangxuat">Đăng Xuất</a></li>
            </ul>
        </header>
        <div class="content">
            <aside class="sidebar">
                <ul>
                    <li><a href="index.php?page=giautin"><i class="fas fa-file-alt"></i> Giấu tin văn bản</a></li>
                    <li><a href="index.php?page=giaufile"><i class="fas fa-file"></i> Giấu tin file</a></li>
                    <li><a href="index.php?page=tachtin"><i class="fas fa-cut"></i> Tách tin</a></li>
                </ul>
            </aside>
            <section>
                <!-- Existing content -->