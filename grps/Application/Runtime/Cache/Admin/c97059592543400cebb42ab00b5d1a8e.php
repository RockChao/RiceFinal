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
		<link rel="stylesheet" type="text/css" href="/grps/Public/css/bootstrap-datetimepicker.min.css"/>

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
                            		<li><a href="<?php echo U('Disaster/manageDisaster')?>"><i class="glyphicon glyphicon-search"></i> 灾情查看</a></li> 
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

		<div class="add1">
			<form action="<?php echo U('Disaster/updateDisaster'); ?>" method = "post" class="form-horizontal" role="form">
				<div class="form-group">
			      	<label class="col-sm-2 control-label">受灾地区：</label>
			      	<div class="input-group col-sm-3">
			         	<input type="text" class="form-control" name="disa_dist" 
			            	value="<?php echo $disadata['disa_dist'];?>" readonly>
			      	</div>
			   	</div>
				<div class="form-group">
			      	<label class="col-sm-2 control-label">起始时间：</label>
                	<div class="input-group date form_date col-sm-3" data-date-format="yyyy-mm-dd">
                    <input class="form-control" type="text" name="disa_begindate" value="<?php echo $disadata['disa_begindate'];?>" readonly>
					<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
					</span>
               		</div>
            	</div>

            	<div class="form-group">
			      	<label class="col-sm-2 control-label">结束时间：</label>
                	<div class="input-group date form_date col-sm-3" data-date-format="yyyy-mm-dd">
                    <input class="form-control" type="text" name="disa_enddate" value="<?php echo $disadata['disa_enddate'];?>" readonly>
					<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
					</span>
                	</div>
            	</div>

				<div class="form-group">
			      	<label class="col-sm-2 control-label">受灾原因：</label>
			      	<div class="input-group col-sm-3">
			      		<select class="selectpicker" id='sel' name="disa_situ">   	
			      		<option value="<?php  echo 1; ?>">台风</option>
			      		<option value="<?php  echo 2; ?>">干旱</option>
			      		<option value="<?php  echo 3; ?>">洪水</option>
			      		<option value="<?php  echo 4; ?>">病虫害</option>
			      		<option value="<?php  echo 5; ?>">其他</option>
			         	</select>
			         	
			      	</div>
			   	</div>

			   	<div class="form-group">
			      	<label class="col-sm-2 control-label">受灾面积(亩)：</label>
			      	<div class="input-group col-sm-3">
			         	<input type="text" class="form-control" name="disa_area" 
			            	value="<?php echo $disadata['disa_area'];?>" >
			      	</div>
			   	</div>
			   	
			   	<div class="form-group">
			      	<label class="col-sm-2 control-label">经济损失(元)：</label>
			      	<div class="input-group col-sm-3">
			         	<input type="text" class="form-control" name="disa_eloss" 
			            	value="<?php echo $disadata['disa_eloss'];?>" >
			      	</div>
			    </div>

			     <input type="hidden" name="disa_id" value="<?php echo $disadata['disa_id'];?>">
			     
			    <div class="form-group">
			      	<div class="input-group col-sm-offset-2 col-sm-10">
			         	<button type="submit" class="btn btn-info">提交</button>
			     	</div>
			   	</div>
			</form>
		</div>
		<script type="text/javascript" src="/grps/Public/js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="/grps/Public/js/bootstrap-dropdown.js"></script>
		<script type="text/javascript" src="/grps/Public/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/grps/Public/js/bootstrap-datetimepicker.js"></script>
		<script type="text/javascript" src="/grps/Public/js/bootstrap-datetimepicker.zh-CN.js" ></script>
		<script type="text/javascript">
		$('.form_date').datetimepicker({
     	  		language:  'zh-CN',
     	    	weekStart: 1,
        		todayBtn:  1,
				autoclose: 1,
				todayHighlight: 1,
				startView: 2,
				minView: 2,
				forceParse: 0
   		});

   		</script>
   		<script>

			function selectValue(sId,value){
    			var s = document.getElementById(sId);

    			var ops = s.options;
    			for(var i=0;i<ops.length; i++){
					var tempValue = ops[i].value;
					if(tempValue == value)
					{
						ops[i].selected = true;

					}
    			}
			}
			selectValue('sel',<?php echo $disadata['disa_situ'];?>);
  		</script>
   	</body>
</html>