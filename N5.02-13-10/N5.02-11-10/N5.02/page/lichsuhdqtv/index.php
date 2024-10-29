<table>
    <tr>
        <th>Mã QTV</th>
        <th>Loại hoạt động</th>
        <th>Mã khách hàng   </th>
        <th>Thời gian</th>
    </tr>
   
        <?php
        $sql = "select * from quantrivien_khachhang";
        $result = $obj->laydulieu($sql);
        for($i=0;$i<count($result);$i++)
{
    echo"<tr><td>".$result[$i]['MaQTV']."</td>";
    echo"<td>".$result[$i]['loaihoatdong']."</td>";
    echo"<td>".$result[$i]['MaKH']."</td>";
    echo"<td>".$result[$i]['thoigian']."</td></tr>";
}

?>
    
</table>