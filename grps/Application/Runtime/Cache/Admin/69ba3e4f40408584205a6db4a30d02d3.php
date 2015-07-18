<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<title>广东省市县稻谷预警系统</title>
		<link rel="stylesheet" type="text/css" href="/grps/Public/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="/grps/Public/media/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="/grps/Public/media/DT_bootstrap.css">
		<link rel="stylesheet" type="text/css" href="/grps/Public/css/style.css"/>
		<link rel="stylesheet" type="text/css" href="/grps/Public/css/green.css"/>

		<script type="text/javascript" src="/grps/Public/js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="/grps/Public/js/bootstrap-dropdown.js"></script>
		<script type="text/javascript" src="/grps/Public/media/js/jquery.js"></script>
		<script type="text/javascript" src="/grps/Public/media/js/jquery.dataTables.js"></script>
	 	<script type="text/javascript" src="/grps/Public/media/js/demo.js"></script>
	 	<script type="text/javascript" src="/grps/Public/js/icheck.js"></script>
	 	<script type="text/javascript">
		$(document).ready(function(){
  		$('input').iCheck({
    		checkboxClass: 'icheckbox_square-green',
    		radioClass: 'iradio_square-green',
    		increaseArea: '20%' // optional
  			});
		});
		</script>
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
							<a href="<?php echo U('Index/index')?>"><i class="glyphicon glyphicon-home"></i> 首页</a>
						</li>

						<li class="dropdown" id="accountmenu">
                        	<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-user"></i> 信息员管理<b class="caret"></b></a>
                        	<ul class="dropdown-menu">
                                <li><a href="<?php echo U('User/addUser')?>"><i class="glyphicon glyphicon-plus"></i> 信息员新增</a></li>
                            	<li><a href="<?php echo U('User/manageUser')?>"><i class="glyphicon glyphicon-search"></i> 信息员查看</a></li>
                        	</ul>
                    	</li>

                    	<li class="dropdown" id="accountmenu">
                        	<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-user"></i> 用户管理<b class="caret"></b></a>
                        	<ul class="dropdown-menu">
                           		<li><a href="<?php echo U('Guest/addGuest')?>"><i class="glyphicon glyphicon-plus"></i> 用户新增</a></li>
                            	<li><a href="<?php echo U('Guest/manageGuest')?>"><i class="glyphicon glyphicon-search"></i> 用户查看</a></li>
                        	</ul>
                    	</li>

                    	<li>
							<li class="dropdown" id="accountmenu">
                        	<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-bell"></i> 灾情管理<b class="caret"></b></a>
                        		<ul class="dropdown-menu">
                           			<li><a href="<?php echo U('Disaster/uncheckDisaster')?>"><i class="glyphicon glyphicon-ok"></i> 灾情审核</a></li>
                            		<li><a href="<?php echo U('Disaster/manageDisaster')?>"><i class="glyphicon glyphicon-search"></i> 灾情查看</a></li> 
                        		</ul>
                    	</li>
                    	
						<li>
							<li class="dropdown active" id="accountmenu">
                        	<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-list"></i> 水稻管理<b class="caret"></b></a>
                        		<ul class="dropdown-menu">
                           			<li><a href="<?php echo U('Rice/uncheckRice')?>"><i class="glyphicon glyphicon-ok"></i> 水稻审核</a></li>
                            		<li><a href="<?php echo U('Rice/manageRice')?>"><i class="glyphicon glyphicon-search"></i> 水稻查看</a></li> 
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
		<div class="container">

			<form name="form1" method="post" action="<?php echo U('Rice/out'); ?>">
				<table class="bordered-table zebra-striped" id="example">
				    <caption>水稻信息</caption>
				    <thead>
				        <tr>
				        	<th>导出</th>
				            <th>区县</th>
					        <th>年份</th>
					        <th>总人口</th>
					        <th>农业人口</th>
					        <th>耕地面积</th>
					        <th>水田面积</th>
					        <th>基本信息</th>
					        <th>早稻</th>
					        <th>晚稻</th>
					        <th>最后修改时间</th>
					        <th>操作</th>
				     	</tr>
				   </thead>
				   <tbody>
				      	<?php foreach ($ricedata as $key => $value): ?>
				   			<tr>
				   				<td>
				   					<input type="checkbox" name="dist_id[]" value="<?php echo $value['dist_id']?>">
				   				</td>
					        	<td><?php echo $value['dist_name']?></td>
					         	<td><?php echo $value['year']?></td>
					         	<td><?php echo $value['population']?></td>
					         	<td><?php echo $value['agri_population']?></td>
					         	<td><?php echo $value['agri_area']?></td>
					         	<td><?php echo $value['field_area']?></td>
					         	<td><?php echo $value['brice_status']?></td>
					         	<td><?php echo $value['erice_status']?></td>
					         	<td><?php echo $value['lrice_status']?></td>
					         	<td><?php echo $value['lastmodifed']?></td>
					         	<td>
					         	<?php if($value['rice_status'] == 1){ ?>
					         		<a href="/grps/index.php/admin/rice/../Rice/updateRice?rice_id=<?php  echo $value['rice_id']; ?>" class="btn btn-info" role="button">编辑</a>
					         	<?php }else{ ?>
										<a class="btn" disabled="disabled">编辑</a>
								<?php } ?>
					         		<a href="/grps/index.php/admin/rice/../Rice/detailRice?rice_id=<?php  echo $value['rice_id']; ?>" class="btn btn-primary" role="button">详情</a>
					         		<a href="/grps/index.php/admin/rice/../Rice/deleteRice?rice_id=<?php  echo $value['rice_id']; ?>" class="btn btn-warning">删除</a>
					         		<a href="/grps/index.php/admin/rice/../Rice/showModifiedHistory?rice_id=<?php  echo $value['rice_id']; ?>" class="btn btn-warning" role="button">修改历史</a>
					         	<?php if($value['rice_status2'] == 2){ ?>
					         		<a href="/grps/index.php/admin/rice/../Rice/calculateRice?rice_id=<?php  echo $value['rice_id']; ?>" class="btn btn-success" role="button">指标计算</a>
					         	<?php }else{ ?>
					         		<a class="btn" disabled="disabled">不可计算</a>
					         	<?php } ?>
					         		
					         	</td>
				      		</tr>
				   		<?php endforeach;?>
				   	</tbody>

				</table>
				<input type="submit" class="btn btn-success" value="导出数据"/>
			</form>
		</div>
	</body>
</html>