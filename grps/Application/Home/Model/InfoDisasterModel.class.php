<?php
//作者：刘建安
//时间：2014/11/9
namespace Home\Model;
use Model;

class InfoDisasterModel extends  Model\Disaster\InfoDisasterModel {

	/*  添加灾难信息 */
	public function addDisaster($data){
		if ($this->create($data)){
			if ( $this->add($data)){
				return true;	
			}
			else{  //添加灾难信息失败
				$this->error = "添加失败！";
				return false;	
			}
		}
		else{  //添加灾难信息失败
			return false;
		}
	}
	
	/*  更新灾难信息 */
	public function updateDisaster($data){
		if(!empty($data)){
			$disa_id = $data["disa_id"];
			if ($this->create($data)){
				$result = $this->where("disa_id='$disa_id'")->save($data);
				if ($result !== false)
					return true;
				else{
					$this->error = "修改信息失败，未知原因！";
					return false;	
				}
			}
			else{
				return false;	
			}
		}
	}
	
}