<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="layout.css">
    <title>Document</title>
</head>
<body>
    <div id="container">
        <header>
            <p><h1>BANNER</h1></p>
        </header>
        <aside>
            <ul>
                <li><a href="trangchu.php">Trang Chủ </a></li>
                <li><a href="trangdangky.php">Trang Đăng Ký</a></li>
                <li><a href="trangdangnhap.php">Trang Đăng Nhập</a></li>
            </ul>
        </aside>
        <section>
        <!DOCTYPE html>
<html lang="en">
	<head>
		<title>Information Hiding: Steganography done with JavaScript</title>
		<meta content="index, follow" name="robots">
		<meta content="Peter Eigenschink" name="author">
		<meta content="This demo shows the core functionality of my JavaScript library steganography.js, which provides functions to hide or read data in or from the alpha channel of an image." name="description">
		<meta content="steganography, information hiding, javascript, html5" name="keywords">
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="http://www.peter-eigenschink.at/blog/favicon.ico" type="image/x-icon" rel="shortcut icon">
		<style>
			body, html {
				margin:0;
				padding:0;
				font-family:Arial,sans-serif;
				color:#717171;
			}
			h1 {
				color:black;
				margin-bottom:10px;
			}
			#main {
				position:relative;
				width:940px;
				padding:20px;
				margin:auto;
			}
			#right {
				position:relative;
				float:left;
				margin: 10px;
				width:600px;
				vertical-align:top;
			}
			#left {
				position:relative;
				float:left;
				width:260px;
				padding:10px;
				margin-right:10px;
				border-right:3px solid #7A91A1;
				background-color:#E8E0FF;
			}
			.half {
				position:relative;
				display:inline-block;
				width:49%;
			}
			#original {
				vertical-align:top;
			}
			#messageArea {
				width:100%;
			}
			#img, #cover {
				width:290px;
			}
			.btns {
				margin-top:15px;
				margin-bottom:10px;
				padding: 0 40px;
			}
			.btn {
				padding:10px 20px 10px 20px;
				-moz-border-radius:15px;
				-o-border-radius:15px;
				-webkit-border-radius:15px;
				border-radius:15px;
				border:2px solid #FF4545;
				cursor:pointer;
				color:#FF4545;
				background-color:white;
				width:50px;
				text-align:center;
			}
			.btn:hover {
				color:white;
				background-color:#FF4545;
			}
			#download {
				position:absolute;
				top:47px;
				left:4px;
				padding:10px 5px 5px 3px;
				width:10px;
				border-top:1px solid black;
				-moz-border-radius:0 0 15px 15px;
				-o-border-radius:0 0 15px 15px;
				-webkit-border-radius:0 0 15px 15px;
				border-radius:0 0 15px 15px;
				text-decoration:none;
			}
			#download:hover {
				width:70px;
			}
			#download:hover:after {
				content:"ownload";
			}
			#description {
				line-height:25px;
				padding-bottom:5px;
				border-bottom:1px solid lightgrey;
			}
			#capacity {
				font-weight:normal;
				font-size:15px;
				margin-left:10px;
				vertical-align:middle;
			}
			.note {
				font-size:9px;
				text-align:center;
				color:black;
			}
			.invisible {
				visibility:hidden;
			}
			.clear {
				clear:both;
			}
			.footer {
				margin-top:25px;
				width:100%;
				text-align:right;
			}
			textarea{
				width:228px;
				padding:10px;
				height:200px;
				resize:none;
			}
			h2{
				margin-top:0;
			}
      #read{
        float: right;
        position: relative;
        bottom:10px;
      }
		</style>
	</head>
	<body>
		<div id="main">
			<h1>Giấu Tin</h1>
			<div id="left">
				<h2>Image:</h2>
				<input id="file" type="file"/><br/>
				<h2>Text:<span id="capacity"></span></h2>
				<textarea id="text">Nhập Thông Điệp / Văn Bản Ở Đây</textarea>
				<div class="btns">
					<span id="hide" class="btn">Hide</span>
					<span id="read" class="btn">Read</span>
				</div>
			</div>
			<div id="right">
				<div id="original" class="half">
					<h2>Plain Image:</h2>
					<img id="img" src=""/>
				</div>
				<div id="stego" class="half">
					<h2>Encoded Image:</h2>
					<img id="cover" src=""/>
					<a id="download" class="btn small" download="cover.png" rel="nofollow"><strong>D</strong></a>
					<div class="note">Click "D"-button or if it does not work perform right-click to download</div>
				</div>
				<div id="messageArea" class="invisible">
					<h2>Message:</h2>
					<div id="message"></div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<script type="text/javascript" src="../build/steganography.js"></script>
		<script type="text/javascript">

		function handleFileSelect(evt) {
			var original = document.getElementById("original"),
				stego = document.getElementById("stego"),
				img = document.getElementById("img"),
				cover = document.getElementById("cover"),
				message = document.getElementById("message");
			if(!original || !stego) return;

			var files = evt.target.files; // FileList object

			// Loop through the FileList and render image files as thumbnails.
			for (var i = 0, f; f = files[i]; i++) {

				// Only process image files.
				if (!f.type.match('image.*')) {
					continue;
				}

				var reader = new FileReader();

				// Closure to capture the file information.
				reader.onload = (function(theFile) {
					return function(e) {
						img.src = e.target.result;
						img.title = escape(theFile.name);
						stego.className = "half invisible";
						cover.src = "";
						message.innerHTML="";
						message.parentNode.className="invisible";
						updateCapacity();
					};
				})(f);

				// Read in the image file as a data URL.
				reader.readAsDataURL(f);
			}
		}

		function hide() {
			var stego = document.getElementById("stego"),
				img = document.getElementById("img"),
				cover = document.getElementById("cover"),
				message = document.getElementById("message"),
				textarea = document.getElementById("text"),
				download = document.getElementById("download");
			if(img && textarea) {
				cover.src = steg.encode(textarea.value, img);
				stego.className = "half";
				message.innerHTML="";
				message.parentNode.className="invisible";
				download.href=cover.src.replace("image/png", "image/octet-stream");
			}
		}

		function read() {
			var img = document.getElementById("img"),
				cover = document.getElementById("cover"),
				message = document.getElementById("message"),
				textarea = document.getElementById("text");
			if(img && textarea) {
				message.innerHTML = steg.decode(img);
				if(message.innerHTML !== "") {
					message.parentNode.className="";
					textarea.value = message.innerHTML;
					updateCapacity();
				}
			}
		}

		function updateCapacity() {
			var img = document.getElementById('img'),
				textarea = document.getElementById('text');
			if(img && text)
				document.getElementById('capacity').innerHTML='('+textarea.value.length + '/' + steg.getHidingCapacity(img) +' chars)';
		}

		window.onload = function(){
			document.getElementById('file').addEventListener('change', handleFileSelect, false);
			document.getElementById('hide').addEventListener('click', hide, false);
			document.getElementById('read').addEventListener('click', read, false);
			document.getElementById('text').addEventListener('keyup', updateCapacity, false);
			hide();
			updateCapacity();
		};
		</script>
	</body>
</html>

        </section>
        <footer>
            <p><h1>FOOTER</h1></p>
        </footer>
    </div>
</body>
</html>
