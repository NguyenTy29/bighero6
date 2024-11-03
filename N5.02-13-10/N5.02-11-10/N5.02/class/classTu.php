<?php
    class databse{
        public function connect(){
            $conn = new mysqli('127.0.0.1:3307','root','','bighero6new');
            if($conn->connect_errno){
                echo'ket noi that bai';
                exit();
            }else{
                return $conn;
            }
        }
        // public function laydulieu($sql){
        //     $arr = array();
        //     $link = $this->connect();
        //     $result = $link->query($sql);
        //     if($result->num_rows){
        //         while($row = $result->fetch_assoc()){
        //             $arr[] = $row;
        //         }return $arr;
        //     }
        // }

        public function laydulieu($sql) {
            $arr = array();
            $link = $this->connect();
            $result = $link->query($sql);
            if ($result->num_rows) {
                while ($row = $result->fetch_assoc()) {
                    $arr[] = $row;
                }
            }
            return $arr; // Luôn trả về mảng, ngay cả khi rỗng
        }
        
        
    //     public function kiemtradangnhap($username,$pass){
    //         $sql ="select * from taikhoan where username = '$username' and password = '$pass'";
    //         $link = $this->connect();
    //         $result = $link->query($sql);
    //         if($result_num = 1 ){
    //             $row = $result->fetch_assoc();
    //             return $row['username'];
    //     }
    // }

    public function kiemtradangnhap($username, $pass) { 
        // Kết nối cơ sở dữ liệu
        $link = $this->connect();
    
        // Kiểm tra trong bảng TaiKhoan_KhachHang
        $sql_khachhang = "SELECT UsernameKH AS username, LoaiQuyen FROM TaiKhoan_KhachHang WHERE UsernameKH = '$username' AND Password = '$pass'";
        $result_khachhang = $link->query($sql_khachhang);
    
        if ($result_khachhang && $result_khachhang->num_rows > 0) {
            // Nếu tìm thấy trong bảng khách hàng
            $row = $result_khachhang->fetch_assoc();
            return [
                'username' => $row['username'],
                'LoaiQuyen' => $row['LoaiQuyen']
            ];
        }
    
        // Nếu không tìm thấy trong bảng khách hàng, kiểm tra trong bảng TaiKhoan_QuanTriVien
        $sql_quantrivien = "SELECT UsernameQTV AS username, LoaiQuyen FROM TaiKhoan_QuanTriVien WHERE UsernameQTV = '$username' AND Password = '$pass'";
        $result_quantrivien = $link->query($sql_quantrivien);
    
        if ($result_quantrivien && $result_quantrivien->num_rows > 0) {
            // Nếu tìm thấy trong bảng quản trị viên
            $row = $result_quantrivien->fetch_assoc();
            return [
                'username' => $row['username'],
                'LoaiQuyen' => $row['LoaiQuyen']
            ];
        }
    
        // Nếu không tìm thấy trong cả hai bảng, trả về null
        return null;
    }
    
    public function themtaikhoan($username,$password,$chucvu,$name,$gioitinh,$sdt,$email){
        $quyen = $chucvu;
        if($quyen=='KhachHang'){
            $sql1 = "insert into khachhang(MaKH,Hoten,Sodienthoai,Gioitinh,Email) values ('$username','$name','$sdt','$gioitinh','$email')";
            $sql = "insert into taikhoan_khachhang(UsernameKH,Password,LoaiQuyen) values ('$username','$password','$quyen')";
        }else{
            $sql1 = "insert into quantrivien(MaQTV,Hoten,Sodienthoai,Gioitinh,Email) values ('$username','$name','$sdt','$gioitinh','$email')";
            $sql = "insert into taikhoan_quantrivien(UsernameQTV,Password,LoaiQuyen) values ('$username','$password','$quyen')";
        }
        $link = $this->connect();
        $result2 = $link->query($sql1);
        $result = $link->query($sql);
         if( $result && $result2){
            echo"Tạo tài khoản thành công";
    }
}
    public function xoataikhoan($id,$quyen){
        $sql = "delete from taikhoan_khachhang where UsernameKH = '$id'";
        $link = $this->connect();
        if($quyen == 'KhachHang'){
            $result = $link->query($sql);
            if($result){
                echo'<script>alert("Xóa tài khoản thành công");
                </script>';
            }
        }else{
            echo'<script>alert("Không đủ quyền hạn xóa tài khoản này, vui lòng liên hệ người chủ trì.");
            </script>';
        }
    }
    public function suataikhoan($username,$password,$chucvu,$name,$sdt,$date,$gioitinh,$email){
        $sql = "update taikhoan set  password = '$password',Loaiquyen = '$chucvu' where username = '$username'";
        $sql1 = "update khachhang set Hoten = '$name', Sodienthoai = '$sdt',Gioitinh = '$gioitinh', Ngaysinh = '$date',Email ='$email' where MaKH = '$username'";
        $link = $this->connect();
        $result = $link->query($sql);
        $result = $link->query($sql1);

}
public function changepass($id,$username,$password){
    $sql = "update taikhoan set  password = '$password' where username = '$id'";
    $link = $this->connect();
    $result = $link->query($sql);

}
public function lichsuhoatdong($sql){
    $link = $this->connect();
    $result = $link->query($sql);
}

}
?>
