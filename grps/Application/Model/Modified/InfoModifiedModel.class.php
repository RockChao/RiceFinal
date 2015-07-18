<?php
//作者：刘建安
//时间：2014/10/1
namespace Model\Modified;
use Think\Model;

class InfoModifiedModel extends Model{
	public function index(){
	}
	/*
	添加记录
	@param $data = {
	rice_id,
	modifier_level,
	modifier_id,
	modifier_reason,
	modified_date
	}
	*/
	public function addModified($data){
		if ($this->create($data)){
			return $this->add($data);
		}	
	}
}
?>