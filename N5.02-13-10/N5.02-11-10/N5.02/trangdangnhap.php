<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="layout.css">
    <title>Document</title>
</head>
<body>
    <div id="container">
        <header>
            <p><h1>BANNER</h1></p>
        </header>
        <aside>
            <ul>
                <li><a href="trangchu.php">Trang Chủ </a></li>
                <li><a href="trangdangky.php">Trang Đăng Ký</a></li>
                <li><a href="trangdangnhap.php">Trang Đăng Nhập</a></li>
            </ul>
        </aside>
        <section>
<form action="" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>
                <h1>THÔNG TIN ĐĂNG KÝ</h1>
            </td>
        </tr>
        <tr>
            <td>
                <label for="">Họ Và Tên:</label>
            </td>
            <td><input type="text" name="hvt" required></td>
        </tr>
        <tr>
            <td>
                <label for="">PassWord:</label>
            </td>
            <td><input type="password" name="pass" required></td>
        </tr>
        <tr>
            <td>
                <label for="">Email:</label>
            </td>
            <td><input type="email" name="email" required></td>
        </tr>
        <tr>
        <td>
                <label for="">Số Điện Thoại:</label>
            </td>
            <td><input type="text" name="sdt" required></td>
        </tr>
        <tr>
        <td>
                <label for="">Giới Tính:</label>
            </td>
            <td><input type="radio" name="gt" value="Nữ">Nữ
            <input type="radio" name="gt" value="nam">Nam
        </td>
        </tr>
        <tr>
            <td>
                <label for="">Sở Thích:</label>
            </td>
            <td><input type="checkbox" name="sothich[]" value="Màu Tím">Màu Tím
            <input type="checkbox" name="sothich[]" value="Màu Đỏ">Màu Đỏ
            <input type="checkbox" name="sothich[]" value="Màu Xanh">Màu Xanh
            <input type="checkbox" name="sothich[]" value="Màu Hồng">Màu Hồng
        </td>
        </tr>
        <tr>
            <td>
                <label for="">Ảnh Đại Diện:</label>
            </td>
            <td><input type="file" name="hinhanh" required></td>
        </tr>
        <tr>
        <td>
                <label for="">Đăng Ký:</label>
            </td>
            <td><input type="submit" name="dangky" value="Đăng Ký">
            <input type="reset"  value="Xóa">
        </td>
        </tr>
    </table>
</form>
<?php
session_start();
if(isset($_POST['dangky'])){
    $_SESSION['hvt']=$_POST['hvt'];
    $_SESSION['sdt']=$_POST['sdt'];
    $_SESSION['pass']=$_POST['pass'];
    $_SESSION['gt']=$_POST['gt'];
    $_SESSION['email']=$_POST['email'];
    $_SESSION['sothich']=$_POST['sothich'];

    $hinhanhpart=basename($_FILES['hinhanh']['name']);
    $chuaanh="upload/";
    $muctieu= $chuaanh. $hinhanhpart;

    if(move_uploaded_file($_FILES['hinhanh']['tmp_name'],$muctieu)){
        $_SESSION['anh']=$muctieu;
        header("location:trangxuly.php");
    }else {
       echo 'khong phai anh';
    }
}

?>
        </section>
        <footer>
            <p><h1>FOOTER</h1></p>
        </footer>
    </div>
</body>
</html>