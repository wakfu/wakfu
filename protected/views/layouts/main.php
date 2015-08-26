<?php
/**
 * file:main.php
 * author:wakfu@outlook.com
 * date:2014-7-6
 * desc:主视图
 
 <title><?php echo CHtml::encode($this->app->name);?> - 生命短暂，注册即用</title>
 <a href="http://www.miitbeian.gov.cn">浙ICP备15026355号</a>
 */
$this->cs->registerPackage('bootstrap');
$this->cs->registerCss('main',"
body{padding-top:50px;}

#copyright {
	font-size: 14px;
	color: #777;
	text-align: center;
}
");
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title><?php echo CHtml::encode($this->app->name);?></title>
    <link rel="shortcut icon" href="http://wakfu.sinaapp.com/favicon.ico" type="image/x-icon"/>
	<!--[if lt IE 9]>
	<script type="text/javascript" src="http://wakfu.sinaapp.com<?php echo $this->assets; ?>js/html5shiv.min.js"></script>
	<script type="text/javascript" src="http://wakfu.sinaapp.com<?php echo $this->assets; ?>js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
    <div class="container">
        <?php echo $content; ?>
    </div>
    <div class="container">
    	<div class="row">
    		<div id="copyright">
    			<p>
                    &copy; <?php echo date('Y')?> 夸父 版权所有，保留所有权利。
                </p>
    		</div>
    	</div>
    </div>
</body>
</html>
