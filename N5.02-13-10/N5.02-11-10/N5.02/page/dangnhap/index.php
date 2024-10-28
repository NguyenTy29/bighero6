<!DOCTYPE HTML>
<html>
<head>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Roboto', sans-serif;
            /* background-color: #f0f0f0; */
            background-image: linear-gradient(to right, #DECBA4, #3E5151);
            background-image: url("https://png.pngtree.com/thumb_back/fw800/background/20191001/pngtree-delicate-fabric-floral-pattern-repeat-design-image_318393.jpg");
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .log {
            width: 100%;
            max-width: 400px;
            padding: 40px;
            background-color: #333;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            font-size: 24px;
            color: #fff;
            margin-bottom: 20px;
        }

        .login {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background-color: #f9f9f9;
            font-size: 16px;
        }

        .btn {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            background-color: #e74c3c;
            cursor: pointer;
            font-weight: bold;
            color: #fff;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #c0392b;
        }

        label {
            font-size: 16px;
            color: #fff;
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }
    </style>
</head>
<body>
    <div class="log">
        
        <form method="post">
            <div class="login">
                <h2>Đăng nhập</h2>
                <label for="txtTenDN">Tên đăng nhập:</label>
                <input class="acc" type="text" name="txtTenDN" placeholder="username" required />
                
                <label for="txtPass">Mật khẩu:</label>
                <input class="acc" type="password" name="txtPass" placeholder="password" required />
                
                <input class="btn" name="btnDN" type="submit" value="Sign in"/>
            </div>
        </form>
    </div>
</body>
</html>
<?php
if(isset($_REQUEST['btnDN'])){
    $username = $_REQUEST['txtTenDN'];
    $pass = $_REQUEST['txtPass'];
    $_SESSION['dangnhap'] = $obj->kiemtradangnhap($username,$pass);
    if(isset($_SESSION['dangnhap'])){
        echo"<script>alert('Đăng nhập thành công');</script>";
        header('Location: index.php?page=trangchu' );
    }else{
        echo"<script>alert('Tài khoản không tồn tại');</script>";
    }
}
?>