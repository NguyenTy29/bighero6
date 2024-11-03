<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Giấu tin văn bản</title>
</head>
<body>

<div id="main">

    <h1 style="margin-bottom:10px;">Giấu Tin Văn Bản</h1>
    <div id="left">
        <h2>Chọn ảnh để nhúng:</h2>
        <label style="width: 200px; border: 2px solid #ccc; height: 50px; background-color: violet; padding: 5px; border-radius: 10px; line-height: 50px;" for="file">Tải ảnh lên</label>
        <input hidden id="file" type="file"/><br/>
        <h2>Nhập văn bản/thông điệp:<span id="capacity"></span></h2>
        <textarea id="text" rows="4" cols="50"></textarea>
        <div class="btns">
            <button id="hide" type="button" class="btn">Giấu dữ liệu vào ảnh</button>
        </div>
        <input style="visibility: hidden;" id="fileToEmbed" type="file"/>
        <div id="error" style="color: red;"></div>
    </div>
    <div id="right">
        <div id="original" class="half">
            <h2>Hình gốc:</h2>
            <img id="img" width="300px" src=""/>
        </div>
        <div id="stego" class="half" style="display: none;">
            <h2>Hình đã được nhúng văn bản:</h2>
            <img width="300px" id="cover" src=""/>
            <h1><div class="note" style="font-size: 15px;">Tải Ảnh Đã Nhúng Ở Đây</div></h1>
            <a href="" id="download" class="btn small" download="cover.png" rel="nofollow"><strong>Download</strong></a>
        </div>
        <div id="messageArea" class="invisible">
            <h2 hidden>Message:</h2>
            <div id="message"></div>
        </div>
    </div>
    
    <div class="clear"></div>
</div>

<?php
if(isset($_REQUEST['btnHide'])){
    // $iduser = $_SESSION['dangnhap'];
    // $layuser = "select * from taikhoan where username = '$iduser'";
    // $user = $obj->laydulieu($layuser);
    // $sqlhd = "insert into lichsuhoatdong (loaihoatdong,username) values ('Người dùng \'".$user[0]['username']. "\' đã thực hiện giấu tin ','$iduser')"; 
    // $value = $obj->lichsuhoatdong($sqlhd);
}
?>

<script type="text/javascript" src="./build/steganography.js"></script>
<script type="text/javascript">

function handleFileSelect(evt) {
    var img = document.getElementById("img"),
        cover = document.getElementById("cover"),
        stego = document.getElementById("stego"),
        errorElement = document.getElementById("error");

    if (!img) return;

    var files = evt.target.files; 
    var validImageTypes = ['image/png', 'image/jpeg', 'image/gif'];

    for (var i = 0, f; f = files[i]; i++) {
        if (!validImageTypes.includes(f.type)) {
            errorElement.innerHTML = "Hãy chọn ảnh JPEG, JPG, PNG.";
            continue;
        }

        var reader = new FileReader();

        reader.onload = (function(theFile) {
            return function(e) {
                img.src = e.target.result;
                img.title = escape(theFile.name);
                stego.style.display = "none"; // Ẩn phần hình đã nhúng khi chọn ảnh mới
                cover.src = "";
                errorElement.innerHTML = ""; // Xóa thông báo lỗi
                updateCapacity();
            };
        })(f);

        reader.readAsDataURL(f);
    }
}

function hide() {
    var img = document.getElementById("img"),
        cover = document.getElementById("cover"),
        stego = document.getElementById("stego"),
        textarea = document.getElementById("text"),
        download = document.getElementById("download"),
        fileInput = document.getElementById('fileToEmbed'),
        errorElement = document.getElementById('error');

    errorElement.innerHTML = '';

    if (!img.src) {
        errorElement.innerHTML = "Xin vui lòng nhập ảnh.";
        return;
    }

    if (!textarea.value && fileInput.files.length === 0) {
        errorElement.innerHTML = "Bạn chưa nhập thông điệp.";
        return;
    }

    var embeddedData = textarea.value;

    if (fileInput.files.length > 0) {
        var file = fileInput.files[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            var base64FileContent = btoa(e.target.result);
            var fileInfo = {
                name: file.name,
                type: file.type,
                content: base64FileContent
            };
            embeddedData += `\n[File: ${JSON.stringify(fileInfo)}]`;

            if (img && textarea) {
                cover.src = steg.encode(embeddedData, img);
                stego.style.display = "block"; // Hiển thị phần hình đã nhúng
                download.href = cover.src.replace("image/png", "image/octet-stream");
            }
        };
        reader.readAsBinaryString(file);
    } else {
        if (img && textarea) {
            cover.src = steg.encode(embeddedData, img);
            stego.style.display = "block"; // Hiển thị phần hình đã nhúng
            download.href = cover.src.replace("image/png", "image/octet-stream");
        }
    }
}

function updateCapacity() {
    var img = document.getElementById('img'),
        textarea = document.getElementById('text');
    if (img && textarea) {
        document.getElementById('capacity').innerHTML = '(' + textarea.value.length + '/' + steg.getHidingCapacity(img) + ' chars)';
    }
}

window.onload = function() {
    document.getElementById('file').addEventListener('change', handleFileSelect, false);
    document.getElementById('hide').addEventListener('click', hide, false);
    document.getElementById('text').addEventListener('keyup', updateCapacity, false);
    updateCapacity();
};
</script>

</body>
</html>
