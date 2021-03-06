<?php
//作者：刘建安
//时间：2014/11/9
namespace Admin\Model;
use Model;

class InfoDisasterModel extends  Model\Disaster\InfoDisasterModel{
	/*  审核水稻信息 
	@param $did
	return bool
	已通过为1，不通过为0，审核中为2
	*/
	public function checkDisaster($did, $failed){
		$this->where("disa_id='$did'");
		if ($failed){  //不通过审核
			$data["disa_status"] = 0;
		}
		else{  //通过审核
			$data["disa_status"] = 1;
		}
		if ($this->save($data)){  //写入数据库
				return true;
		}
		else{
			return false;
		}
	}
	/*
	修改灾难信息
	*/
	public function updateDisaster($data){
		if ($this->create($data)){
			$disa_id = $data["disa_id"];
			$did = $this->where("disa_id='$disa_id'")->save($data);
			if ($did !== false){
				return true;
			}
			else{
				$this->error = "修改失败！";
				return false;
			}
		}
		else{
			return false;
		}
	}
	
	public function deleteDisaster($disa_id){
		$did = $this->where("disa_id='$disa_id'")->delete();
		if ($did)
			return true;
		else
			return false;
	}
}