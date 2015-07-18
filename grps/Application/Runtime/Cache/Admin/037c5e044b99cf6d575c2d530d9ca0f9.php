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

		<script type="text/javascript" src="/grps/Public/media/js/jquery.js"></script>
		<script type="text/javascript" src="/grps/Public/media/js/jquery.dataTables.js"></script>
	 	<script type="text/javascript" src="/grps/Public/media/js/demo.js"></script>
	 	<script type="text/javascript" src="/grps/Public/js/bootstrap-dropdown.js"></script>
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
							<li class="dropdown active" id="accountmenu">
                        	<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-bell"></i> 灾情管理<b class="caret"></b></a>
                        		<ul class="dropdown-menu">
                           			<li><a href="<?php echo U('Disaster/uncheckDisaster')?>"><i class="glyphicon glyphicon-ok"></i> 灾情审核</a></li>
                            		<li><a href="#"><i class="glyphicon glyphicon-search"></i> 灾情查看</a></li> 
                        		</ul>
                    	</li>
                    	
						<li>
							<li class="dropdown" id="accountmenu">
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
		<table class="bordered-table zebra-striped" id="example">
		    <caption>灾情信息</caption>
		    
		    <thead>
		        <tr>
		            <th>地区</th>
			        <th>时间</th>
			        <th>起始时间</th>
			        <th>结束时间</th>
			        <th>受灾原因</th>
			        <th>受灾面积</th>
			        <th>经济损失</th>
			        <th>是否通过审核</th>
			        <th>操作</th>
		     	</tr>
		   </thead>
		   <tbody>
		      	<?php foreach ($disadata as $key => $value): ?>
		   			<tr>
			        	<td><?php echo $value['disa_dist']?></td>
			         	<td><?php echo $value['disa_date']?></td>
			         	<td><?php echo $value['disa_begindate']?></td>
			         	<td><?php echo $value['disa_enddate']?></td>
			         	<td><?php echo $value['disa_situ']?></td>
			         	<td><?php echo $value['disa_area']?></td>
			         	<td><?php echo $value['disa_eloss']?></td>
			         	<td><?php echo $value['disa_status']?></td>
			         	<td>
			         	<?php if($value['disa_status_id'] == 1){ ?>
			         		<a href="/grps/index.php/admin/disaster/../Disaster/updateDisaster?disa_id=<?php  echo $value['disa_id']; ?>" class="btn btn-info" role="button">编辑</a>
			         	<?php }else{ ?>
								<a class="btn" disabled="disabled">编辑</a>
						<?php } ?>
			       			<a href="/grps/index.php/admin/disaster/../Disaster/deleteDisaster?disa_id=<?php  echo $value['disa_id']; ?>" class="btn btn-warning" role="button">删除</a>
			         	</td>
		      		</tr>
		   		<?php endforeach;?>
		   	</tbody>
		</table>
		</div>

	</body>
</html>