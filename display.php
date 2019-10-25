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
		<link rel="stylesheet" href="//cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.css">
		<link rel="stylesheet" href="css/display.min.css">
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
	//console.log(b);
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
	</head>
	<body class="bd-light">
		<script>var clipboard = new ClipboardJS('.copy');
		clipboard.on('error', function(e) {
    alert("复制失败，请按 Ctrl-C !");
});</script>
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