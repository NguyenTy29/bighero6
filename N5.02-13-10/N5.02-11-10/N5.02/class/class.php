<?php
    class databse{
        public function connect(){
            $conn = new mysqli('127.0.0.1:3307','root','','bighero66');
            if($conn->connect_errno){
                echo'ket noi that bai';
                exit();
            }else{
                return $conn;
            }
        }
        public function laydulieu($sql){
            $arr = array();
            $link = $this->connect();
            $result = $link->query($sql);
            if($result->num_rows){
                while($row = $result->fetch_assoc()){
                    $arr[] = $row;
                }return $arr;
            }
        }
        public function kiemtradangnhap($username,$pass){
            $sql ="select * from taikhoan where username = '$username' and password = '$pass'";
            $link = $this->connect();
            $result = $link->query($sql);
            if($result_num = 1 ){
                $row = $result->fetch_assoc();
                return $row['username'];
        }
    }
    public function themtaikhoan($username,$password,$chucvu){
        $sql = "insert into taikhoan(username,password,Loaiquyen) values ('$username','$password','$chucvu')";
        $sql1 = "insert into khachhang(MaKH,Hoten,Sodienthoai,Gioitinh) values ('$username','','','')";
        $link = $this->connect();
         $result = $link->query($sql);
         $result = $link->query($sql1);
         if( $result){
            echo"Tạo tài khoản thành công";
    }
}
    public function xoataikhoan($id,$quyen){
        $sql = "delete from taikhoan where username = '$id'";
        $link = $this->connect();
        if($quyen == 'khách hàng'){
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
