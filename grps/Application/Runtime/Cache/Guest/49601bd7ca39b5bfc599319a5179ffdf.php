<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>广东省市县稻谷预警系统</title>
		<link rel="stylesheet" type="text/css" href="/grps/Public/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="/grps/Public/css/style.css"/>
		
	</head>
	<body>
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="<?php echo U('Index/index')?>">广东省市县稻谷预警系统</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-left">
					<li>
						<a href="<?php echo U('Index/index')?>"><i class="glyphicon glyphicon-home"></i>首页</a>
					</li>
					<li class="active">
						<a href="#"><i class="glyphicon glyphicon-user"></i>用户信息</a>
					</li>
					<li>
						<a href="<?php echo U('Disaster/manageDisaster')?>"><i class="glyphicon glyphicon-bell"></i>历史灾情</a>
					</li>
					<li>
						<a href="<?php echo U('Rice/manageRice')?>"><i class="glyphicon glyphicon-search"></i>水稻查询</a>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a><?php echo session("user_name");?></a>
					</li>
					<li>
						<a href="<?php echo U('Guest/logout')?>" class="logout"><i class="glyphicon glyphicon-off"></i>注销</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="add1">
		<div class="form-horizontal" role="form">
		  	<div class="form-group">
			    <label for="user_name" class="col-sm-2 control-label">用户名：</label>
			    <div class="col-sm-3">
			        <input type="text" class="form-control" name="user_name"  value="<?php echo $userdata['user_name'];?>" readonly>
			    </div>
			</div>
			   	
			<div class="form-group">
			    <label for="password" class="col-sm-2 control-label">密码：</label>
			    <div class="col-sm-3">
			        <input type="text" class="form-control" name="user_pw" value="<?php echo $userdata['user_pw'];?>" readonly>
			    </div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="/grps/Public/js/jquery-1.7.2.min.js"></script>	
</body>	
</html>