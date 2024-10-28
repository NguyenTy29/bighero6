<h2>Lịch sử hoạt động</h2>
<table id="userTable">
    <tr>
        <th>Mã hoạt động</th>
        <th>Loại hoạt động</th>
        <th>mã người dùng</th>
        
    </tr>
   
    
        <?php
        $sql = "select * from lichsuhoatdong";
        $result = $obj->laydulieu($sql);
        for($i=0;$i<count($result);$i++){
            echo"<tr><td>".$result[$i]['IDHD']."</td>";
            echo"<td>".$result[$i]['hoatdong']."</td>";
            echo"<td>".$result[$i]['IDAccount']."</td></tr>";
            
        }
        ?>
       
    
</table>