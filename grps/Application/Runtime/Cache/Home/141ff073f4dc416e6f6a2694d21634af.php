<?php if (!defined('THINK_PATH')) exit();?><html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<title>广东省市县稻谷预警系统</title>
		<link rel="stylesheet" type="text/css" href="/grps/Public/media/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="/grps/Public/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="/grps/Public/css/style.css"/>
		<script type="text/javascript" src="/grps/Public/js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="/grps/Public/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/grps/Public/js/bootstrap-dropdown.js"></script>
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
                    <li>
                        <a href="<?php echo U('User/showInfo'); ?>"><i class="glyphicon glyphicon-user"></i> 信息员资料</a>
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
                            <li><a href="<?php echo U('Rice/manageRice')?>"><i class="glyphicon glyphicon-search"></i> 水稻查询</a></li>
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
		
    <div class='container'>
        <div class="row">
            <div  class="col-md-4">
                <table class="table table-striped table-bordered">
                    <caption>基本信息</caption>
                    <tr>
                        <th>指标</th>
                        <th>单位</th>
                        <th>数据</th>
                    </tr>
                    <?php if($value['brice_status']==1) {?>
                    <tr>
                        <th>区县</th>
                        <th></th>
                        <th>-</th>
                    </tr>

                    <tr>
                        <th>年份</th>
                        <th>年</th>
                        <th>-</th>
                    </tr>

                    <tr>
                        <th>总人口</th>
                        <th>人</th>
                        <th>-</th>
                    </tr>

                    <tr>
                        <th>农业人口</th>
                        <th>人</th>
                        <th>-</th>
                    </tr>

                    <tr>
                        <th>耕地面积</th>
                        <th>亩</th>
                        <th>-</th>
                    </tr>

                    <tr>
                        <th>水田面积</th>
                        <th>亩</th>
                        <th>-</th>
                    </tr>

                    <tr>
                        <th>总播种面积</th>
                        <th>亩</th>
                        <th>-</th>
                    </tr>

                    <tr>
                        <th>区域面积</th>
                        <th>亩</th>
                        <th>-</th>
                    </tr>
                    <?php } else {?>

                    <tr>
                        <th>区县</th>
                        <th></th>
                        <th><?php echo $value['dist_name']?></th>
                    </tr>

                    <tr>
                        <th>年份</th>
                        <th>年</th>
                        <th><?php echo $value['year']?></th>
                    </tr>

                    <tr>
                        <th>总人口</th>
                        <th>人</th>
                        <th><?php echo $value['population']?></th>
                    </tr>

                    <tr>
                        <th>农业人口</th>
                        <th>人</th>
                        <th><?php echo $value['agri_population']?></th>
                    </tr>

                    <tr>
                        <th>耕地面积</th>
                        <th>亩</th>
                        <th><?php echo $value['agri_area']?></th>
                    </tr>

                    <tr>
                        <th>水田面积</th>
                        <th>亩</th>
                        <th><?php echo $value['field_area']?></th>
                    </tr>

                    <tr>
                        <th>总播种面积</th>
                        <th>亩</th>
                        <th><?php echo $value['total_sown_area']?></th>
                    </tr>

                    <tr>
                        <th>区域面积</th>
                        <th>亩</th>
                        <th><?php echo $value['zone_area']?></th>
                    </tr>
                    <?php } ?>
                </table>
            </div>


            <div  class="col-md-4">
                <table class="table table-striped table-bordered">
                    <caption>早稻信息</caption>
                    <tr>
                        <th>指标</th>
                        <th>单位</th>
                        <th>数据</th>
                    </tr>
                    <?php if($value['erice_status']==1){ ?>
                    <tr>
                        <th>早稻播种面积</th>
                        <th>亩</th>
                        <th>-</th>
                    </tr>

                    <tr>
                        <th>早稻受灾面积</th>
                        <th>亩</th>
                        <th>-</th>
                    </tr>

                    <tr>
                        <th>早稻产量</th>
                        <th>千公斤</th>
                        <th>-</th>
                    </tr>

                    <tr>
                        <th>早稻市场价格</th>
                        <th>元/公斤</th>
                        <th>-</th>
                    </tr>

                    <tr>
                        <th>早稻收购价格</th>
                        <th>元/公斤</th>
                        <th>-</th>
                    </tr>

                    <tr>
                        <th>早稻化肥价格</th>
                        <th>百公斤/元</th>
                        <th>-</th>
                    </tr>

                    <?php } else { ?>
                    <tr>
                        <th>早稻播种面积</th>
                        <th>亩</th>
                        <th><?php echo $value['e_sown_area']?></th>
                    </tr>

                    <tr>
                        <th>早稻受灾面积</th>
                        <th>亩</th>
                        <th><?php echo $value['e_disaster_area']?></th>
                    </tr>

                    <tr>
                        <th>早稻产量</th>
                        <th>千公斤</th>
                        <th><?php echo $value['e_production']?></th>
                    </tr>

                    <tr>
                        <th>早稻市场价格</th>
                        <th>元/公斤</th>
                        <th><?php echo $value['e_market_price']?></th>
                    </tr>

                    <tr>
                        <th>早稻收购价格</th>
                        <th>元/公斤</th>
                        <th><?php echo $value['e_purchase_price']?></th>
                    </tr>

                    <tr>
                        <th>早稻化肥价格</th>
                        <th>百公斤/元</th>
                        <th><?php echo $value['e_fertilizer_price']?></th>
                    </tr>
                    <?php } ?>
                    
                    </table>
                </div>


                <div  class="col-md-4">
                    <table class="table table-striped table-bordered">
                    <caption>晚稻信息</caption>
                    <tr>
                        <th>指标</th>
                        <th>单位</th>
                        <th>数据</th>
                    </tr>
                    <?php if($value['lrice_status']==1){?>
                    <tr>
                        <th>晚稻播种面积</th>
                        <th>亩</th>
                        <th>-</th>
                    </tr>

                    <tr>
                        <th>晚稻受灾面积</th>
                        <th>亩</th>
                        <th>-</th>
                    </tr>

                    <tr>
                        <th>晚稻产量</th>
                        <th>千公斤</th>
                        <th>-</th>
                    </tr>

                    <tr>
                        <th>晚稻市场价格</th>
                        <th>元/公斤</th>
                        <th>-</th>
                    </tr>

                    <tr>
                        <th>晚稻收购价格</th>
                        <th>元/公斤</th>
                        <th>-</th>
                    </tr>

                    <tr>
                        <th>晚稻化肥价格</th>
                        <th>百公斤/元</th>
                        <th>-</th>
                    </tr>
                    
                <?php } else {?>
                    <tr>
                        <th>晚稻播种面积</th>
                        <th>亩</th>
                        <th><?php echo $value['l_sown_area']?></th>
                    </tr>


                    <tr>
                        <th>晚稻受灾面积</th>
                        <th>亩</th>
                        <th><?php echo $value['l_disaster_area']?></th>
                    </tr>

                    <tr>
                        <th>晚稻产量</th>
                        <th>千公斤</th>
                        <th><?php echo $value['l_production']?></th>
                    </tr>

                    <tr>
                        <th>晚稻市场价格</th>
                        <th>元/公斤</th>
                        <th><?php echo $value['l_market_price']?></th>
                    </tr>

                    <tr>
                        <th>晚稻收购价格</th>
                        <th>元/公斤</th>
                        <th><?php echo $value['l_purchase_price']?></th>
                    </tr>

                    <tr>
                        <th>晚稻化肥价格</th>
                        <th>百公斤/元</th>
                        <th><?php echo $value['l_fertilizer_price']?></th>
                    </tr>
                    <?php } ?>
                    </table>
                </div>
            </div>
        </div>
	</body>
</html>