<?php if (!defined('THINK_PATH')) exit();?><html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>广东省市县稻谷预警系统</title>
		<link rel="stylesheet" type="text/css" href="/grps/Public/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="/grps/Public/css/style.css"/>
		<link rel="stylesheet" type="text/css" href="/grps/Public/css/style2.css"/>
		<link rel="stylesheet" type="text/css" href="/grps/Public/css/demo.css"/>
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
			<form class="form-horizontal" method="post" id="userform" action="<?php  echo U('User/updateUser')?>">
			   	<div class="form-group">

			      	<label for="user_email" class="col-sm-2 control-label"> <span class="need">*</span>电子邮箱：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="user_email"  value="<?php echo $userdata['user_email'];?>" id="user_email">
			      	</div>
			      	<div><div class="Validform_checktip">邮箱长度必须为1~50个字符</div></div>
			   	</div>
			   	<div class="form-group">
			      	<label for="user_phone" class="col-sm-2 control-label"><span class="need">*</span>手机号码：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="user_phone"  value="<?php echo $userdata['user_phone'];?>" id="user_phone">
			      	</div>
			      	<div><div class="Validform_checktip">手机号长度必须为1~11位</div></div>
			   	</div>
			   	<div class="form-group">
			      	<label for="user_address" class="col-sm-2 control-label"><span class="need">*</span>地址：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="user_address"  value="<?php echo $userdata['user_address'];?>" id="user_address">
			      	</div>
			      	<div><div class="Validform_checktip">地址必须提供</div></div>
			    </div>
			    <div class="form-group">
			      	<div class="col-sm-offset-2 col-sm-10">
			         	<button type="submit" class="btn btn-info">确定</button>
			         	 <a href="<?php echo U('User/showInfo'); ?>"<button  class="btn btn-default">返回</button> </a>
			     	</div>     	
			   	</div>
			</form> 
		</div>		
		<script type="text/javascript" src="/grps/Public/js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="/grps/Public/js/bootstrap-dropdown.js"></script>	
		<script type="text/javascript" src="/grps/Public/js/Validform_v5.3.2.js"></script>
		<script type="text/javascript">
	var demo = null;
	$(function(){
	        demo = $("#userform").Validform({
	        tiptype:2,
	        label:".label",
	        showAllError:true,
	        ajaxPost:true,
	        callback:function(data){
	        	alert(data.info);
	        	if (data.status == "y") {
	        		demo.resetForm();
	        	}
	        }
	    });

	    demo.addRule([
	    {
	    	ele:"#user_email",
	    	datatype:"e",
	    	ajaxurl:"<?php  echo U('User/checkEmail'); ?>" + "&user_name=<?php echo $userdata['user_name']; ?>",
	    	nullmsg:"邮箱必须提供",
	    	errormsg:"请输入正确的邮箱"
	    },
	    {
	    	ele:"#user_phone",
	    	datatype:"n1-11",
	    	ajaxurl:"<?php  echo U('User/checkPhone'); ?>" + "&user_name=<?php echo $userdata['user_name']; ?>",
	    	nullmsg:"电话号码必须提供",
	    	errormsg:"请输入正确的电话号码"
	    },
	    {
	    	ele:"#user_address",
	    	datatype:"*",
	    	nullmsg:"请输入您的地址"
	    }
	    ]);
	});
	</script>
	</body>
</html>