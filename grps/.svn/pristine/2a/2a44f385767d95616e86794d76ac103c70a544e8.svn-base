<?php
//author:baolei
//date:2014/10/14

namespace Home\Model;
use Model;
class InfoRiceModel extends Model\Rice\InfoRiceModel{
	/**
     * 更新水稻信息
     * @param  array $data 修改信息
     * @return interger 成功1， 失败-返回错误编号
     */
	public function updateRice($data,$rice_kind,$reason=NULL){
		if(!empty($data)) {
			switch($rice_kind){
				case '1':
					$validateRule = $this->_validateForBRice;
					break;
				case '2':
					$validateRule = $this->_validateForERice;
					break;
				case '3':
					$validateRule = $this->_validateForLRice;
					break;
				default:
					$this->error="添加水稻失败，未知原因，请正确选择所提交水稻信息类别！";
					return false;
			}
			$rice_id = $data['rice_id'];
			//$calculateddata = $this->calculateIndicator($data);   //计算指标
			if($this->validate($validateRule)->create($data)){
				$result = $this->where("rice_id='$rice_id'")->save($data);
				$setStatus = $this->setRiceState($data["rice_id"], 2, $rice_kind);
				if($result !== false)
					return ture;
				else {
					$this->error = '修改水稻信息失败,未知原因!';
					return false;
				}
			}
			else
				return false;
		}
	}

	/**
     * 删除水稻信息
     * @param  $rice_id 删除一条水稻记录
     * @return integer 成功1， 水稻审核通过返回0，失败-1
     */
	public function deleteRice($rice_id)
	{
		$riceStatus = $this->where("rice_id='$rice_id'")->getField('rice_status');
		switch ($riceStatus) {
			case '1':
				$this->error = "水稻已经审核通过，不能删除";
				return false; //水稻已经审核通过，不能删除
				break;
			default:
				if($this->where("rice_id = '$rice_id'")->delete())
					return 1;//水稻删除成功
				else
				{
					$this->error = "水稻删除失败";
					return -1;//水稻删除失败
				}
				break;
		}
	}
}