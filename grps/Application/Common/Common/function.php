<?php

use Admin\Model\InfoDistrictModel;

/*  通过dist_id来获得dist_name 
@param $dist_id
return $dist_name;
*/
function getDistrictNameById($dist_id){
	$dist = M("InfoDistrict");
	$dist_name = $dist->where("dist_id='$dist_id'")->getField("dist_name");
	return $dist_name;	
}

/*  通过dist_name 来获得对应dist_id 
@param $dist_name
return $dist_id
*/
function getDistrictIdByName($dist_name){
	$dist = M("InfoDistrict");
	$dist_id = $dist->where("dist_name='$dist_name'")->getField("dist_id");
	return $dist_id;	
}

/*  判断用户是否已经登录
* 登录返回User id，未登录返回0
 */
function isLogin(){
	if($_SESSION['user_name'] != null && $_SESSION['user_name'] != "")
		return session(user_id);
	else
		return 0;
}

function getRiceStatus($rice_status){
	
	if ($rice_status== 4){
		$status = "不通过";
	}
	else if ($rice_status == 3){
		$status = "已通过"	;
	}
   else if ($rice_status == 2){
		$status = "审核中";
	}
	 else if ($rice_status == 1){
		$status = "未提交";
	}
	else{
		$status = "非法状态";	
	}
	return $status;
}
/*
返回灾难的中文状态信息
0  不通过
1  已通过
2  审核中
else  出错
*/
function getDisasterStatus($status){
	if($status == 0)
		$state = "不通过";
	else if ($status == 1)
		$state = "已通过";
	else if ($status == 2)
		$state = "审核中";
	else
		$state = "出错";
	return $state;
}

/*  根据数字来获取灾情 */
function getDisaSituById($num){
	switch($num){
		case 1:$situ = "台风"	;break;
		case 2:$situ = "干旱";break;
		case 3:$situ = "洪水";break;
		case 4:$situ = "病虫害";break;
		case 5:$situ = "其他";break;
	}	
	return $situ;
}

?>