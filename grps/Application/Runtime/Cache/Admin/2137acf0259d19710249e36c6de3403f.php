<?php if (!defined('THINK_PATH')) exit();?><html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<title>广东省市县稻谷预警系统</title>
		<link rel="stylesheet" type="text/css" href="/grps/Public/media/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="/grps/Public/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="/grps/Public/css/style.css"/>
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
                    <li class='active'><a href='#tab1' data-toggle='tab'>基本指标</a></li>
                    <li><a href='#tab2' data-toggle='tab'>年水稻分析指标</a></li>
                    <li><a href='#tab3' data-toggle='tab'>早稻分析指标</a></li>
                    <li><a href='#tab4' data-toggle='tab'>晚稻分析指标</a></li>
                    <li><a href='#tab5' data-toggle='tab'>预警指标</a></li>
                </ul>
                <div class='tab-content'>
                    <div class='tab-pane' id='tab3'>
                        <table class="table table-striped table-bordered">
                            <caption>早稻分析指标</caption>
                            <tr>
                                <th>指标</th>
                                <th>单位</th>
                                <th>数据</th>
                            </tr>

                            <?php if($ricedata['erice_status']==1){ ?>
                            <tr>
                                <th>早稻亩产水平</th>
                                <th>公斤/亩</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>早稻播种结构</th>
                                <th>%</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>早稻面积受灾率</th>
                                <th>%</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>早稻应该产量</th>
                                <th>千公斤</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>早稻实际产量</th>
                                <th>千公斤</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>早稻产量受灾率</th>
                                <th>%</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>早稻播种面积潜力产量</th>
                                <th>千公斤</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>早稻稻肥比价</th>
                                <th>%</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>早稻亩产潜力产量</th>
                                <th>千公斤</th>
                                <th>-</th>
                            </tr>
                            

                            <?php } else { ?>
                            <tr>
                                <th>早稻亩产水平</th>
                                <th>公斤/亩</th>
                                <th><?php echo $ricedata['ae_yield_permu']?></th>
                            </tr>
                            <tr>
                                <th>早稻播种结构</th>
                                <th>%</th>
                                <th><?php echo $ricedata['ae_planting_stru']?></th>
                            </tr>
                            <tr>
                                <th>早稻面积受灾率</th>
                                <th>%</th>
                                <th><?php echo $ricedata['ae_area_disasterr']?></th>
                            </tr>
                            <tr>
                                <th>早稻应该产量</th>
                                <th>千公斤</th>
                                <th><?php echo $ricedata['ae_suppose_yield']?></th>
                            </tr>
                            <tr>
                                <th>早稻实际产量</th>
                                <th>千公斤</th>
                                <th><?php echo $ricedata['ae_actual_yield']?></th>
                            </tr>
                            <tr>
                                <th>早稻产量受灾率</th>
                                <th>%</th>
                                <th><?php echo $ricedata['ae_yield_disasterr']?></th>
                            </tr>
                            <tr>
                                <th>早稻播种面积潜力产量</th>
                                <th>千公斤</th>
                                <th><?php echo $ricedata['ae_potential_yield_sownaera']?></th>
                            </tr>
                            <tr>
                                <th>早稻稻肥比价</th>
                                <th>%</th>
                                <th><?php echo $ricedata['ae_rice_fertilizer']?></th>
                            </tr>
                            <tr>
                                <th>早稻亩产潜力产量</th>
                                <th>千公斤</th>
                                <th><?php echo $ricedata['ae_potential_yield_permu']?></th>
                            </tr>
                           
                            <?php } ?>
                        </table>
                    </div>

                
                    <div class='tab-pane' id='tab4'>
                        <table class="table table-striped table-bordered">
                            <caption>晚稻分析指标</caption>
                            <tr>
                                <th>指标</th>
                                <th>单位</th>
                                <th>数据</th>
                            </tr>
                            <?php if($ricedata['lrice_status']==1){　?>
                            <tr>
                                <th>晚稻亩产水平</th>
                                <th>公斤/亩</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>晚稻播种结构</th>
                                <th>%</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>晚稻面积受灾率</th>
                                <th>%</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>晚稻应该产量</th>
                                <th>千公斤</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>晚稻实际产量</th>
                                <th>千公斤</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>晚稻产量受灾率</th>
                                <th>%</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>晚稻播种面积潜力产量</th>
                                <th>千公斤</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>晚稻稻肥比价</th>
                                <th>%</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>晚稻亩产潜力产量</th>
                                <th>千公斤</th>
                                <th>-</th>
                            </tr>   
                            
                            <?php } else { ?>
                                <tr>
                                    <th>晚稻亩产水平</th>
                                    <th>公斤/亩</th>
                                <th><?php echo $ricedata['al_yield_permu']?></th>
                            </tr>
                            <tr>
                                <th>晚稻播种结构</th>
                                <th>%</th>
                                <th><?php echo $ricedata['al_planting_stru']?></th>
                            </tr>
                            <tr>
                                <th>晚稻面积受灾率</th>
                                <th>%</th>
                                <th><?php echo $ricedata['al_area_disasterr']?></th>
                            </tr>
                            <tr>
                                <th>晚稻应该产量</th>
                                <th>千公斤</th>
                                <th><?php echo $ricedata['al_suppose_yield']?></th>
                            </tr>
                            <tr>
                                <th>晚稻实际产量</th>
                                <th>千公斤</th>
                                <th><?php echo $ricedata['al_actual_yield']?></th>
                            </tr>
                            <tr>
                                <th>晚稻产量受灾率</th>
                                <th>%</th>
                                <th><?php echo $ricedata['al_yield_disasterr']?></th>
                            </tr>
                            <tr>
                                <th>晚稻播种面积潜力产量</th>
                                <th>千公斤</th>
                                <th><?php echo $ricedata['al_potential_yield_sownaera']?></th>
                            </tr>
                            <tr>
                                <th>晚稻稻肥比价</th>
                                <th>%</th>
                                <th><?php echo $ricedata['al_rice_fertilizer']?></th>
                            </tr>
                            <tr>
                                <th>晚稻亩产潜力产量</th>
                                <th>千公斤</th>
                                <th><?php echo $ricedata['al_potential_yield_permu']?></th>
                            </tr>
                          

                        <?php } ?>
                        </table>
        			</div>
        			

                    <div class='tab-pane active' id='tab1'>
                        <div class="row">
                            <div  class="col-md-4">
                                <table class="table table-striped table-bordered">
                                <caption>基本信息</caption>
                                <tr>
                                    <th>指标</th>
                                    <th>单位</th>
                                    <th>数据</th>
                                </tr>
                                <?php if($ricedata['brice_status']==1) {?>
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
                                    <th><?php echo $ricedata['dist_name']?></th>
                                </tr>

                                <tr>
                                    <th>年份</th>
                                    <th>年</th>
                                    <th><?php echo $ricedata['year']?></th>
                                </tr>

                                <tr>
                                    <th>总人口</th>
                                    <th>人</th>
                                    <th><?php echo $ricedata['population']?></th>
                                </tr>

                                <tr>
                                    <th>农业人口</th>
                                    <th>人</th>
                                    <th><?php echo $ricedata['agri_population']?></th>
                                </tr>

                                <tr>
                                    <th>耕地面积</th>
                                    <th>亩</th>
                                    <th><?php echo $ricedata['agri_area']?></th>
                                </tr>

                                <tr>
                                    <th>水田面积</th>
                                    <th>亩</th>
                                    <th><?php echo $ricedata['field_area']?></th>
                                </tr>

                                <tr>
                                    <th>总播种面积</th>
                                    <th>亩</th>
                                    <th><?php echo $ricedata['total_sown_area']?></th>
                                </tr>

                                <tr>
                                    <th>区域面积</th>
                                    <th>亩</th>
                                    <th><?php echo $ricedata['zone_area']?></th>
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
                                <?php if($ricedata['erice_status']==1){ ?>
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
                                    <th>元/百公斤</th>
                                    <th>-</th>
                                </tr>

                                <?php } else { ?>
                                <tr>
                                    <th>早稻播种面积</th>
                                    <th>亩</th>
                                    <th><?php echo $ricedata['e_sown_area']?></th>
                                </tr>

                                <tr>
                                    <th>早稻受灾面积</th>
                                    <th>亩</th>
                                    <th><?php echo $ricedata['e_disaster_area']?></th>
                                </tr>

                                <tr>
                                    <th>早稻产量</th>
                                    <th>千公斤</th>
                                    <th><?php echo $ricedata['e_production']?></th>
                                </tr>

                                <tr>
                                    <th>早稻市场价格</th>
                                    <th>元/公斤</th>
                                    <th><?php echo $ricedata['e_market_price']?></th>
                                </tr>

                                <tr>
                                    <th>早稻收购价格</th>
                                    <th>元/公斤</th>
                                    <th><?php echo $ricedata['e_purchase_price']?></th>
                                </tr>

                                <tr>
                                    <th>早稻化肥价格</th>
                                    <th>元/百公斤</th>
                                    <th><?php echo $ricedata['e_fertilizer_price']?></th>
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
                                <?php if($ricedata['lrice_status']==1){?>
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
                                    <th>元/百公斤</th>
                                    <th>-</th>
                                </tr>
                                
                            <?php } else {?>
                                <tr>
                                    <th>晚稻播种面积</th>
                                    <th>亩</th>
                                    <th><?php echo $ricedata['l_sown_area']?></th>
                                </tr>


                                <tr>
                                    <th>晚稻受灾面积</th>
                                    <th>亩</th>
                                    <th><?php echo $ricedata['l_disaster_area']?></th>
                                </tr>

                                <tr>
                                    <th>晚稻产量</th>
                                    <th>千公斤</th>
                                    <th><?php echo $ricedata['l_production']?></th>
                                </tr>

                                <tr>
                                    <th>晚稻市场价格</th>
                                    <th>元/公斤</th>
                                    <th><?php echo $ricedata['l_market_price']?></th>
                                </tr>

                                <tr>
                                    <th>晚稻收购价格</th>
                                    <th>元/公斤</th>
                                    <th><?php echo $ricedata['l_purchase_price']?></th>
                                </tr>

                                <tr>
                                    <th>晚稻化肥价格</th>
                                    <th>元/百公斤</th>
                                    <th><?php echo $ricedata['l_fertilizer_price']?></th>
                                </tr>
                                <?php } ?>
                                </table>
                            </div>
                        </div>
                        <div class="bb">
                            <?php if($ricedata['rice_status'] == 1){ ?>
                                    <a href="/grps/index.php/Admin/Rice/../Rice/updateRice?rice_id=<?php  echo $ricedata['rice_id']; ?>" class="btn btn-info" role="button" >编辑信息</a>
                                <?php }else{ ?>
                                        <a class="btn" disabled="disabled">编辑信息</a>
                            <?php } ?>
                        </div>
                    </div>


                    <div class='tab-pane' id='tab2'>
                        <table class="table table-striped table-bordered">
                            <caption>年水稻分析指标</caption>
                            <tr>
                                <th>指标</th>
                                <th>单位</th>
                                <th>数据</th>
                            </tr>
                            <?php if($ricedata['brice_status']==1||$ricedata['erice_status']==1||$ricedata['lrice_status']==1){ ?>
                            <tr>
                                <th>年水稻平均亩产水平</th>
                                <th>公斤/亩</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>年水稻平均播种结构</th>
                                <th>%</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>年水稻平均面积受灾率</th>
                                <th>%</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>年水稻平均应该产量</th>
                                <th>千公斤</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>年水稻平均实际产量</th>
                                <th>千公斤</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>年水稻平均产量受灾率</th>
                                <th>%</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>年水稻产量播种面积潜力产量</th>
                                <th>千公斤</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>年水稻平均稻肥价比</th>
                                <th>%</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>年水稻平均亩产潜力产量</th>
                                <th>千公斤</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>年平均价格波动</th>
                                <th>%</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>年平均产量波动</th>
                                <th>%</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>年平均面积波动</th>
                                <th>%</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>年平均亩产波动</th>
                                <th>%</th>
                                <th>-</th>
                            </tr>
                            <?php } else {?>
                            <tr>
                                <th>年水稻平均亩产水平</th>
                                <th>公斤/亩</th>
                                <th><?php echo $ricedata['ay_yield_permu']?></th>
                            </tr>
                            <tr>
                                <th>年水稻平均播种结构</th>
                                <th>%</th>
                                <th><?php echo $ricedata['ay_planting_stru']?></th>
                            </tr>
                            <tr>
                                <th>年水稻平均面积受灾率</th>
                                <th>%</th>
                                <th><?php echo $ricedata['ay_area_disasterr']?></th>
                            </tr>
                            <tr>
                                <th>年水稻平均应该产量</th>
                                <th>千公斤</th>
                                <th><?php echo $ricedata['ay_suppose_yield']?></th>
                            </tr>
                            <tr>
                                <th>年水稻平均实际产量</th>
                                <th>千公斤</th>
                                <th><?php echo $ricedata['ay_actual_yield']?></th>
                            </tr>
                            <tr>
                                <th>年水稻平均产量受灾率</th>
                                <th>%</th>
                                <th><?php echo $ricedata['ay_yield_disasterr']?></th>
                            </tr>
                            <tr>
                                <th>年水稻产量播种面积潜力产量</th>
                                <th>千公斤</th>
                                <th><?php echo $ricedata['ay_potential_yield_sownaera']?></th>
                            </tr>
                            <tr>
                                <th>年水稻平均稻肥价比</th>
                                <th>%</th>
                                <th><?php echo $ricedata['ay_rice_fertilizer']?></th>
                            </tr>
                            <tr>
                                <th>年水稻平均亩产潜力产量</th>
                                <th>千公斤</th>
                                <th><?php echo $ricedata['ay_potential_yield_permu']?></th>
                            </tr>
                            
                            <?php } ?>
                        </table>
                    </div>


                    <div class='tab-pane' id='tab5'>
                        <table class="table table-striped table-bordered">
                            <caption>预警指标</caption>
                            <tr>
                                <th>指标</th>
                                <th>单位</th>
                                <th>数据</th>
                            </tr>
                            <?php if($ricedata['brice_status']==1||$ricedata['erice_status']==1||$ricedata['lrice_status']==1){ ?>
                            
                            <tr>
                                <th>早稻价格波动</th>
                                <th>%</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>早稻产量波动</th>
                                <th>%</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>早稻面积波动</th>
                                <th>%</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>早稻亩产波动</th>
                                <th>%</th>
                                <th>-</th>
                            </tr>

                            <tr>
                                <th>晚稻价格波动</th>
                                <th>%</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>晚稻产量波动</th>
                                <th>%</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>晚稻面积波动</th>
                                <th>%</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>晚稻亩产波动</th>
                                <th>%</th>
                                        <th>-</th>
                                </tr>
                            <tr>
                                <th>年平均价格波动</th>
                                <th>%</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>年平均产量波动</th>
                                <th>%</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>年平均面积波动</th>
                                <th>%</th>
                                <th>-</th>
                            </tr>
                            <tr>
                                <th>年平均亩产波动</th>
                                <th>%</th>
                                <th>-</th>
                            </tr>
                            <?php } else {?>
                             <tr>
                                <th>早稻价格波动</th>
                                <th>%</th>
                                <th><?php echo $ricedata['we_price_fluctuation']?></th>
                            </tr>
                            <tr>
                                <th>早稻产量波动</th>
                                <th>%</th>
                                <th><?php echo $ricedata['we_yield_fluctuation']?></th>
                            </tr>
                            <tr>
                                <th>早稻面积波动</th>
                                <th>%</th>
                                <th><?php echo $ricedata['we_area_fluctuation']?></th>
                            </tr>
                            <tr>
                                <th>早稻亩产波动</th>
                                <th>%</th>
                                <th><?php echo $ricedata['we_yield_permu_fluctuation']?></th>
                            </tr>

                            <tr>
                                <th>晚稻价格波动</th>
                                <th>%</th>
                                <th><?php echo $ricedata['wl_price_fluctuation']?></th>
                            </tr>
                            <tr>
                                <th>晚稻产量波动</th>
                                <th>%</th>
                                <th><?php echo $ricedata['wl_yield_fluctuation']?></th>
                            </tr>
                            <tr>
                                <th>晚稻面积波动</th>
                                <th>%</th>
                                <th><?php echo $ricedata['wl_area_fluctuation']?></th>
                            </tr>
                            <tr>
                                <th>晚稻亩产波动</th>
                                <th>%</th>
                                <th><?php echo $ricedata['wl_yield_permu_fluctuation']?></th>
                            </tr>


                            <tr>
                                <th>年平均价格波动</th>
                                <th>%</th>
                                <th><?php echo $ricedata['wy_price_fluctuation']?></th>
                            </tr>
                            <tr>
                                <th>年平均产量波动</th>
                                <th>%</th>
                                <th><?php echo $ricedata['wy_yield_fluctuation']?></th>
                            </tr>
                            <tr>
                                <th>年平均面积波动</th>
                                <th>%</th>
                                <th><?php echo $ricedata['wy_area_fluctuation']?></th>
                            </tr>
                            <tr>
                                <th>年平均亩产波动</th>
                                <th>%</th>
                                <th><?php echo $ricedata['wy_yield_permu_fluctuation']?></th>
                            </tr>

                            <?php } ?>
                        </table>
                    </div>


                </div>
            </div>
        </div>
	
	</body>
</html>