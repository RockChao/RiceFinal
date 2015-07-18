<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<title>广东省市县稻谷预警系统</title>
		<link rel="stylesheet" type="text/css" href="/grps/Public/css/bootstrap.min.css"/>
		<link rel="shortcut icon" href="/grps/Public/img/favicon.ico"/>
		<link rel="stylesheet" type="text/css" href="/grps/Public/css/style.css"/>
		<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=sz3vyauA5BRKbE0GNZ3wnGnX"></script>
		<script type="text/javascript" src="/grps/Public/js/jquery-1.7.2.min.js"></script>
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
                           				<li><a href="/grps/index.php/Admin/Index/../Index/show?lati=<?php echo $value['dist_latitude']?>&long=<?php echo $value['dist_longitude']?>"><?php echo $value['dist_name'];?></a></li>
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
                           				<li><a href="/grps/index.php/Admin/Index/../Index/show?lati=<?php echo $value['dist_latitude']?>&long=<?php echo $value['dist_longitude']?>"><?php echo $value['dist_name'];?></a></li>
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
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-3 col-md-2 sidebar">
					<ul class="nav nav-sidebar">
						<?php foreach ($citylist as $key => $value): ?>
							<li class="dropdown active">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">
									
									<?php  echo $value['dist_name'];?>
									<b class="caret"></b>
								</a>

							<ul class="dropdown-menu pull-right">
								<?php foreach ($distlist as $key1 => $v): ?>
								<?php if ($v['dist_belongto'] == $value['dist_id']) {?>
									<li><a href="/grps/index.php/Admin/Index/../Index/show?lati=<?php echo $v['dist_latitude']?>&long=<?php echo $v['dist_longitude']?>"><?php echo $v['dist_name'];?></a></li>
								<?php } ?>
									
								<?php endforeach; ?>
	                		</ul>
                		</li>
						<?php endforeach; ?>
					</ul>

				</div>
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2" id="allmap">
				</div>
				<script type="text/javascript">

    var map = new BMap.Map("allmap");
    //设置地图的中心位置
    var district = [
        <?php  $dist_longitude=session("dist_longitude"); $dist_latitude=session("dist_latitude"); $year = date('Y'); ?>
            {centerX: "<?php echo $dist_longitude; ?>" , centerY:"<?php echo $dist_latitude; ?>"},
    ];

    //配置区县窗口显示的信息
    var city = [
        <?php foreach ($distlist as $key => $value):?>
            <?php foreach ($distdata as $key1 => $v): ?>
                <?php if ($v['disa_dist'] == $value['dist_id']) {?>
                    {dist_id: "<?php echo $value['dist_id']?>", disa_id: "<?php echo $v['disa_id']?>",  pointX: "<?php echo $value['dist_longitude']?>" , pointY:"<?php echo $value['dist_latitude']?>", pointDangerPara:1, zoomPara: 10, dName:"<?php echo $value['dist_name']?>", disa_area:"<?php echo $v['disa_area']?>",disa_eloss:"<?php echo $v['disa_eloss']?>",disa_begindate:"<?php echo $v['disa_begindate']?>",disa_enddate: "<?php echo $v['disa_enddate']?>",disa_situ: "<?php echo $v['disa_situ']?>"},
                <?php } ?>
                    
                <?php endforeach; ?>        
        <?php endforeach; ?>
    ];

    //配置水稻标签显示的信息
    var waveCity = [
        <?php foreach ($distlist as $key => $value):?>
            <?php foreach ($wavedata as $key1 => $v): ?>
                <?php if ($v['dist_id'] == $value['dist_id']) {?>
                    {dist_id: "<?php echo $value['dist_id']?>", wave_id: "<?php echo $v['wave_id']?>",  pointX: "<?php echo $value['dist_longitude']?>" , pointY:"<?php echo $value['dist_latitude']?>", pointDangerPara:1, zoomPara: 10, dName:"<?php echo $value['dist_name']?>",level: "<?php echo $v['level']?>",wave_level: "<?php echo $v['wave_level']?>",rice_id: "<?php echo $v['rice_id']?>"},
                <?php } ?>
                    
                <?php endforeach; ?>        
        <?php endforeach; ?>
    ];

    //console.log(city);
    var pointNum =  city.length;
    var waveNum = waveCity.length;
    var sContent = [];
    var infoWindow = [];
    for(var i=0; i<pointNum; i++){
        sContent[i] = "<h4>" + city[i].dist_id + "</h4>";
        infoWindow[i] = new BMap.InfoWindow(sContent[i]);
    }
    //地图初始缩放比例
    var zoomPara = 13;

    //需要的是地图显示中心点，每个地区不一样
    var centerPoint = new BMap.Point(district[0].centerX, district[0].centerY);
    map.centerAndZoom(centerPoint, zoomPara);
    var markerPoint = [];
    var marker = [];
    for(var i=0; i<pointNum; i++){
        if(city[i]!=null){
            addMarkerPoint(city[i]);
        }
    }
    for(var i=0; i<waveNum; i++){
        if(waveCity[i]!=null){
            addRiceMarkerPoint(waveCity[i]);
        }
    }

    //地图缩放工具
    var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
    map.addControl(ctrl_nav); 

    //配置灾难标记点信息
    function addMarkerPoint(cityregiondata){
        var _point = new BMap.Point(cityregiondata.pointX, cityregiondata.pointY);
        var _marker = new BMap.Marker(_point);
	
		
        var _sContent = "<span>区名/县名：</span>" + 
        "<span>" + cityregiondata.dName + "</span>" +
        "<br/>" +
        "<span>起始日期：</span>" + 
        "<span>" + cityregiondata.disa_begindate + "</span><br/>" + 
        "<span>结束日期：</span>" +
        "<span>" + cityregiondata.disa_enddate + "</span><br/>" +
        "<span>灾情状况：</span>" +
        "<span>" + cityregiondata.disa_situ + "</span><br/>" +
        "<span>受灾面积：</span>" +
        "<span>" + cityregiondata.disa_area + "</span><br/>" +
        "<span>经济损失：</span>" +
        "<span>" + cityregiondata.disa_eloss + "</span><br/>" +
        "<a class='btn btn-primary'  role='button' href='/grps/index.php/Admin/Index/../Disaster/detailDisaster?disa_id=" + cityregiondata.disa_id +"'>详情</a>"+
        "<a class='btn btn-primary'  role='button' href='/grps/index.php/Admin/Index/../Disaster/checkDisaster?disa_id=" + cityregiondata.disa_id +"'>审核</a>";

        var _iw = new BMap.InfoWindow(_sContent);
        _marker.addEventListener("click", function(){
            this.openInfoWindow(_iw);
        });
        map.addOverlay(_marker);
    }

    //配置水稻预警标记点信息
    function addRiceMarkerPoint(cityregiondata){
        var icon = new BMap.Icon("Public\\img\\12.png", new BMap.Size(20, 32), {anchor: new BMap.Size(30, 40)});
        var _point = new BMap.Point(cityregiondata.pointX, cityregiondata.pointY);
        var _marker = new BMap.Marker(_point,{icon:icon});
    
        var _sContent = "<span>区名/县名：</span>" + 
        "<span>" + cityregiondata.dName + "</span>" +
        "<br/>" +
        "<span>预警等级：</span>" +
        "<span>" + cityregiondata.level + "</span><br/>" +
        "<a class='btn btn-primary'  role='button' href='/grps/index.php/Admin/Index/../Rice/detailWave?rice_id=" + cityregiondata.rice_id + "&wave_id=" + cityregiondata.wave_id +"'>详情</a>";

        var _iw = new BMap.InfoWindow(_sContent);
        _marker.addEventListener("click", function(){
            this.openInfoWindow(_iw);
        });
        map.addOverlay(_marker);
    }
    map.enableScrollWheelZoom();
</script> 

				<script type="text/javascript" src="/grps/Public/js/bootstrap-dropdown.js"></script>
					
			</div>
		</div>
	</body>
</html>