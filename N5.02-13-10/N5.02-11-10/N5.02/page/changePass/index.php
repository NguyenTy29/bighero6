
<!DOCTYPE HTML>
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
        height:380px; width:700px;
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
             <h2>Đổi mật khẩu</h2>
             <table>
                <tr>
                    <th><label for="">Tên đăng nhập: </label></th>
                    <?php
                    if(isset($_REQUEST['id'])){
                        $id = $_REQUEST['id'];
                        $sql = "SELECT * FROM taikhoan where username = '$id'";
                        $result = $obj->laydulieu($sql);
                        echo'<th><input disabled class="acc" type="text" name="txtTenDN" size="30" value="'.$result[0]['username'].'" placeholder="username " /></th>';
                    }
                 
                    ?>
                </tr>
                <tr>
                    <th> <label for="">Mật khẩu:</label></th>
                    <?php
                    echo'<th><input class="acc" type="text" name="txtPass" value="'.$result[0]['password'].'"  placeholder="password" /></th>';
                    ?>
                </tr>
                <tr>
                    <th> <label for="">Nhập lại mật khẩu:</label></th>
                    <?php
                    echo'<th><input class="acc" type="text" name="txtRePass" value="'.$result[0]['password'].'"  placeholder="password" /></th>';
                    ?>
                </tr>
                
                <tr>
                    <th></th>
                    <th><input  class="btn" name="btnEdit" type="submit" value="Đổi mật khẩu"/></th>
                </tr>
             </table>
             
          </div>
       </form>
       </div>
    </body>
</html>
<?php

if(isset($_REQUEST['btnEdit'])){
   $username = $_REQUEST['txtTenDN'];
   $password = $_REQUEST['txtPass'];
   $rePass = $_REQUEST['txtRePass'];
   if($password == $rePass){
       $result = $obj->changepass($id,$username,$password);
       echo'<script>alert("Đổi mật khẩu thành công");
            </script>';
   
   }else{
    echo'Nhập lại mật khẩu không chính xác';
   }

}
?>
