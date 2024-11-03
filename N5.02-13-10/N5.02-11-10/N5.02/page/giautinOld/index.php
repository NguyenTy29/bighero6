
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Giấu tin văn bản</title>
</head>
<body>

</body>
</html>
<div id="main">

    <h1>Giấu Tin</h1>
    <div id="left">
        <!-- <form  action=""   method="post"> -->
        <h2>Image:</h2>
        <label style="width: 200px; border: 2px solid #ccc; height: 50px; background-color: violet; padding: 5px; border-radius: 10px; line-height: 50px;" for="file">Nhập ảnh</label>
        <input hidden id="file" type="file"/><br/>
        <h2>Text:<span id="capacity"></span></h2>
        <textarea id="text"></textarea>
        <div class="btns">
            
            <button id="hide" type="submit" value="Giấu tin" name="btnHide" class="btn">Giấu tin</button>
            
            <!-- <span id="read" class="btn">Read</span> -->
        </div>
        <!-- <h2>Chọn tệp để nhúng (tùy chọn):</h2> -->
        <input style="visibility: hidden;" id="fileToEmbed" type="file"/>
        <div id="error" style="color: red;"></div>
    </div>
    <div id="right">
        <div id="original" class="half">
            <h2>Hình gốc:</h2>
            <img id="img" width="300px" src=""/>
        </div>
        <div id="stego" class="half">
            <h2>Hình đã được nhúng văn bản:</h2>
            <img  width="300px"  id="cover" src=""/>
            <h1><div class="note" style="font-size: 15px;">Tải Ảnh Đã Nhúng Ở Đây</div></h1>
            <a href="" id="download" type="submit"  class="btn small" download="cover.png"  rel="nofollow"><strong>Download</strong></a>
            <!-- </form> -->
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
    var original = document.getElementById("original"),
        stego = document.getElementById("stego"),
        img = document.getElementById("img"),
        cover = document.getElementById("cover"),
        message = document.getElementById("message"),
        errorElement = document.getElementById("error");

    if (!original || !stego) return;

    var files = evt.target.files; // FileList object
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
                stego.className = "half invisible";
                cover.src = "";
                message.innerHTML = "";
                message.parentNode.className = "invisible";
                errorElement.innerHTML = ""; // Clear error message
                updateCapacity();
                
            };
        })(f);

        reader.readAsDataURL(f);
    }
}

function hide() {
    var stego = document.getElementById("stego"),
        img = document.getElementById("img"),
        cover = document.getElementById("cover"),
        message = document.getElementById("message"),
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
        alert("Bạn chưa chọn file / nhập thông điệp.");
        errorElement.innerHTML = "Bạn chưa chọn file / nhập thông điệp.";
        return;
    }

    var embeddedData = textarea.value;

    // Nếu có tệp, thêm thông tin về tệp vào văn bản
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
                stego.className = "half";
                message.innerHTML = "";
                message.parentNode.className = "invisible";
                download.href = cover.src.replace("image/png", "image/octet-stream");
                
            }
        };
        reader.readAsBinaryString(file);
    } else {
        if (img && textarea) {
            cover.src = steg.encode(embeddedData, img);
            stego.className = "half";
            message.innerHTML = "";
            message.parentNode.className = "invisible";
            download.href = cover.src.replace("image/png", "image/octet-stream");

            <?php
            $iduser = $_SESSION['dangnhap'];
            $layuser = "select * from taikhoan where username = '$iduser'";
            $user = $obj->laydulieu($layuser);
            $time = time();
            $sqlhd = "insert into lichsuhoatdong (loaihoatdong,username) values ('Người dùng \'".$user[0]['username']. "\' đã thực hiện giấu tin ','$iduser')"; 
            $value = $obj->lichsuhoatdong($sqlhd);
            ?>
            
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
