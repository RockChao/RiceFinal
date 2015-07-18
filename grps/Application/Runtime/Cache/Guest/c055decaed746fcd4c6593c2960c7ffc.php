<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<title>广东省市县稻谷预警系统</title>
		<link rel="stylesheet" type="text/css" href="/grps/Public/css/bootstrap.min.css"/>
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
							<a href="#"><i class="glyphicon glyphicon-home"></i>首页</a>
						</li>
						<li>
							<a href="<?php echo U('Guest/showInfo')?>"><i class="glyphicon glyphicon-user"></i>用户信息</a>
						</li>
						<li >
							<a href="<?php echo U('Disaster/manageDisaster')?>"><i class="glyphicon glyphicon-bell"></i>历史灾情</a>
						</li>
						<li>
							<a href="<?php echo U('Rice/manageRice')?>"><i class="glyphicon glyphicon-search"></i>水稻查询</a>
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
									<li><a href="/grps/index.php/Guest/Index/../Index/show?lati=<?php echo $v['dist_latitude']?>&long=<?php echo $v['dist_longitude']?>"><?php echo $v['dist_name'];?></a></li>
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
            <?php foreach ($ricedata as $key1 => $v): ?>
                <?php if ($v['dist_id'] == $value['dist_id'] && $v['year'] == $year) {?>
                    {did: "<?php echo $value['dist_id']?>", rid: "<?php echo $v['rice_id']?>",  pointX: "<?php echo $value['dist_longitude']?>" , pointY:"<?php echo $value['dist_latitude']?>", pointDangerPara:1, zoomPara: 10, dName:"<?php echo $value['dist_name']?>", dFarmArea:"<?php echo $v['agri_area']?>",population: "<?php echo $v['population']?>",agri_population: "<?php echo $v['agri_population']?>"},
                <?php } ?>
                    
                <?php endforeach; ?>        
        <?php endforeach; ?>
    ];

    //console.log(city);
    var pointNum =  city.length;
    var sContent = [];
    var infoWindow = [];
    for(var i=0; i<pointNum; i++){
        sContent[i] = "<h4>" + city[i].did + "</h4>";
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

    //地图缩放工具
    var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
    map.addControl(ctrl_nav); 

    //配置标记点信息
    function addMarkerPoint(cityregiondata){
        var _point = new BMap.Point(cityregiondata.pointX, cityregiondata.pointY);
        var _marker = new BMap.Marker(_point);
	
		
        var _sContent = "<span>区名/县名：</span>" + 
        "<span>" + cityregiondata.dName + "</span>" +
        "<br/><span>预警情况：</span>" + 
        "<span>" + cityregiondata.pointDangerPara + "</span><br/>" +
        "<span>耕地面积：</span>" + 
        "<span>" + cityregiondata.dFarmArea + "亩</span><br/>" + 
        "<span>人口：</span>" +
        "<span>" + cityregiondata.population + "万</span><br/>" +
        "<span>农业人口：</span>" +
        "<span>" + cityregiondata.agri_population + "万</span><br/>" +
        "<a class='btn btn-primary' target='_blank' role='button' href='/grps/index.php/Guest/Index/../Rice/detailRice?rice_id=" + cityregiondata.rid +"'>详情</a>";

        var _iw = new BMap.InfoWindow(_sContent);
        _marker.addEventListener("click", function(){
            this.openInfoWindow(_iw);
        });
        map.addOverlay(_marker);
    }
    map.enableScrollWheelZoom();
</script> 
				<script type="text/javascript" src="/grps/Public/js/bootstrap-dropdown.js"></script>
					<script type="text/javascript">
				        $(document).ready(function () {
				            $('.dropdown-toggle').dropdown();
				        });
				  </script>
			</div>
		</div>
	</body>
</html>