<?php
session_start();
error_reporting(0);

if(!isset($_SESSION['email'])){
    header("location:trangdangnhap.php");
}
?>
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
                <h1>THÔNG TIN Đã Đăng Ký ĐĂNG KÝ</h1>
            </td>
        </tr>
        <tr>
            <td>
                <label for="">Họ Và Tên:</label>
            </td>
            <td><?php echo  $_SESSION['hvt']; ?></td>
        </tr>
        <tr>
            <td>
                <label for="">PassWord:</label>
            </td>
            <td><?php echo  $_SESSION['pass']; ?></td>
        </tr>
        <tr>
            <td>
                <label for="">Email:</label>
            </td>
            <td><?php echo  $_SESSION['email']; ?></td>
        </tr>
        <tr>
        <tr>
            <td>
                <label for="">Số Điện Thoại:</label>
            </td>
            <td><?php echo  $_SESSION['sdt']; ?></td>
        </tr>
        <tr>
            <td>
                <label for="">Giới Tính:</label>
            </td>
            <td><?php echo  $_SESSION["gt"]; ?></td>
        </tr>
        <tr>
            <td>
                <label for="">Sở Thích:</label>
            </td>
            <td><?php echo  join(',',$_SESSION["sothich"]); ?></td>
        </tr>
        </tr>
        <tr>
            <td>
                <label for="">Ảnh Đại Diện:</label>
            </td>
            <td><img src="<?php echo $_SESSION['anh']?>" alt="file upload Không phải anh" width="300px"></td>
        </tr>
    </table>
</form>

        </section>
        <footer>
            <p><h1>FOOTER</h1></p>
        </footer>
    </div>
</body>
</html>