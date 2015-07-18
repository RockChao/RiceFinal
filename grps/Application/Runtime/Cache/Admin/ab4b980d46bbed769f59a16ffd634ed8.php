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
		<link rel="shortcut icon" href="/grps/Public/img/favicon.ico"/>
		<script type="text/javascript" src="/grps/Public/js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="/grps/Public/media/js/jquery.js"></script>
		<script type="text/javascript" src="/grps/Public/media/js/jquery.dataTables.js"></script>
	 	<script type="text/javascript" src="/grps/Public/media/js/demo.js"></script>
	 	<script type="text/javascript" src="/grps/Public/js/bootstrap-dropdown.js"></script>
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
                           				<li><a href="/grps/index.php/Admin/Disaster/../Index/show?lati=<?php echo $value['dist_latitude']?>&long=<?php echo $value['dist_longitude']?>"><?php echo $value['dist_name'];?></a></li>
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
                           				<li><a href="/grps/index.php/Admin/Disaster/../Index/show?lati=<?php echo $value['dist_latitude']?>&long=<?php echo $value['dist_longitude']?>"><?php echo $value['dist_name'];?></a></li>
                           				<?php endforeach; ?>
                        		</ul>
                    	</li>
                    	<?php } ?>
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
			<form name="form1" method="post" action="<?php echo U('Disaster/exportDataToExcel'); ?>">
				<table class="bordered-table zebra-striped" id="example">
				    <caption>灾情信息</caption>
				    
				    <thead>
				        <tr>
				        	<th>导出</th>
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
				   				<td>
						   			<input type="checkbox" name="disaster_ids[]" value="<?php echo $value['disa_id']?>">
						   		</td>
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
					         		<a href="/grps/index.php/Admin/Disaster/../Disaster/updateDisaster?disa_id=<?php  echo $value['disa_id']; ?>" class="btn btn-warning" role="button">编辑</a>
					         	<?php }else{ ?>
										<a class="btn" disabled="disabled">编辑</a>
								<?php } ?>
					       			<a href="/grps/index.php/Admin/Disaster/../Disaster/deleteDisaster?disa_id=<?php  echo $value['disa_id']; ?>" class="btn btn-danger" role="button" onclick="javascript:if(confirm('确定要删除此信息吗？')){return true;}return false;">删除</a>
					       			<a href="/grps/index.php/Admin/Disaster/../Disaster/detailDisaster?disa_id=<?php  echo $value['disa_id']; ?>" class="btn btn-info" role="button">详情</a>
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