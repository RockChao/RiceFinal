<?php if (!defined('THINK_PATH')) exit();?><html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>广东省市县稻谷预警系统</title>
		<link rel="stylesheet" type="text/css" href="/grps/Public/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="/grps/Public/media/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="/grps/Public/media/DT_bootstrap.css">
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
					<li class="dropdown">
                       	<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-bell"></i> 灾情管理<b class="caret"></b></a>
                       	<ul class="dropdown-menu">
                           	<li><a href="<?php echo U('Disaster/addDisaster')?>"><i class="glyphicon glyphicon-upload"></i> 灾情上报</a></li>
                          	<li><a href="<?php echo U('Disaster/manageDisaster')?>"><i class="glyphicon glyphicon-search"></i> 历史灾情</a></li>
                      	</ul>
                    </li>
					<li class="dropdown active">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-list"></i> 水稻管理<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                           	<li><a href="<?php echo U('Rice/addRice')?>"><i class="glyphicon glyphicon-pencil"></i> 水稻提交</a></li>
                          	<li><a href="#"><i class="glyphicon glyphicon-search"></i> 水稻查询</a></li>
                      	</ul>
                    </li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-user"></i> <?php echo session("user_name");?><b class="caret"></b></a>
						<ul class="dropdown-menu">
                           	<li><a href="<?php echo U('User/showInfo'); ?>"><i class="glyphicon glyphicon-cog"></i> 账户管理</a></li>
                      	</ul>
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
		    <caption>水稻信息</caption>
		    <thead>
		        <tr>
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
			         		<?php if($value['rice_status_id'] == 1){ ?>
			         		<a href="/grps/index.php/Home/Rice/../Rice/updateRice?rice_id=<?php  echo $value['rice_id']; ?>" class="btn btn-warning" role="button">编辑</a>
			         		<?php }else{ ?>
								<a class="btn" disabled="disabled">编辑</a>
						<?php } ?>
							<a href="/grps/index.php/Home/Rice/../Rice/detailRice?rice_id=<?php  echo $value['rice_id']; ?>" class="btn btn-info" role="button">详情</a>
			         	</td>
		      		</tr>
		   		<?php endforeach;?>
		   	</tbody>
		</table>
		</div>
		<script type="text/javascript" src="/grps/Public/js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="/grps/Public/js/bootstrap-dropdown.js"></script>
		<script type="text/javascript" src="/grps/Public/media/js/jquery.js"></script>
		<script type="text/javascript" src="/grps/Public/media/js/jquery.dataTables.js"></script>
	 	<script type="text/javascript" src="/grps/Public/media/js/demo.js"></script>			
	</body>
</html>