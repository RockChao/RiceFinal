<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
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
					<a class="navbar-brand" href="#">广东省市县稻谷预警系统</a>
				</div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-left">
						<li class="active">
							<a href="#" ><i class="glyphicon glyphicon-home"></i> 首页</a>
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
    <div class='container'>
    	<div class='tabbable'>
    		<ul class='nav nav-tabs'>
            	<li class='active'><a href='#tab1' data-toggle='tab'>基本信息提交</a></li>
            	<li><a href='#tab2' data-toggle='tab'>早稻信息提交</a></li>
            	<li><a href='#tab3' data-toggle='tab'>晚稻信息提交</a></li>
        	</ul>
	       <div class='tab-content'>
	            <div class='tab-pane active' id='tab1'>
	            <div class="add">
	            	<form action="<?php echo U('Rice/addRice'); ?>" id="briceform" method = "post" class="form-horizontal" id="1" role="form">
					<input type="hidden" name="rice_kind" value="<?php echo 1; ?>">
				  	<div class="form-group">
				      	<label for="year" class="col-sm-3 control-label"><span class="need">*</span>年份(年)：</label>
				      	<div class="col-sm-3">
				         	<input type="text" class="form-control" name="year" id="year"
				            	placeholder="请输入年份">
				      	</div>
				      	<div><div class="Validform_checktip"></div></div>
				   	</div>
				   	
				   	<div class="form-group">
				      	<label for="population" class="col-sm-3 control-label"><span class="need">*</span>总人口(人)：</label>
				      	<div class="col-sm-3">
				         	<input type="text" class="form-control" name="population" id="population"
				            	placeholder="请确认总人口">
				      	</div>
				      	<div><div class="Validform_checktip"></div></div>
				   	</div>
				   	<div class="form-group">
				      	<label for="agri_population" class="col-sm-3 control-label"><span class="need">*</span>农业人口(人)：</label>
				      	<div class="col-sm-3">
				         	<input type="text" class="form-control" name="agri_population" id="agri_population"
				            	placeholder="请确认农业人口">
				      	</div>
				      	<div><div class="Validform_checktip"></div></div>
				   	</div>
				   	<div class="form-group">
				      	<label for="zone_area" class="col-sm-3 control-label"><span class="need">*</span>区域面积(亩)：</label>
				      	<div class="col-sm-3">
				         	<input type="text" class="form-control" name="zone_area" id="zone_area"
				            	placeholder="请确认区域面积">
				      	</div>
				      	<div><div class="Validform_checktip"></div></div>
				   	</div>
				   	<div class="form-group">
				      	<label for="region" class="col-sm-3 control-label"><span class="need">*</span>耕地面积(亩)：</label>
				      	<div class="col-sm-3">
				         	<input type="text" class="form-control" name="agri_area" id="agri_area"
				            	placeholder="请输入耕地面积">
				      	</div>
				      	<div><div class="Validform_checktip"></div></div>
				   	</div>
				   	<div class="form-group">
				      	<label for="field_area" class="col-sm-3 control-label"><span class="need">*</span>水稻种植面积(亩)：</label>
				      	<div class="col-sm-3">
				         	<input type="text" class="form-control" name="field_area" id="field_area"
				            	placeholder="请输入水稻种植面积">
				      	</div>
				      	<div><div class="Validform_checktip"></div></div>
				    </div>
				    <div class="form-group">
				      	<label for="total_sown_area" class="col-sm-3 control-label"><span class="need">*</span>总播种面积(亩)：</label>
				      	<div class="col-sm-3">
				         	<input type="text" class="form-control" name="total_sown_area" id="total_sown_area"
				            	placeholder="请输入总播种面积">
				      	</div>
				      	<div><div class="Validform_checktip"></div></div>
				    </div>
				    <div class="form-group">
				      	<div class="col-sm-offset-3 col-sm-10">
				         	<button type="submit" class="btn btn-info">提交</button>
				     	</div>
				   	</div>
				    </form>
				</div>
	            </div>

	            <div class='tab-pane' id='tab2'>
	            <div class="add">
	            	<form action="<?php echo U('Rice/addRice'); ?>" method = "post" id="ericeform"  class="form-horizontal" id="2" role="form">
	            	<input type="hidden" name="rice_kind" value="<?php echo 2; ?>">
	            	<div class="form-group">
				      	<label for="year" class="col-sm-3 control-label"><span class="need">*</span>年份(年)：</label>
				      	<div class="col-sm-3">
				         	<input type="text" class="form-control" name="year" id="year"
				            	placeholder="请输入年份">
				      	</div>
				      	<div><div class="Validform_checktip"></div></div>
				   	</div>
	            	<div class="form-group">
				      	<label for="e_sown_area" class="col-sm-3 control-label"><span class="need">*</span>早稻播种面积(亩)：</label>
				      	<div class="col-sm-3">
				         	<input type="text" class="form-control" name="e_sown_area" id="e_sown_area"
				            	placeholder="请输入早稻播种面积">
				      	</div>
				      	<div><div class="Validform_checktip"></div></div>
				    </div>			   
				    <div class="form-group">
				      	<label for="addree_disaster_area" class="col-sm-3 control-label"><span class="need">*</span>早稻受灾面积(亩)：</label>
				      	<div class="col-sm-3">
				         	<input type="text" class="form-control" name="e_disaster_area" id="e_disaster_area"
				            	placeholder="请输入早稻受灾面积">
				      	</div>
				      	<div><div class="Validform_checktip"></div></div>
				    </div>
				    <div class="form-group">
				      	<label for="e_production" class="col-sm-3 control-label"><span class="need">*</span>早稻产量(千公斤)：</label>
				      	<div class="col-sm-3">
				         	<input type="text" class="form-control" name="e_production" id="e_production"
				            	placeholder="请输入早稻产量">
				      	</div>
				      	<div><div class="Validform_checktip"></div></div>
				    </div>
				     <div class="form-group">
				      	<label for="e_market_price" class="col-sm-3 control-label"><span class="need">*</span>早稻市场价格(元/公斤)：</label>
				      	<div class="col-sm-3">
				         	<input type="text" class="form-control" name="e_market_price" id="e_market_price"
				            	placeholder="请输入早稻市场价格">
				      	</div>
				      	<div><div class="Validform_checktip"></div></div>
				    </div>
				    <div class="form-group">
				      	<label for="e_purchase_price" class="col-sm-3 control-label"><span class="need">*</span>早稻收购价格(元/公斤)：</label>
				      	<div class="col-sm-3">
				         	<input type="text" class="form-control" name="e_purchase_price" id="e_purchase_price"
				            	placeholder="请输入早稻收购价格">
				      	</div>
				      	<div><div class="Validform_checktip"></div></div>
				    </div>
				    <div class="form-group">
				      	<label for="e_fertilizer_price" class="col-sm-3 control-label"><span class="need">*</span>早稻化肥价格(元/百公斤)：</label>
				      	<div class="col-sm-3">
				         	<input type="text" class="form-control" name="e_fertilizer_price" id="e_fertilizer_price"
				            	placeholder="请输入早稻化肥价格">
				      	</div>
				      	<div><div class="Validform_checktip"></div></div>
				    </div>
				    <div class="form-group">
				      	<div class="col-sm-offset-3 col-sm-10">
				         	<button type="submit" class="btn btn-info">提交</button>
				     	</div>
				   	</div>
				    </form>
				</div>
	            </div>
	            
	            <div class='tab-pane' id='tab3'>
	            <div class="add">
	            	<form action="<?php echo U('Rice/addRice'); ?>" method="post" id="lriceform" class="form-horizontal" id="3">
	            	<input type="hidden" name="rice_kind" value="<?php echo 3; ?>">
	            	<div class="form-group">
				      	<label for="year" class="col-sm-3 control-label"><span class="need">*</span>年份(年)：</label>
				      	<div class="col-sm-3">
				         	<input type="text" class="form-control" name="year" id="year"
				            	placeholder="请输入年份">
				      	</div>
				      	<div><div class="Validform_checktip"></div></div>
				   	</div>
	            	<div class="form-group">
				      	<label for="l_sown_area" class="col-sm-3 control-label"><span class="need">*</span>晚稻播种面积(亩)：</label>
				      	<div class="col-sm-3">
				         	<input type="text" class="form-control" name="l_sown_area" id="l_sown_area"
				            	placeholder="请输入晚稻播种面积">
				      	</div>
				      	<div><div class="Validform_checktip"></div></div>
				    </div>
				    <div class="form-group">
				      	<label for="l_disaster_area" class="col-sm-3 control-label"><span class="need">*</span>晚稻受灾面积(亩)：</label>
				      	<div class="col-sm-3">
				         	<input type="text" class="form-control" name="l_disaster_area" id="l_disaster_area"
				            	placeholder="请输入晚稻受灾面积">
				      	</div>
				      	<div><div class="Validform_checktip"></div></div>
				    </div>
				    <div class="form-group">
				      	<label for="l_production" class="col-sm-3 control-label"><span class="need">*</span>晚稻产量(千公斤)：</label>
				      	<div class="col-sm-3">
				         	<input type="text" class="form-control" name="l_production" id="l_production"
				            	placeholder="请输入晚稻产量">
				      	</div>
				      	<div><div class="Validform_checktip"></div></div>
				    </div>
				     <div class="form-group">
				      	<label for="l_market_price" class="col-sm-3 control-label"><span class="need">*</span>晚稻市场价格(元/公斤)：</label>
				      	<div class="col-sm-3">
				         	<input type="text" class="form-control" name="l_market_price" id="l_market_price"
				            	placeholder="请输入晚稻市场价格">
				      	</div>
				      	<div><div class="Validform_checktip"></div></div>
				    </div>
				    <div class="form-group">
				      	<label for="l_purchase_price" class="col-sm-3 control-label"><span class="need">*</span>晚稻收购价格(元/公斤)：</label>
				      	<div class="col-sm-3">
				         	<input type="text" class="form-control" name="l_purchase_price" id="l_purchase_price"
				            	placeholder="请输入晚稻收购价格">
				      	</div>
				      	<div><div class="Validform_checktip"></div></div>
				    </div>
				    <div class="form-group">
				      	<label for="l_fertilizer_price" class="col-sm-3 control-label"><span class="need">*</span>晚稻化肥价格(元/百公斤)：</label>
				      	<div class="col-sm-3">
				         	<input type="text" class="form-control" name="l_fertilizer_price" id="l_fertilizer_price"
				            	placeholder="请输入晚稻化肥价格">
				      	</div>
				      	<div><div class="Validform_checktip"></div></div>
				    </div>
				    <div class="form-group">
				      	<div class="col-sm-offset-3 col-sm-10">
				         	<button type="submit" class="btn btn-info">提交</button>
				     	</div>
				   	</div>
				    </form>
				</div>
	            </div>
	        </div> 
    	</div>
	</div>
    <script type="text/javascript" src="/grps/Public/js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="/grps/Public/js/bootstrap-dropdown.js"></script>
	<script type="text/javascript" src="/grps/Public/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/grps/Public/js/Validform_v5.3.2.js"></script>
    <script type="text/javascript" src="/grps/Public/js/ricecheck.js"></script>
	</body>
</html>