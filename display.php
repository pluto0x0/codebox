<?php
header("Content-Type: text/html;charset=utf-8");
if(!isset($_GET['filename'])) die('请输入文件名！');
if(strpos($_GET['filename'],'/') != false) header('Location:index.php');
if($_GET['action'] == 'delete'){
	unlink('pool/'.$_GET['filename']);
	header('Location:index.php');
}
?>
<html>
	<head>
		<link rel="icon" href="favicon.ico" type="image/x-icon"/>
		<title>Code View - <?php echo $_GET['filename'];?></title>
		<!--- 
		Railscasts
		Solarized Light
		Tomorrow Night Eighties
		--->
		<link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.css">
		<link id="style" rel="stylesheet" href="//cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.15.10/build/styles/solarized-light.min.css"/>
		<script src="//cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.15.10/build/highlight.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>
		<script>
		hljs.configure({
			tabReplace: '    '
		})
		hljs.initHighlightingOnLoad();
		</script>
		<script>
var night = false;
function ChangeStyle(){
	var e = document.getElementById("style");
	var s = document.getElementById("view").children[0];
	var b = document.getElementsByTagName("body")[0];
	console.log(b);
	if(!night){
		e.setAttribute("href","//cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.15.10/build/styles/tomorrow-night-eighties.min.css");
		s.setAttribute("class","fa fa-sun-o");
		b.setAttribute("class","bd-dark");
		night = true;
	}
	else{
		e.setAttribute("href","//cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.15.10/build/styles/solarized-light.min.css");
		s.setAttribute("class","fa fa-moon-o");
		b.setAttribute("class","bd-light");
		night = false;
	}
}
		</script>
		<style>
		code:hover
		{
			transition-duration:0.3s;
			box-shadow: 0px 16px 32px 0px rgba(0,0,0,0.4);
		}
		code:active
		{
			transition-duration:0.4s;
			box-shadow: 0px 32px 64px 0px rgba(0,0,0,0.4);
		}
		pre
		{
			white-space: pre-wrap;
			word-wrap: break-word;
		}
		code
		{
			max-width: 90%;
			transition-duration:0.2s;
			border-radius:10px;
			box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.4);
			position:absolute;
			left:5%;
			top:5%;
		}
		button
		{
			transition-duration:0.3s;
			background-color: white;
			border: 2px solid #4CAF50; /* Green */
			border-radius: 4px;
			color: black;
			/*padding: 12px 16px;*/
			width: 70px;
			height: 70px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 3px 10px 0 rgba(0,0,0,0.19);
			
		}
		button:hover{
			transition-duration:0.3s;
			box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
			background-color: #4CAF50; /* Green */
			color: white;
		}
		@font-face
		{
			font-family:"Consola";
			src:url("font/consola.ttf") format('truetype');
　　	}
		code
		{
			font-family:"Consola";
			font-size:20px;
		}
		#copy
		{
			position:fixed;
			top:30px;
			right:15px;
		}
		#home
		{
			position:fixed;
			top:130px;
			right:15px;
		}
		#view
		{
			position:fixed;
			top:230px;
			right:15px;
		}
		footer
		{
			align:center;
		}
		.bd-dark
		{
			background-color: gray;
		}
		body
		{
			transition-duration:0.8s;
		}
		</style>
	</head>
	<body class="bd-light">
		<script>new ClipboardJS('.copy');</script>
<div id="main">
		<pre>
			<code id="code"><?php
$file = file_get_contents('pool/'.$_GET['filename']) or header('Location:index.php');
$file = str_replace('<','&lt;',$file);
$file = str_replace('>','&gt;',$file);
echo $file;
?></code>
</pre>
</div>
<button id="copy" class="copy" data-clipboard-target="#code"><i class="fa fa-files-o" aria-hidden="true" style="font-size:40px;"></i></button>
<button id="home" onclick="window.location.href='./'"><i class="fa fa-home" aria-hidden="true"  style="font-size:40px;"></i></button>
<button id="view" onclick="ChangeStyle()"><i class="fa fa-moon-o" aria-hidden="true"  style="font-size:40px;"></i></button>
	</body>
</html>