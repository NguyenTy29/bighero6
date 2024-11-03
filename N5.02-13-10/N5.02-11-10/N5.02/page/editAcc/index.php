
<!DOCTYPE HTML>
<link rel="stylesheet" href="style.css">
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
        height:600px; width:700px;
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
             <h2>Sửa tài khoản</h2>
             <table>
                <tr>
                    <th> <label for="">Họ tên:</label></th>
                    <?php
                     if(isset($_REQUEST['id'])){
                        $id = $_REQUEST['id'];
                        $sql = "SELECT * FROM khachhang  where MaKH ='$id'";
                        $sql1 = "select * from taikhoan_khachhang where UsernameKH = '$id'";
                        $result = $obj->laydulieu($sql);
                        $result1 = $obj->laydulieu($sql1);
                    echo'<th><input class="acc"  type="text" name="txtName" value="'.$result[0]['Hoten'].'" size="30" placeholder="Họ Tên" /></th>';
                     }
                    ?>
                </tr>
                <tr>
                    <th> <label for="">Số điện thoại:</label></th>
                    <?php
                    echo'<th><input class="acc" type="text" name="txtSDT" value="'.$result[0]['Sodienthoai'].'" size="30" placeholder="SDT" /></th>';
                    ?>
        
                </tr> 
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
                <th> <label for="">Ngày sinh:</label></th>
                <?php
                      echo'<th><input class="acc" type="date" name="txtDate" size="30" placeholder="date" /></th>';
                ?>
                    <!-- <th><input type="date"></th> -->
                </tr>
                <tr>
                    <th><label for="">Tên đăng nhập: </label></th>
                    <?php
              
                        echo'<th><input class="acc"  type="text" name="txtTenDN" size="30" value="'.$result1[0]['UsernameKH'].'" placeholder="username" /></th>';   
                    ?>
                </tr>
                <tr>
                    <th> <label for="">Mật khẩu:</label></th>
                    <?php
                    echo'<th><input class="acc" type="text" name="txtPass" value="'.$result1[0]['Password'].'" size="30" placeholder="password" /></th>';
                    ?>
                </tr>
                <tr>
                    <th> <label for="">Nhập lại mật khẩu:</label></th>
                    <?php
                    echo'<th><input class="acc" type="text" name="txtRePass"  size="30" placeholder="password" /></th>';
                    ?>
                </tr>
                <tr>
                    <th> <label for="">Email:</label></th>
                    <?php
                    echo'<th><input class="acc" type="text" name="txtEmail" value="'.$result[0]['Email'].'" size="30" placeholder="Email" /></th>';
                    ?>
                </tr>
                <tr>
                    <th> <label for="">Chức vụ:</label>
                    <th>
                    <select name="chucvu" id="">
                     <option value="admin">Admin</option>
                     <option value="khách hàng">Khách hàng</option>
                </select>
                    </th>
                      
                    <!-- <th><input class="acc" type="password" name="txtPass" size="30" placeholder="password" /></th> -->
                </tr>
                <tr>
                    <th></th>
                    <th><input  class="btn" name="btnEdit" type="submit" value="Sửa"/></th>
                </tr>
             </table>
             
          </div>
       </form>
       </div>
    </body>
</html>
<?php

if(isset($_REQUEST['btnEdit'])){
    
    $name = $_REQUEST['txtName'];
    $sdt = $_REQUEST['txtSDT'];
    $date = $_REQUEST['txtDate'];
    $gioitinh = $_REQUEST['gioitinh'];
   $username = $_REQUEST['txtTenDN'];
   $password = $_REQUEST['txtPass'];
   $rePass = $_REQUEST['txtRePass'];
   $chucvu = $_REQUEST['chucvu'];
   $email = $_REQUEST['txtEmail'];
   $maqtv = $_SESSION['dangnhap'];
//    if($name=""||$sdt==""|| $date=""||$password=""||$username=""||$Repass=""){
   if($password == $rePass){
       $result = $obj->suataikhoan($username,$password,$chucvu,$name,$sdt,$date,$gioitinh,$email);
        echo'<script>alert("Sửa người dùng thành công.");
            </script>';
       
       
    //    $sql2 = "insert into quantrivien_khachhang(MaQTV,MaKH,loaihoatdong) values('$maqtv','$username','Sửa thông tin')";
    //         $result1 = $obj->lichsuhoatdong($sql2);
    //    echo'<script>alert("Sửa tài khoản thành công");
    //         </script>';
   
   }else{
    echo'<script>alert("Nhập lại mật khẩu không chính xác");
            </script>';
   }
// }else{
//     echo'<script>alert("Vui lòng điền đủ thông tin");
//     </script>';
// }

}
?>
