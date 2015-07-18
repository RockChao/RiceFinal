<?php if (!defined('THINK_PATH')) exit();?><html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<title>广东省市县稻谷预警系统</title>
		<link rel="stylesheet" type="text/css" href="/grps/Public/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="/grps/Public/css/style.css"/>
		<link rel="stylesheet" type="text/css" href="/grps/Public/css/style2.css"/>
		<link rel="stylesheet" type="text/css" href="/grps/Public/css/demo.css"/>
		<link rel="shortcut icon" href="/grps/Public/img/favicon.ico"/>
		<script type="text/javascript" src="/grps/Public/js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="/grps/Public/js/bootstrap-dropdown.js"></script>
			<script type="text/javascript" >
			function ChangeSelect(city_id){
				var obj = document.getElementById("user_region");
				obj.options.length = 0;
				<?php foreach($distlist as $key => $value ): ?>
				if (city_id == <?php  echo $value['dist_belongto']; ?>){
					t =" <?php  echo $value['dist_name']; ?> ";
				    v = "<?php  echo $value['dist_id']; ?>";		  
					obj.options.add(new Option(t,v));				
				}
				<?php  endforeach; ?>		
			}
			</script>
			<script type="text/javascript">
        		$(document).ready(function() {
            	$("#signup").click(function() {

                resetFields();
                var emptyfields = $("input[value=]");
                if (emptyfields.size() > 0) {
                    emptyfields.each(function() {
                        $(this).stop()
                            .animate({ left: "-10px" }, 100).animate({ left: "10px" }, 100)
                            .animate({ left: "-10px" }, 100).animate({ left: "10px" }, 100)
                            .animate({ left: "0px" }, 100)
                            .addClass("required");
                    });
                }
            });
        });
        function resetFields() {
            $("input[type=text], input[type=password]").removeClass("required");
        }
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

						<li class="dropdown active" id="accountmenu">
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
							<li class="dropdown" id="accountmenu">
                        	<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-list"></i> 水稻管理<b class="caret"></b></a>
                        		<ul class="dropdown-menu">
                           			<li><a href="<?php echo U('Rice/uncheckRice')?>"><i class="glyphicon glyphicon-ok"></i> 水稻审核</a></li>
                            		<li><a href="<?php echo U('Rice/manageRice')?>"><i class="glyphicon glyphicon-search"></i> 水稻查看</a></li> 
                        		</ul>
                    		</li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
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
			<form action="/grps/index.php/Admin/User/../User/addUser" method = "post" class="form-horizontal" id="userform" role="form">
			   	<div class="form-group">
			      	<label for="username" class="col-sm-2 control-label">用户名：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="user_name" 
			            	placeholder="请输入用户名" id="user_name" ajaxurl="<?php  echo U('User/checkName'); ?>">
			      	</div>
			      	<div><div class="Validform_checktip">用户名为4~20个字符</div></div>
			   	</div>
			  	<div class="form-group">
			      	<label for="password" class="col-sm-2 control-label">密码：</label>
			      	<div class="col-sm-3">
			         	<input type="password" class="form-control" name="user_pw" id="user_pw"
			            	placeholder="请输入密码" plugin="passwordStrength">
			      	</div>
			      	<div>
			      		<div class="Validform_checktip">密码长度必须为6~16位</div>
			      		<div class="passwordStrength" style="display:none;"><b>密码强度：</b> <span>弱</span><span>中</span><span class="last">强</span></div>
			      	</div>
			   	</div>
			   	<div class="form-group">
			      	<label for="password" class="col-sm-2 control-label">确认密码：</label>
			      	<div class="col-sm-3">
			         	<input type="password" class="form-control" name="user_repw" id="user_repw"
			            	placeholder="请确认密码">
			      	</div>
			      	<div><div class="Validform_checktip">确认密码必须与密码相同</div></div>
			   	</div>
			   	<div class="form-group">
			      	<label for="region" class="col-sm-2 control-label">区县：</label>
			      	<div class="col-sm-3">
			      		
			      		<select  onChange="ChangeSelect(this.value);">
			      			<option >城市</option>     			
			         	<?php  foreach($citylist as $key => $value): ?>         	
			         			<option  value="<?php  echo $value['dist_id']; ?>">
			         				<?php  echo $value['dist_name']; ?></option>		         			
			         	<?php  endforeach; ?>
			         	</select>
			         	
			         	<select name="user_region" id="user_region" >
			         		<option  >区县</option>
			         	</select>
			         	
			      	</div>
			   	</div>
			   	<div class="form-group">
			      	<label for="phone" class="col-sm-2 control-label">电话：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="user_phone" id="user_phone"
			            	placeholder="请输入电话" ajaxurl="<?php  echo U('User/checkPhone'); ?>">
			      	</div>
			      	<div><div class="Validform_checktip">手机号长度必须为1~11位</div></div>
			    </div>
			    <div class="form-group">
			      	<label for="email" class="col-sm-2 control-label">邮件：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="user_email" id="user_email"
			            	placeholder="请输入邮件" ajaxurl="<?php  echo U('User/checkEmail'); ?>">
			      	</div>
			      	<div><div class="Validform_checktip">邮箱长度必须为1~50个字符</div></div>
			    </div>
			    <div class="form-group">
			      	<label for="address" class="col-sm-2 control-label">地址：</label>
			      	<div class="col-sm-3">
			         	<input type="text" class="form-control" name="user_address" id="user_address"
			            	placeholder="请输入地址">
			      	</div>
			      	<div><div class="Validform_checktip">地址必须提供</div></div>
			    </div>
			    <div class="form-group">
			      	<div class="col-sm-offset-2 col-sm-10" id="signup">
			         	<input type="submit" class="btn btn-info" value="添加">
			     	</div>
			   	</div>
			</form>
		</div>
	</body>
	<script type="text/javascript" src="/grps/Public/js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="/grps/Public/js/Validform_v5.3.2.js"></script>
	<script type="text/javascript" src="/grps/Public/js/passwordStrength-min.js"></script>
	<script type="text/javascript">
	var demo = null;
	$(function(){
	        demo = $("#userform").Validform({
	        tiptype:2,
	        label:".label",
	        showAllError:true,
	        datatype:{
	            "zh1-6":/^[\u4E00-\u9FA5\uf900-\ufa2d]{1,6}$/
	        },
	        ajaxPost:true,
	        callback:function(data){
	        	alert(data.info);
	        	if (data.status == "y") {
	        		demo.resetForm();
	        	}
	        },
	        usePlugin:{
				passwordstrength:{
					minLen:6,//设置密码长度最小值，默认为0;
					maxLen:16,//设置密码长度最大值，默认为30;
					trigger:function(obj,error){
						//该表单元素的keyup和blur事件会触发该函数的执行;
						//obj:当前表单元素jquery对象;
						//error:所设密码是否符合验证要求，验证不能通过error为true，验证通过则为false;
						
						//console.log(error);
						if(error){
							obj.parent().next().find(".Validform_checktip").show();
							obj.parent().next().find(".passwordStrength").hide();
						}else{
							obj.parent().next().find(".Validform_checktip").hide();
							obj.parent().next().find(".passwordStrength").show();	
						}
					}
				}
			}
	    });
	    //demo.tipmsg.w["zh1-6"]="请输入1到6个中文字符！";

	    demo.addRule([{
	        ele:"#user_name", ////ele:"#name",
	        datatype:"s4-10",
	        errormsg:"用户名至少4个字符,最多20个字符！",
	        nullmsg:"用户名不能为空！"
	    },
	    {
	    	ele:"#user_pw",
	    	datatype:"*6-16",
	    	nullmsg:"密码必须提供",
	    	errormsg:"密码长度必须为6~16位"
	    },
	    {
	    	ele:"#user_repw",
	    	datatype:"*",
	    	nullmsg:"确认密码必须提供",
	    	recheck:"user_pw",
	    	errormsg:"两次密码输入不相同"
	    },
	    {
	    	ele:"#user_email",
	    	datatype:"e",
	    	nullmsg:"邮箱必须提供",
	    	errormsg:"请输入正确的邮箱"
	    },
	    {
	    	ele:"#user_phone",
	    	datatype:"n1-11",
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
</html>