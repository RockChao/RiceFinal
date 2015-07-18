<?php
//作者：刘建安
//时间：2014/11/8

namespace Admin\Controller;
use Think\Controller;
class AdminController extends Controller{
	public function _initialize(){
		if (isLogin() == 0 || session("user_level") != 1){
			$this->error("无权访问！", U("Home/User/login"), 2);
		}
	}
	
	/*
	返回进一个月内提交的未审核的灾难信息，并用于显示在标题栏中
	*/
	public function getDisasterData(){
	   	$withinOneMonth =  date("Y-m-d H:i:s", strtotime("-1 months"));
	    $disaster = M("InfoDisaster");
	    $dist = M("InfoDistrict");
	    $disaData = $disaster->where("disa_status=2 and disa_date>'$withinOneMonth'")->select();
	    $disalist = array();
	    foreach($disaData as $key1 => $value1){
	    	$dist_id = $value1["disa_dist"];
	    	$tmpData["dist_latitude"] = $dist->where("dist_id='$dist_id'")->getField("dist_latitude");
	    	$tmpData["dist_longitude"] = $dist->where("dist_id='$dist_id'")->getField("dist_longitude");
	    	$tmpData["dist_id"] = $dist_id;
	    	$tmpData["dist_name"] = getDistrictNameById($dist_id);
	    	array_push($disalist, $tmpData);
	    }
	    return $disalist;
	}

	/*
	*返回波动较大的水稻信息，用于显示在主题栏中
	*/
	public function getWaveRice(){
		$waveRice = M("InfoWave");
		$rice = M("InfoRice");
		$dist = M("InfoDistrict");
		$wavedata = $waveRice->select();
		foreach($wavedata as &$value){
			$rid = $value["rice_id"];
			$dist_id = $rice->where("rice_id='$rid'")->getField("dist_id");
			$value["dist_latitude"] = $dist->where("dist_id='$dist_id'")->getField("dist_latitude");
			$value["dist_longitude"] = $dist->where("dist_id='$dist_id'")->getField("dist_longitude");
			$value["dist_name"] = getDistrictNameById($dist_id);
			$value["dist_id"] = $dist_id;
			if ($value["wave_level"] == 1){
				$value["level"] = "黄色预警";
			}
			else if ($value["wave_level"] == 2){
				$value["level"] = "红色预警";
			}
		}
		return $wavedata;
	}
}