<?php
//作者：刘建安
//时间：2014/11/16
namespace Guest\Controller;

class DisasterController extends UserController {
	public function manageDisaster(){
		$disaster = M("InfoDisaster");
		$disadata = $disaster->where("disa_status=1")->select();
		foreach($disadata as &$value){
			$value["disa_situ"] = getDisaSituById($value["disa_situ"]);
			$value["disa_dist"] = getDistrictNameById($value["disa_dist"]);
			$value["disa_begindate"] = date("Y-m-d", strtotime($value["disa_begindate"]));
			$value["disa_enddate"] = date("Y-m-d", strtotime($value["disa_enddate"]));
		}
		$this->assign("disadata", $disadata);
		$this->display();
	}
}