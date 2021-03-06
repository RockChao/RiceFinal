<?php
//作者：刘建安
//时间：2014/11/9
namespace Home\Controller;
use Think\Controller;

class DisasterController extends HomeController{
	/* 显示所有已经提交的灾难信息 */
	public function manageDisaster(){
		$disaster = M("InfoDisaster");
		$dist_id= session("dist_id");
		$disadata = $disaster->where("disa_dist='$dist_id'")->select();
		foreach($disadata as &$value){
			$value["disa_dist"] = getDistrictNameById($value["disa_dist"]);
			$value["disa_situ"] = getDisaSituById($value["disa_situ"]);
			$value["disa_status_id"] = $value["disa_status"];
			$value["disa_status"] = getDisasterStatus($value["disa_status"]);
			$value["disa_begindate"] = date("Y-m-d",strtotime($value["disa_begindate"]));
			$value["disa_enddate"] = date("Y-m-d", strtotime($value["disa_enddate"]));
		}
		$this->assign("disadata", $disadata);
		$this->display();
	}
	
	/*  添加灾难信息 */
	public function addDisaster(){
		if (IS_POST){
			$data["disa_dist"] = session("dist_id");
			$data['disa_date'] = date("Y-m-d H:i:s", time()); 
			$data["disa_begindate"] = date(I("disa_begindate"));
			$data["disa_enddate"] = date(I("disa_enddate"));
			$data["disa_situ"] = (int)I("disa_situ");
			$data["disa_area"] = I("disa_area");
			if (isset($_POST["disa_eloss"]) && !empty($_POST["disa_eloss"])){
				$data["disa_eloss"] = I("disa_eloss");
			}
			$data["disa_description"] = I("disa_description");
			$data["disa_status"] = 2;
			if (empty($data["disa_begindate"])){
				$this->error("起始时间必须提供");
			}
			else if (empty($data["disa_enddate"])){
				$this->error("结束时间必须提供");
			}
			else if ($data["disa_begindate"] <= $data["disa_enddate"]) { //判断灾难开始时间和结束时间的大小
				$disater = D("InfoDisaster");
				$did = $disater->addDisaster($data);
				if ($did){
					echo '{
						"info":"提交成功",
						"status":"y"
					}';
				}
				else{
					echo '{
						"info":"提交失败",
						"status":"n"
					}';
				}
			}
			else{
				echo '{
					"info":"起始时间不能晚于结束时间",
					"status":"n"
				}';
			}
		}
		else{
			$this->display();
		}
	}
	/*  修改灾难信息 */
	public function updateDisaster(){
		$disa_id = I("disa_id");
		if (IS_POST){
			$disaster = D("InfoDisaster");
			$disa_status = $disaster->where("disa_id='$disa_id'")->getField("disa_status");
			if ($disa_status != 1){
				$data["disa_id"] = $disa_id;
				$data["disa_begindate"] = date(I("disa_begindate"));
				$data["disa_enddate"] =date(I("disa_enddate"));
				$data["disa_situ"] = (int)I("disa_situ");
				$data["disa_area"] = I("disa_area");
				$data["disa_eloss"] = I("disa_eloss");
				$data["disa_description"] = I("disa_description");
				$data["disa_status"] = 2;
				
				if ($data["disa_begindate"] <= $data["disa_enddate"]) { //判断灾难开始时间和结束时间的大小
					$result = $disaster->updateDisaster($data);
					if ($result){
						$this->success("修改成功！",U("manageDisaster"))	;
					}
					else{
						$this->error($disaster->getError());	
					}
				}
				else{
					$this->error("起始时间不能晚于结束时间!");
				}
			}
			else if (empty($disa_status)){
				$this->error("该记录不存在！");	
			}
			else{
				$this->error("该记录已经通过审核！");	
			}
		}
		else{
			$disadata = M("InfoDisaster")->where("disa_id='$disa_id'")->find();
			$disadata["disa_dist"] = getDistrictNameById($disadata["disa_dist"]);
			$disadata["disa_begindate"] = date("Y-m-d",strtotime($disadata["disa_begindate"]));
			$disadata["disa_enddate"] = date("Y-m-d", strtotime($disadata["disa_enddate"]));
			$this->assign("disadata", $disadata);
			$this->display();
		}
	}
}