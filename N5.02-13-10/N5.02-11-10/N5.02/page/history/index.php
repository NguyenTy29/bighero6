<h2>Lịch sử hoạt động</h2>
<table id="userTable">
    <tr>
        <th>Mã hoạt động</th>
        <th>Loại hoạt động</th>
        <th>mã người dùng</th>
        <th>Thời gian</th>
        
    </tr>
   

        <?php
        if($_SESSION['dangnhap']){
            $id = $_SESSION['dangnhap'];
            $sql ="select * from taikhoan where username = '$id'";
            $result = $obj->laydulieu($sql);
            $num = $result[0]['Loaiquyen'];
            if($num == 'admin'){
                $sql = "select * from lichsuhoatdong";
            }else{
                $sql = "select * from lichsuhoatdong where username = '$id'";
            }
            $result = $obj->laydulieu($sql);
         
            for($i=0;$i<count($result);$i++){
                echo"<tr><td>".$result[$i]['idHoatdong']."</td>";
                echo"<td>".$result[$i]['loaihoatdong']."</td>";
                echo"<td>".$result[$i]['username']."</td>";
                echo"<td>".date('l, F d, Y', time())." </td></tr>";
                // echo"<td>".$result[$i]['thoigian']." </td></tr>";
              
                
            }
        }
        ?>
       
    
</table>