<?php if (!defined('THINK_PATH')) exit();?><html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<title>广东省市县稻谷预警系统</title>
		<link rel="stylesheet" type="text/css" href="/grps/Public/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="/grps/Public/css/style.css"/>
		<link rel="stylesheet" type="text/css" href="/grps/Public/css/style2.css"/>
		<link rel="shortcut icon" href="/grps/Public/img/favicon.ico"/>
		<script type="text/javascript" src="/grps/Public/js/jquery-1.7.2.min.js"></script>
    	<script type="text/javascript" src="/grps/Public/js/bootstrap.min.js"></script>
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
                           				<li><a href="/grps/index.php/Admin/Rice/../Index/show?lati=<?php echo $value['dist_latitude']?>&long=<?php echo $value['dist_longitude']?>"><?php echo $value['dist_name'];?></a></li>
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
                           				<li><a href="/grps/index.php/Admin/Rice/../Index/show?lati=<?php echo $value['dist_latitude']?>&long=<?php echo $value['dist_longitude']?>"><?php echo $value['dist_name'];?></a></li>
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
				
		<div class='container'>
    	<div class='tabbable'>
    		<ul class='nav nav-tabs'>
            	<li class='active'><a href='#tab1' data-toggle='tab'>基本信息审核</a></li>
            	<li><a href='#tab2' data-toggle='tab'>早稻信息审核</a></li>
            	<li><a href='#tab3' data-toggle='tab'>晚稻信息审核</a></li>
        	</ul>
        <div class='tab-content'>
            <div class='tab-pane active' id='tab1'>
            <div class="add">

            <?php if($ricedata['brice_status']==1){?>

            	<form action="" method = "post" class="form-horizontal" role="form">
			  	<div class="form-group">
			      	<label for="username" class="col-sm-3 control-label">区县：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="rice_region" value="-" readonly>
			      	</div>
			   	</div>
			  	<div class="form-group">
			     <label for="year" class="col-sm-3 control-label">年份(年)(年)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="year"  value="-" readonly>
			      	</div>
			   	</div>
			   	
			   	<div class="form-group">
			      	<label for="password" class="col-sm-3 control-label">总人口(人)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="population" value="-" readonly>
			      	</div>
			   	</div>
			   	<div class="form-group">
			      	<label for="agri_population" class="col-sm-3 control-label">农业人口(人)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="agri_population"  value="-" readonly>
			      	</div>
			   	</div>
			   	<div class="form-group">
			      	<label for="zone_area" class="col-sm-3 control-label"> 区域面积(亩)： </label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="zone_area"  value="-" readonly>
			      	</div>
			   	</div>
			   	<div class="form-group">
			      	<label for="agri_area" class="col-sm-3 control-label">耕地面积(亩)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="agri_area"  value="-" readonly>
			      	</div>
			   	</div>
			   	<div class="form-group">
			      	<label for="field_area" class="col-sm-3 control-label">水稻种植面积(亩)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="field_area"  value="-" readonly>
			      	</div>
			    </div>
			    <div class="form-group">
			      	<label for="total_sown_area" class="col-sm-3 control-label">总播种面积(亩)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="total_sown_area"  value="-" readonly>
			      	</div>
			    </div>
			    <div class="form-group">
			      	<div class="col-sm-offset-3 col-sm-10">
			        	<input class="btn btn-warning" disabled="disabled" value="信息尚未提交">
			     	</div>
			   	</div>
			    </form>

			    <?php } else {?>
			    <form action="<?php echo U('Admin/Rice/checkRice'); ?>" method = "post" class="form-horizontal" role="form">
			  	<div class="form-group">
			      	<label for="username" class="col-sm-3 control-label">区县：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="rice_region" value="<?php echo $ricedata['rice_region'];?>" readonly>
			      	</div>
			   	</div>
			  	<div class="form-group">
			     <label for="year" class="col-sm-3 control-label">年份(年)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="year"  value="<?php echo $ricedata['year'];?>" readonly>
			      	</div>
			   	</div>
			   	
			   	<div class="form-group">
			      	<label for="password" class="col-sm-3 control-label">总人口(人)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="population" value="<?php echo $ricedata['population'];?>" readonly>
			      	</div>
			   	</div>
			   	<div class="form-group">
			      	<label for="agri_population" class="col-sm-3 control-label">农业人口(人)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="agri_population"  value="<?php echo $ricedata['agri_population'];?>" readonly>
			      	</div>
			   	</div>
			   	<div class="form-group">
			      	<label for="zone_area" class="col-sm-3 control-label"> 区域面积(亩)： </label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="zone_area"  value="<?php echo $ricedata['zone_area'];?>" readonly>
			      	</div>
			   	</div>
			   	<div class="form-group">
			      	<label for="agri_area" class="col-sm-3 control-label">耕地面积(亩)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="agri_area"  value="<?php echo $ricedata['agri_area'];?>" readonly>
			      	</div>
			   	</div>
			   	<div class="form-group">
			      	<label for="field_area" class="col-sm-3 control-label">水稻种植面积(亩)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="field_area"  value="<?php echo $ricedata['field_area'];?>" readonly>
			      	</div>
			    </div>
			    <div class="form-group">
			      	<label for="total_sown_area" class="col-sm-3 control-label">总播种面积(亩)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="total_sown_area"  value="<?php echo $ricedata['total_sown_area'];?>" readonly>
			      	</div>
			    </div>
			    <input type="hidden" name="rice_kind" value="<?php echo 1; ?>">
			  	<input type="hidden" name="rice_id" value="<?php echo $ricedata['rice_id']; ?>">
			    <div class="form-group">
			      	<div class="col-sm-offset-3 col-sm-10">
			      	<?php if($ricedata['brice_status']==2) { ?>
			        	<input type="submit" class="btn btn-info" value="通过">
			          	<input type="submit" name="failed" class="btn btn-warning" value="驳回">
			        <?php } if($ricedata['brice_status']==3||$ricedata['brice_status']==4) { ?>
			        	<input class="btn btn-warning" disabled="disabled" value="信息已审核">
			        <?php } ?>
			     	</div>
			   	</div>
			   	</form>
			    <?php } ?>
			</div>
            </div>


            <div class='tab-pane' id='tab2'>
            <div class="add">

            <?php if($ricedata['erice_status']==1){?>
            	<form action="" method = "post" class="form-horizontal" role="form">

            	<div class="form-group">
			     <label for="year" class="col-sm-3 control-label">年份(年)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="year" value="-" readonly>
			      	</div>
			   	</div>

            	<div class="form-group">
			      	<label for="e_sown_area" class="col-sm-3 control-label">早稻播种面积(亩)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="e_sown_area" value="-" readonly>
			      	</div>
			    </div>
			    
			    <div class="form-group">
			      	<label for="e_disaster_area" class="col-sm-3 control-label">早稻受灾面积(亩)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="e_disaster_area" value="-" readonly>
			      	</div>
			    </div>
			    <div class="form-group">
			      	<label for="e_production" class="col-sm-3 control-label">早稻产量(千公斤)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="e_production" value="-" readonly>
			      	</div>
			    </div>
			     <div class="form-group">
			      	<label for="e_market_price" class="col-sm-3 control-label">早稻市场价格(元/公斤)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="e_market_price" value="-" readonly>
			      	</div>
			    </div>
			    <div class="form-group">
			      	<label for="e_purchase_price" class="col-sm-3 control-label">早稻收购价格(元/公斤)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="e_purchase_price" value="-" readonly>
			      	</div>
			    </div>
			    <div class="form-group">
			      	<label for="e_fertilizer_price" class="col-sm-3 control-label">早稻化肥价格(元/百公斤)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="e_fertilizer_price" value="-" readonly>
			      	</div>
			    </div>
			    <div class="form-group">
			      	<div class="col-sm-offset-3 col-sm-10">
			      	<input class="btn btn-warning" disabled="disabled" value="信息尚未提交">
			     	</div>
			   	</div>
			    </form>

			<?php }else{ ?>
			    <form action="<?php echo U('Admin/Rice/checkRice'); ?>" method = "post" class="form-horizontal" role="form">

            	<input type="hidden" name="rice_kind" value="<?php echo 2; ?>">
			  	<input type="hidden" name="rice_id" value="<?php echo $ricedata['rice_id']; ?>">

            	<div class="form-group">
			     <label for="year" class="col-sm-3 control-label">年份(年)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="year"  value="<?php echo $ricedata['year'];?>" readonly>
			      	</div>
			   	</div>

            	<div class="form-group">
			      	<label for="e_sown_area" class="col-sm-3 control-label">早稻播种面积(亩)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="e_sown_area"  value="<?php echo $ricedata['e_sown_area'];?>" readonly>
			      	</div>
			    </div>
			    
			    <div class="form-group">
			      	<label for="e_disaster_area" class="col-sm-3 control-label">早稻受灾面积(亩)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="e_disaster_area"  value="<?php echo $ricedata['e_disaster_area'];?>" readonly>
			      	</div>
			    </div>
			    <div class="form-group">
			      	<label for="e_production" class="col-sm-3 control-label">早稻产量(千公斤)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="e_production"  value="<?php echo $ricedata['e_production'];?>" readonly>
			      	</div>
			    </div>
			     <div class="form-group">
			      	<label for="e_market_price" class="col-sm-3 control-label">早稻市场价格(元/公斤)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="e_market_price"  value="<?php echo $ricedata['e_market_price'];?>" readonly>
			      	</div>
			    </div>
			    <div class="form-group">
			      	<label for="e_purchase_price" class="col-sm-3 control-label">早稻收购价格(元/公斤)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="e_purchase_price"  value="<?php echo $ricedata['e_purchase_price'];?>" readonly>
			      	</div>
			    </div>
			    <div class="form-group">
			      	<label for="e_fertilizer_price" class="col-sm-3 control-label">早稻化肥价格(元/百公斤)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="e_fertilizer_price"  value="<?php echo $ricedata['e_fertilizer_price'];?>" readonly>
			      	</div>
			    </div>
			    <div class="form-group">
			      	<div class="col-sm-offset-3 col-sm-10">
			        	<?php if($ricedata['erice_status']==2) { ?>
			        	<input type="submit" class="btn btn-info" value="通过">
			          	<input type="submit" name="failed" class="btn btn-warning" value="驳回">
			        	<?php } if($ricedata['erice_status']==3||$ricedata['erice_status']==4) { ?>
			        	<input class="btn btn-warning" disabled="disabled" value="信息已审核">
			        	<?php } ?>
			     	</div>
			   	</div>
			    </form>
			    <?php } ?>
			</div>
            </div>
            

            <div class='tab-pane' id='tab3'>
            <div class="add">
            <?php if($ricedata['lrice_status']==1){ ?>
            	<form action="" method = "post" class="form-horizontal" role="form">
            	<div class="form-group">
			     <label for="year" class="col-sm-3 control-label">年份(年)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="year" value="-" readonly>
			      	</div>
			   	</div>
            	<div class="form-group">
			      	<label for="l_sown_area" class="col-sm-3 control-label">晚稻播种面积(亩)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="l_sown_area" value="-" readonly>
			      	</div>
			    </div>
			    
			    <div class="form-group">
			      	<label for="l_disaster_area" class="col-sm-3 control-label">晚稻受灾面积(亩)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="l_disaster_area" value="-" readonly>
			      	</div>
			    </div>
			    <div class="form-group">
			      	<label for="l_production" class="col-sm-3 control-label">晚稻产量(千公斤)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="l_production" value="-" readonly>
			      	</div>
			    </div>
			     <div class="form-group">
			      	<label for="l_market_price" class="col-sm-3 control-label">晚稻市场价格(元/公斤)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="l_market_price" value="-" readonly>
			      	</div>
			    </div>
			    <div class="form-group">
			      	<label for="l_purchase_price" class="col-sm-3 control-label">晚稻收购价格(元/公斤)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="l_purchase_price"  value="-" readonly>
			      	</div>
			    </div>
			    <div class="form-group">
			      	<label for="l_fertilizer_price" class="col-sm-3 control-label">晚稻化肥价格(元/百公斤)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="l_fertilizer_price"  value="-" readonly>
			      	</div>
			    </div>
			     
			    <div class="form-group">
			      	<div class="col-sm-offset-3 col-sm-10">
			        	<input class="btn btn-warning" disabled="disabled" value="信息尚未提交">
			     	</div>
			     	
			   	</div>
			    </form>

			<?php } else{ ?>
			    <form action="<?php echo U('Admin/Rice/checkRice'); ?>" method = "post" class="form-horizontal" role="form">
            	<input type="hidden" name="rice_kind" value="<?php echo 3; ?>">
			  	<input type="hidden" name="rice_id" value="<?php echo $ricedata['rice_id']; ?>">
            	<div class="form-group">
			     <label for="year" class="col-sm-3 control-label">年份(年)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="year"  value="<?php echo $ricedata['year'];?>" readonly>
			      	</div>
			   	</div>
            	<div class="form-group">
			      	<label for="l_sown_area" class="col-sm-3 control-label">晚稻播种面积(亩)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="l_sown_area"  value="<?php echo $ricedata['l_sown_area'];?>" readonly>
			      	</div>
			    </div>
			    
			    <div class="form-group">
			      	<label for="l_disaster_area" class="col-sm-3 control-label">晚稻受灾面积(亩)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="l_disaster_area"  value="<?php echo $ricedata['l_disaster_area'];?>" readonly>
			      	</div>
			    </div>
			    <div class="form-group">
			      	<label for="l_production" class="col-sm-3 control-label">晚稻产量(千公斤)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="l_production"   value="<?php echo $ricedata['l_production'];?>" readonly>
			      	</div>
			    </div>
			     <div class="form-group">
			      	<label for="l_market_price" class="col-sm-3 control-label">晚稻市场价格(元/公斤)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="l_market_price"   value="<?php echo $ricedata['l_market_price'];?>" readonly>
			      	</div>
			    </div>
			    <div class="form-group">
			      	<label for="l_purchase_price" class="col-sm-3 control-label">晚稻收购价格(元/公斤)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="l_purchase_price"    value="<?php echo $ricedata['l_purchase_price'];?>" readonly>
			      	</div>
			    </div>
			    <div class="form-group">
			      	<label for="l_fertilizer_price" class="col-sm-3 control-label">晚稻化肥价格(元/百公斤)：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="l_fertilizer_price"   value="<?php echo $ricedata['l_fertilizer_price'];?>" readonly>
			      	</div>
			    </div>
			     
			    <div class="form-group">
			      	<div class="col-sm-offset-3 col-sm-10">
			        	<?php if($ricedata['lrice_status']==2) { ?>
			        	<input type="submit" class="btn btn-info" value="通过">
			          	<input type="submit" name="failed" class="btn btn-warning" value="驳回">
			        	<?php } if($ricedata['lrice_status']==3||$ricedata['lrice_status']==4) { ?>
			        	<input class="btn btn-warning" disabled="disabled" value="信息已审核">
			        	<?php } ?>
			     	</div>
			   	</div>
			    </form>
			<?php } ?>
			</div>
            </div>
        </div> 
    </div>
	</body>
</html>