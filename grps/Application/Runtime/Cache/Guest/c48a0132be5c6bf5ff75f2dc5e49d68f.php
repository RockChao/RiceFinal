<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>广东省市县稻谷预警系统</title>
		<link rel="stylesheet" type="text/css" href="/grps/Public/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="/grps/Public/media/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="/grps/Public/media/DT_bootstrap.css">
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
						<li>
							<a href="<?php echo U('Guest/showInfo')?>"><i class="glyphicon glyphicon-user"></i>用户信息</a>
						</li>
						<li>
							<a href="<?php echo U('Disaster/manageDisaster')?>"><i class="glyphicon glyphicon-bell"></i>历史灾情</a>
						</li>
						<li class="active">
							<a href="#"><i class="glyphicon glyphicon-search"></i>水稻查询</a>
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
		<div class="container">
		<table class="bordered-table zebra-striped" id="example">
		    <caption>水稻信息</caption>
		    
		    <thead>
		        <tr>
		            <th>区县</th>
			        <th>年份</th>
			        <th>总人口</th>
			        <th>农业人口</th>
			        <th>耕地面积</th>
			        <th>水田面积</th>
			        <th>最后修改时间</th>
			        <th>操作</th>
		     	</tr>
		   </thead>
		   <tbody>
		      	<?php foreach ($ricedata as $key => $value): ?>
		   			<tr>
			        	<td><?php echo $value['dist_name']?></td>
			         	<td><?php echo $value['year']?></td>
			         	<td><?php echo $value['population']?></td>
			         	<td><?php echo $value['agri_population']?></td>
			         	<td><?php echo $value['agri_area']?></td>
			         	<td><?php echo $value['field_area']?></td>
			         	<td><?php echo $value['lastmodifed']?></td>
			         	<td>
			         		<a href="/grps/index.php/Guest/Rice/../Rice/detailRice?rice_id=<?php  echo $value['rice_id']; ?>" class="btn btn-primary" role="button">详情</a>
			         	</td>
		      		</tr>
		   		<?php endforeach;?>
		   	</tbody>
		</table>
		</div>
		<script type="text/javascript" src="/grps/Public/media/js/jquery.js"></script>
		<script type="text/javascript" src="/grps/Public/media/js/jquery.dataTables.js"></script>
	 	<script type="text/javascript" src="/grps/Public/media/js/demo.js"></script>
	</body>
</html>