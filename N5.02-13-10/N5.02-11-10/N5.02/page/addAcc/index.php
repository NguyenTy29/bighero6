
<!DOCTYPE HTML>
<link rel="stylesheet" href="style.css">
<title>Tạo tài khoản</title>
<html>
    <style type="text/css">
        *{
            margin: 0 auto ;
            box-sizing: border-box;
        }
        
        h2{
            text-align: center;
            font-size: 30px;
            color: #ccc;
        }
        .log{
            width: 100%;
            /* height: 780px; */
            /* padding-top: 200px; */
            /* background-image: -webkit-linear-gradient(top left, #a802e0, #f7676a) */
            /* background-color: black; */
    }
    .login {
        /* position: absolute; */
        /* height:380px; */
        width:700px;
        margin:0;
        padding:10px;
        border:5px #CCC solid;
        border-radius: 25px;
        margin:  auto ;

    }
    input{
        border: none;
        border-bottom: 3px solid #CCC;;
        width: 400px;
        height: 40px;
    }
    .login input {
          padding:5px; margin:5px
    }
    .btn{
        width: 100px;
        height: 50px;
        border-radius: 10px ;
        background-color: red;
        cursor:pointer;
        font-weight: bold;
        color: #fff;

    }
    .btn:hover{
        background-color:#CCC;
        color: black;
        
    }
    .acc{
        border-radius: 10px;
        border-bottom: 4px solid #ccc;

    }
    .acc:hover{
        border-bottom: 4px solid red;
    }
    label{
        font-size: 20px;
         color: #ccc; 


        font-weight: bolder;
    }
    </style>  
    <body>
        <div class="log">
        <form method="post">
          <div class="login">
             <h2>Thêm người dùng</h2>
             <table>
             <tr>
                    <th> <label for="">Họ tên:</label></th>
                    <th><input class="acc" type="text" name="txtName" size="30" required placeholder="Họ Tên" /></th>
                </tr>
                <!-- <tr>
                    <th> <label for="">Số điện thoại:</label></th>
                    <th><input class="acc" type="text" name="txtSDT" required size="30" placeholder="Số điện thoại" /></th>
                </tr>  -->
                <tr>
                    <th> <label for="">Giới tính:</label>
                    <th>
                    <select name="gioitinh" id="">
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                </select>
                    </th>
                </tr> 
                <tr>
                <th> <label for="">Số điện thoại:</label></th>
                    <th><input required name="txtSDT" class="acc" type="text"></th>
                </tr>
                <th> <label for="">Email:</label></th>
                    <th><input required name="txtEmail" class="acc" type="text"></th>
                </tr>
                <th> <label for="">Ngày sinh:</label></th>
                    <th><input required class="acc" name="txtDate" type="date"></th>
                </tr>
                <tr>
                    <th><label for="">Tên đăng nhập: </label></th>
                    <th><input class="acc" type="text" name="txtTenDN" size="30"  placeholder="username" required /></th>
                </tr>
                <tr>
                    <th> <label for="">Mật khẩu:</label></th>
                    <th><input class="acc" type="password" name="txtPass" size="30" placeholder="password" required /></th>
                </tr>
                <tr>
                    <th> <label for="">Nhập lại mật khẩu:</label></th>
                    <th><input class="acc" type="password" name="txtRePass" size="30" placeholder="password" required /></th>
                </tr>
                <tr>
                    <th> <label for="">Chức vụ:</label>
                    <th>
                    <select name="chucvu" id="">
                    
                     <option value="QuanTriVien">Admin</option>
                     <option value="KhachHang">Khách hàng</option>
                
                </select>
                    </th>
                      
                    <!-- <th><input class="acc" type="password" name="txtPass" size="30" placeholder="password" /></th> -->
                </tr>
                <tr>
                    <th></th>
                    <th><input class="btn" name="btnAdd" type="submit" value="Tạo"/></th>
                </tr>
             </table>
             
          </div>
       </form>
       </div>
    </body>
</html>
<?php
if(isset($_REQUEST['btnAdd'])){
    $name = $_REQUEST['txtName'];
    $gioitinh = $_REQUEST['gioitinh'];
    $sodienthoai = $_REQUEST['txtSDT'];
    $date = $_REQUEST['txtDate'];
    $email = $_REQUEST['txtEmail'];
   $username = $_REQUEST['txtTenDN'];
   $password = $_REQUEST['txtPass'];
   $rePass = $_REQUEST['txtRePass'];
   $chucvu = $_REQUEST['chucvu'];
   $maqtv = $_SESSION['dangnhap'];
   if($password == $rePass){
        if($chucvu =='QuanTriVien'){
            $sql1 = "select * from taikhoan_quantrivien where UsernameQTV = '$username' ";
        }else{
            $sql1 = "select * from taikhoan_khachhang where UsernameKH = '$username' ";
        }
        echo$date;
        $result = $obj->laydulieu($sql1);
        if($result){
            echo"Tên đăng nhập đã tồn tại.";
        }else{
            $result = $obj->themtaikhoan($username,$password,$chucvu,$date,$name,$gioitinh,$sodienthoai,$email);
            // $sql2 = "insert into quantrivien_khachhang(MaQTV,MaKH,loaihoatdong) values('$maqtv','$username','Tạo tài khoản')";
            // $result1 = $obj->lichsuhoatdong($sql2);
        }
   }else{
    echo'Nhập lại mật khẩu không chính xác';
   }

}
?>
