<?php
//作者：刘建安
//时间：2014/11/8
namespace Guest\Controller;

class IndexController extends UserController {
    public function index(){
    	$rice = M("InfoRice");
    	$ricedata = $rice->where("rice_status=1")->select();
	    $dist = M("InfoDistrict");
	    $distlist = $dist->select();
	    $citylist =  array();
	    foreach($distlist as $key => $value){
	    	if ($value["dist_id"] == $value["dist_belongto"]){
	    			array_push($citylist, $value);
	    	}	
	    }	
	    $this->assign("ricedata", $ricedata);
	    $this->assign("distlist", $distlist);
	    $this->assign("citylist", $citylist);
	    $this->display();
	 }
      
      //更新地图位置
    public function show(){
        $dist_latitude = I('lati');
        $dist_longitude = I('long');
        session("dist_latitude", $dist_latitude);
    	session("dist_longitude", $dist_longitude);
        $this->redirect('index');
    }
}

