<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<title>广东省市县稻谷预警系统</title>
		
		<link rel="stylesheet" type="text/css" href="/grps/Public/css/style.css"/>
		<link rel="stylesheet" type="text/css" href="/grps/Public/css/bootstrap.min.css"/>
		<link rel="shortcut icon" href="/grps/Public/img/favicon.ico"/>
		<script type="text/javascript" src="/grps/Public/js/jquery.js"></script>
		<script type="text/javascript" src="/grps/Public/js/bootstrap-dropdown.js"></script>
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">广东省市县稻谷预警系统</a>
				</div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-left">
						<li class="active">
							<a href="#"><i class="glyphicon glyphicon-home"></i> 首页</a>
						</li>

						<li class="dropdown">
                        	<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-user"></i> 信息员管理<b class="caret"></b></a>
                        	<ul class="dropdown-menu">
                        		<li><a href="<?php echo U('User/addUser')?>"><i class="glyphicon glyphicon-plus"></i> 信息员新增</a></li>
                            	<li><a href="<?php echo U('User/manageUser')?>"><i class="glyphicon glyphicon-search"></i> 信息员查看</a></li>

                        	</ul>
                    	</li>

                    	<li class="dropdown" >
                        	<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-user"></i> 用户管理<b class="caret"></b></a>
                        	<ul class="dropdown-menu">
                           		<li><a href="<?php echo U('Guest/addGuest')?>"><i class="glyphicon glyphicon-plus"></i> 用户新增</a></li>
                            	<li><a href="<?php echo U('Guest/manageGuest')?>"><i class="glyphicon glyphicon-search"></i> 用户查看</a></li>
                        	</ul>
                    	</li>

                    	<li>
							<li class="dropdown" >
                        	<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-bell"></i> 灾情管理<b class="caret"></b></a>
                        		<ul class="dropdown-menu">
                           			<li><a href="<?php echo U('Disaster/uncheckDisaster')?>"><i class="glyphicon glyphicon-ok"></i> 灾情审核</a></li>
                            		<li><a href="<?php echo U('Disaster/manageDisaster')?>"><i class="glyphicon glyphicon-search"></i> 灾情查看</a></li> 
                        		</ul>
                    	</li>
                    	
						<li>
							<li class="dropdown">
                        	<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-list"></i> 水稻管理<b class="caret"></b></a>
                        		<ul class="dropdown-menu">
                           			<li><a href="<?php echo U('Rice/uncheckRice')?>"><i class="glyphicon glyphicon-ok"></i> 水稻审核</a></li>
                            		<li><a href="<?php echo U('Rice/manageRice')?>"><i class="glyphicon glyphicon-search"></i> 水稻查看</a></li> 
                        		</ul>
                    		</li>
					</ul>


					<ul class="nav navbar-nav navbar-right">
						<?php if($ricedata['wave_number']==0){?>
							<li><a>无水稻预警</a></li>
						<?php }else{ ?>
						<li class="dropdown" id="disalist">
                        	<a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        		水稻预警
                        		<sup class="count"><?php echo $ricedata['wave_number'];?></sup>
                        	</a>
                        		<ul class="dropdown-menu">
                           			<?php foreach ($wavedata as $key => $value):?>
                           				<li><a href="/grps/index.php/Admin/User/../Index/show?lati=<?php echo $value['dist_latitude']?>&long=<?php echo $value['dist_longitude']?>"><?php echo $value['dist_name'];?></a></li>
                           				<?php endforeach; ?>
                        		</ul>
                    	</li>
                    	<?php } ?>

						<?php if($ricedata['disa_number']==0){?>
							<li><a>无处理灾情</a></li>
						<?php }else{ ?>
						<li class="dropdown" id="disalist">
                        	<a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        		灾情预警
                        		<sup class="count"><?php echo $ricedata['disa_number'];?></sup>
                        	</a>
                        		<ul class="dropdown-menu">
                           			<?php foreach ($disalist as $key => $value):?>
                           				<li><a href="/grps/index.php/Admin/User/../Index/show?lati=<?php echo $value['dist_latitude']?>&long=<?php echo $value['dist_longitude']?>"><?php echo $value['dist_name'];?></a></li>
                           				<?php endforeach; ?>
                        		</ul>
                    	</li>
                    	<?php } ?>

						<li class="dropdown">
                        	<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-cog"></i> <?php echo session("user_name");?><b class="caret"></b></a>
                        	<ul class="dropdown-menu">
                           		<li><a href="<?php echo U('User/changeAdminPassword')?>">修改密码</a></li>
                        	</ul>
                    	</li>
						
						<li>
							<a href="<?php echo U('User/logout')?>" class="logout"><i class="glyphicon glyphicon-off"></i> 注销</a>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="add1">
			<form class="form-horizontal" method="post" id="userform" action="<?php  echo U('User/changeAdminPassword')?>">
			   	<div class="form-group">
			      	<label for="user_email" class="col-sm-2 control-label">原密码：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="user_pw" value="<?php echo $data['user_pw'];?>" >
			      	</div>
			    </div>

			    <div class="form-group">
			      	<label for="user_email" class="col-sm-2 control-label">新密码：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="user_npw" value="<?php echo $data['user_npw'];?>" >
			      	</div>
			    </div>


			    <div class="form-group">
			      	<label for="user_email" class="col-sm-2 control-label">确认新密码：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="user_nnpw" value="<?php echo $data['user_nnpw'];?>" >
			      	</div>
			    </div>

			     <div class="form-group">
			      	<div class="col-sm-offset-2 col-sm-10">
			         	<button type="submit" class="btn btn-info">确定</button>
			     	</div>     	
			   	</div>
			</form> 
		</div>	

	</body>
</html>