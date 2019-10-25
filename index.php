<?php header("Content-Type: text/html;charset=utf-8");?>
<html>
	<head>
		<link rel="icon" href="favicon.ico" type="image/x-icon"/>
		<title>CodeBox by Pluto0x0<?php if(isset($_GET['filename'])) echo ' - '.$_GET['filename'];?></title>
		<link rel="stylesheet" href="css/index.min.css">
	</head>
	<body>
<div class="hd">
<span class="logo">CodeBox&nbsp;&nbsp;&nbsp;</span><span class="des">powered by Pluto0x0</span>
<a href="https://github.com/pluto0x0/codebox/stargazers"><img alt="GitHub stars" src="https://img.shields.io/github/stars/pluto0x0/codebox"></a>
</div>
		<div id="dii">
		<form action="save.php" method="POST" id="main">
			文件名：<br/>
			<input class="filename" name="filename" type=text style="width:150px;" <?php if(isset($_GET['filename'])) echo 'value="'.$_GET['filename'].'"'?>/>&nbsp;
			<input type=submit>
		</form>
		<?php if(isset($_GET['filename'])):?>
			<a href=".">退出编辑</a><br/>
		<?php endif;?>
		代码：<br/>
		<textarea name="code" form="main" placeholder="//enter your code"><?php if(isset($_GET['filename'])) echo file_get_contents('pool/'.$_GET['filename']);?></textarea><br/>
		</div>
		<ul>
		<?php
		$dir = 'pool';
		if(is_dir($dir)){
			if($dh = opendir($dir)){
				while (($file = readdir($dh)) !== false){
					  if($file != '..' && $file != '.'){?>
						<li>
							<div class="dropdown">
								<a class="go dropdown" href="display.php?filename=<?php echo $file;?>"><?php echo $file;?></a> &nbsp;&nbsp;
								<div class="dropdown-content">
									<a class="edit" href="?filename=<?php echo $file;?>">编辑</a>
									<a class="del" href="display.php?filename=<?php echo $file;?>&action=delete">删除</a>
								</div>
							</div>
							<div></div>
						</li>
					  <?php }
				}
				closedir($dh);
			}
		}
		else echo '<b>dir nedied.</b>';
		?>
		</ul>
	</body>
</html>