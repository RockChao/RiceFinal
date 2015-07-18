<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>广东省市县稻谷预警系统</title>
		<link rel="stylesheet" type="text/css" href="/grps/Public/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="/grps/Public/css/style.css"/>
		<link rel="shortcut icon" href="/grps/Public/img/favicon.ico"/>
	</head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="<?php echo U('Index/index'); ?>">广东省市县稻谷预警系统</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-left">
					<li>
						<a href="<?php echo U('Index/index'); ?>" ><i class="glyphicon glyphicon-home"></i> 首页</a>
					</li>
					<li class="active">
						<a href="#"><i class="glyphicon glyphicon-user"></i> 信息员资料</a>
					</li>
					<li class="dropdown">
                       	<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-bell"></i> 灾情管理<b class="caret"></b></a>
                       	<ul class="dropdown-menu">
                           	<li><a href="<?php echo U('Disaster/addDisaster')?>"><i class="glyphicon glyphicon-upload"></i> 灾情上报</a></li>
                          	<li><a href="<?php echo U('Disaster/manageDisaster')?>"><i class="glyphicon glyphicon-search"></i> 历史灾情</a></li>
                      	</ul>
                    </li>
					<li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-list"></i> 水稻管理<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                           	<li><a href="<?php echo U('Rice/addRice')?>"><i class="glyphicon glyphicon-pencil"></i> 水稻提交</a></li>
                          	<li><a href="<?php echo U('Rice/manageRice')?>"><i class="glyphicon glyphicon-search"></i> 水稻查询</a></li>
                      	</ul>
                    </li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a><?php echo session("user_name");?></a>
					</li>
					<li>
						<a href="<?php echo U('User/logout')?>" class="logout"><i class="glyphicon glyphicon-off"></i> 注销</a>
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
			   	<div class="form-group">
			      	<label for="user_region" class="col-sm-2 control-label">所在区县：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="user_region"  value="<?php echo $userdata['user_region'];?>" readonly>
			      	</div>
			   	</div>
			   	<div class="form-group">
			      	<label for="user_email" class="col-sm-2 control-label"> 电子邮箱：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="user_email"  value="<?php echo $userdata['user_email'];?>" readonly>
			      	</div>
			   	</div>
			   	<div class="form-group">
			      	<label for="user_phone" class="col-sm-2 control-label">手机号码：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="user_phone"  value="<?php echo $userdata['user_phone'];?>" readonly>
			      	</div>
			   	</div>
			   	<div class="form-group">
			      	<label for="user_address" class="col-sm-2 control-label">地址：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="user_address"  value="<?php echo $userdata['user_address'];?>" readonly>
			      	</div>
			    </div>
			    <div class="form-group">
			      	<div class="col-sm-offset-2 col-sm-10">
			         	<a href="<?php echo U('User/updateUser'); ?>"> <input type="button" class="btn btn-info" value="修改"> </a>
			     	</div>
			   	</div>
			  </div>
		</div>
		<script type="text/javascript" src="/grps/Public/js/jquery-1.7.2.min.js"></script>	
		<script type="text/javascript" src="/grps/Public/js/bootstrap-dropdown.js"></script>
	</body>	
</html>