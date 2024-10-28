<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<div id="main">
    <h1>Tách Tin</h1>
    <div id="left">
        <h2>Image:</h2>
        <label style="width: 200px; border: 2px solid #ccc; height: 50px; background-color: violet; padding: 5px; border-radius: 10px; line-height: 50px;" for="file">Nhập ảnh</label>
        <input hidden id="file" type="file"/><br/>
        <div class="btns">
            <span id="read" class="btn">Tách văn bản</span>
        </div>
        <div id="error" style="color: red;"></div>
    </div>
    <div id="right">
        <div id="original" class="half">
            <h2>Hình gốc:</h2>
            <img width="300px" id="img" src=""/>
        </div>
        <div id="stego" class="half"></div>
        <div id="messageArea" class="invisible">
            <h2>Văn bản:</h2>
            <div id="message"></div>
        </div>
        <div id="fileArea" class="invisible">
            <h2>Tệp được nhúng:</h2>
<a id="downloadFile" href="" download="extracted.txt" style="pointer-events: none; color: gray;">Tải Dữ Liệu Đã Nhúng</a>
    </div>
    <!-- <div class="clear"></div> -->
</div>

<script type="text/javascript" src="./build/steganography.js"></script>
<script type="text/javascript">

function handleFileSelect(evt) {
    var original = document.getElementById("original"),
        img = document.getElementById("img"),
        message = document.getElementById("message"),
        errorElement = document.getElementById("error");

    if (!original) return;

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
                message.innerHTML = "";
                message.parentNode.className = "invisible";
                errorElement.innerHTML = ""; // Clear error message
            };
        })(f);

        reader.readAsDataURL(f);
    }
}

function read() {
    var img = document.getElementById("img"),
        message = document.getElementById("message"),
        fileArea = document.getElementById("fileArea"),
        downloadFile = document.getElementById("downloadFile"),
        errorElement = document.getElementById("error");

    if (!img.src) {
        errorElement.innerHTML = "Vui lòng chọn ảnh.";
        return;
    }

    var extractedText = steg.decode(img);

    // Tách nội dung nếu có tệp
    var fileRegex = /\[File: (.+?)\]/;
    var match = extractedText.match(fileRegex);

    if (match && match[1]) {
        var fileInfo = JSON.parse(match[1]);
        var fileContent = extractedText.replace(fileRegex, '').trim();  // Loại bỏ dòng chỉ tên file

        // Chuyển đổi chuỗi base64 trở lại thành ArrayBuffer
        var byteCharacters = atob(fileInfo.content);
        var byteNumbers = new Array(byteCharacters.length);
        for (var i = 0; i < byteCharacters.length; i++) {
            byteNumbers[i] = byteCharacters.charCodeAt(i);
        }
        var byteArray = new Uint8Array(byteNumbers);
        var fileBlob = new Blob([byteArray], { type: fileInfo.type });

        // Hiển thị và chuẩn bị file để tải xuống
        downloadFile.href = URL.createObjectURL(fileBlob);
        downloadFile.download = fileInfo.name;
        downloadFile.style.pointerEvents = "auto"; // Enable the link
        downloadFile.style.color = ""; // Reset color
        fileArea.className = "";
    } else {
        // Clear the download link if no valid file is found
        downloadFile.href = "";
        downloadFile.download = "";
        downloadFile.style.pointerEvents = "none"; // Disable the link
        downloadFile.style.color = "gray"; // Gray out the link
        fileArea.className = "invisible";
        message.innerHTML = extractedText;
        if (message.innerHTML !== "") {
            message.parentNode.className = "";
        }
    }
}

window.onload = function() {
    document.getElementById('file').addEventListener('change', handleFileSelect, false);
    document.getElementById('read').addEventListener('click', read, false);
};
</script>

