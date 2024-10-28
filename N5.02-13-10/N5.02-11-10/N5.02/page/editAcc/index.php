
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
                        $sql = "SELECT * FROM taikhoan t inner join chucvu c on t.phanquyen = c.maChuc inner join nguoidung n on n.IDUser = t.IDAccount inner join gioitinh g on g.idGender = n.Gioitinh where n.IDUser = '$id'";
                        $result = $obj->laydulieu($sql);
                    echo'<th><input class="acc" type="text" name="txtName" value="'.$result[0]['Hoten'].'" size="30" placeholder="Họ Tên" /></th>';
                     }
                    ?>
                </tr>
                <tr>
                    <th> <label for="">Số điện thoại:</label></th>
                    <?php
                    echo'<th><input class="acc" type="text" name="txtSDT" value="'.$result[0]['SDT'].'" size="30" placeholder="SDT" /></th>';
                    ?>
        
                </tr> 
                <tr>
                    <th> <label for="">Giới tính:</label>
                    <th>
                    <select name="gioitinh" id="">
                    <?php
                        $sql ="select * from gioitinh";
                        $result = $obj->laydulieu($sql);
                        for($i=0;$i<count($result);$i++){
                            echo'<option value="'.$result[$i]["idGender"].'">
                            '.$result[$i]["nameGender"].'
                        </option>';
                        }
                    ?>
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
                     $sql = "SELECT * FROM taikhoan t inner join chucvu c on t.phanquyen = c.maChuc inner join khachhang n on n.IDUser = t.IDAccount inner join gioitinh g on g.idGender = n.Gioitinh where t.IDAccount = '$id'";
                     $result = $obj->laydulieu($sql);
                        echo'<th><input class="acc" type="text" name="txtTenDN" size="30" value="'.$result[0]['username'].'" placeholder="username" /></th>';   
                    ?>
                </tr>
                <tr>
                    <th> <label for="">Mật khẩu:</label></th>
                    <?php
                    echo'<th><input class="acc" type="text" name="txtPass" value="'.$result[0]['password'].'" size="30" placeholder="password" /></th>';
                    ?>
                </tr>
                <tr>
                    <th> <label for="">Nhập lại mật khẩu:</label></th>
                    <?php
                    echo'<th><input class="acc" type="text" name="txtRePass" value="'.$result[0]['password'].'" size="30" placeholder="password" /></th>';
                    ?>
                </tr>
                <tr>
                    <th> <label for="">Chức vụ:</label>
                    <th>
                    <select name="chucvu" id="">
                    <?php
                        $sql ="select * from chucvu";
                        $result = $obj->laydulieu($sql);
                        for($i=0;$i<count($result);$i++){
                            echo'<option value="'.$result[$i]["maChuc"].'">
                            '.$result[$i]["tenchucvu"].'
                        </option>';
                        }
                    ?>
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
//    if($name=""||$sdt==""|| $date=""||$password=""||$username=""||$Repass=""){
   if($password == $rePass){
       $result = $obj->suataikhoan($id,$username,$password,$chucvu,$name,$sdt,$date,$gioitinh);
       echo'<script>alert("Sửa tài khoản thành công");
            </script>';
   
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
