
    <div class="addacc">
        <a class="newacc" href="index.php?page=addAcc">Thêm tài khoản</a>
        <a class="newacc" href="index.php?page=history">Lịch sử hoạt động</a>
    </div>
    <div class="search-bar">
        <form action="" method="post">
            <input type="text" id="searchInput" name="txtSearch" onkeyup="filterTable()" placeholder="Tìm kiếm Tên đăng nhập...">
            <button type="submit" class="btnSearch" name="btnSearch">Tìm</button>
        </form>
    </div>
    <table id="userTable">
        <tr>
            <th>Tên đăng nhập</th>
            <th>Mật khẩu</th>
            <th>Chức vụ</th>
            <th>Họ tên</th>
            <th>SDT</th>
            <th>Giới tính</th>
            <th>Ngày sinh</th>
            <th>IDAccount</th>
            <th>Mô tả</th>
            <th>Action</th>
        </tr>
        <?php
        if(isset($_REQUEST['btnSearch'])){
            $txtsearch = $_REQUEST['txtSearch'];
      
            $sql = "select * from taikhoan t inner join khachhang k on t.username = k.MaKH where t.username like '%$txtsearch%'";
        }else{
            $sql = "select * from taikhoan t inner join khachhang k on t.username = k.MaKH" ;
        }
            $result = $obj->laydulieu($sql);
            for($i=0;$i<count($result);$i++){
                echo"<tr>";
                echo"<td>".$result[$i]['username']."</td>
                <td>".$result[$i]['password']."</td>
                <td>".$result[$i]['Loaiquyen']."</td>
                <td>".$result[$i]['Hoten']."</td>
                <td>".$result[$i]['Sodienthoai']."</td>
                <td>".$result[$i]['Gioitinh']."</td>
                <td>".$result[$i]['Ngaysinh']."</td>
                <td>".$result[$i]['Email']."</td>
                <td></td>
                <td> <a class='action' href='index.php?page=editAcc&id=".$result[$i]['username']."'>Sửa</a>|<a class='action' href='index.php?page=admin&id=".$result[$i]['username']."&quyen=".$result[$i]['Loaiquyen']."'>Xóa</a></td>";
                echo"</tr>";
            }
            if(isset($_REQUEST['id'])){
                $id = $_REQUEST['id'];
                $quyen = $_REQUEST['quyen'];
                $result = $obj->xoataikhoan($id,$quyen);
                // if($result){
                //     echo'<script>window.location.reload();</script>';
                // }
            }
        ?>
    </table>

