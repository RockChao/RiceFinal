<?php
//作者：刘建安
//时间：2014/10/19
namespace Admin\Model;
use Model\Modified\InfoModifiedModel;
use Model;
use Think;



class InfoRiceModel extends Model\Rice\InfoRiceModel {
	   
	/*  更新水稻信息 
	*/
	public function updateRice($data, $rice_kind, $reason){
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
		
		if ($this->validate($validateRule)->create($data)){
			$tranDb = new Think\Model();
			$tranDb->startTrans();  //启动事务，保证数据的一致性
				
			$rice_id = $data['rice_id'];
			$rid1 = $this->where("rice_id='$rice_id'")->save($data);
			
			$rid = 1;
			$wid = 1;
			$newData = $this->where("rice_id='$rice_id'")->find();
			if ($newData["rice_status"] == 365 && $rid1 !== false) {//如果所有基本指标都已经通过审核，则自动计算分析指标
				$calcudata = $this->calculateIndicator($newData);  //计算指标
			 	$rid = $this->where("rice_id='$rice_id'")->save($calcudata); //更新计算后的水稻数据
			 	$wave = new InfoWaveModel;  
			 	$wid = $wave->addWave($calcudata);  //计算波动
			}
			//将修改写入记录
			$modified = new InfoModifiedModel();
			$time = date("Y-m-d H:i:s");
			$modifiedData['rice_id'] = $rice_id;
			$modifiedData['modifier_level'] = session("user_level");
			$modifiedData['modifier_id'] = session("user_id");
			$modifiedData['modifier_reason'] = $reason;
			$modifiedData['modified_date'] = $time;
			$mid = $modified->addModified($modifiedData);

			if ($rid !== false && $mid && $wid ){  //如果水稻信息,波动计算和日志都保存成功，则提交事务
				$tranDb->commit();
				return true;
			}
			else{  //保存失败，回滚
				$tranDb->rollback();
				$this->error = "水稻更新失败";
				return false;
			}
		}
		else{
			return false;;	
		}
	}
	
	/*  审核水稻信息 
	@param $rice_id
	return bool
	0获取失败 1未提交 2提交审核中 3提交已通过 4提交未通过
	*/
	public function checkRice($rice_id, $failed,$rice_kind){
		$this->where("rice_id=$rice_id");
		if ($failed)  //驳回审核
			$status = 4;
		else  //通过审核
			$status = 3;
		return  $this->setRiceState($rice_id, $status, $rice_kind);
	}

	/*删除整条水稻信息
	*@param integer $rice_id
	*@return integer 成功返回1，失败返回0
	*/
	public function deleteRice($rice_id){
		$tranDb = new Think\Model();
		$tranDb->startTrans();

		$rid = $this->where("rice_id=$rice_id")->delete();
		$modified = new InfoModifiedModel();
		$mdata = $modified->where("rice_id='$rice_id'")->select();
		if (!empty($mdata))
			$mid = $modified->where("rice_id='$rice_id'")->delete();
		else
			$mid = 1;
		if ($rid && $mid){
			$tranDb->commit();
			return true;
		}
		else{
			$tranDb->rollback();
			return false;
		}
	}

	/*
	删除基本水稻信息
	@param rice_id
	*/
	public function deleteBRice($rice_id){
		$zero = NULL;
		$data = $this->_setCalculatedNull();
		$data["population"] = $zero;
		$data["agri_population"] = $zero;
		$data["agri_area"] = $zero;
		$data["field_area"] = $zero;
		$data["total_sown_area"] = $zero;
		$data["zone_area"] = $zero;
		$tranDb = new Think\Model;
		$tranDb->startTrans();

		$modified = new InfoModifiedModel();

		$estatus = $this->getERiceState($rice_id);
		$lstatus = $this->getLRiceState($rice_id);
		if ($estatus == 1 && $lstatus == 1){
			$rid = $this->where("rice_id='$rice_id'")->delete();
			$mdata = $modified->where("rice_id='$rice_id'")->select();
			if (!empty($mdata))
				$mid = $modified->where("rice_id='$rice_id'")->delete();
			else
				$mid = 1;
		}
		else{
			$rid = $this->where("rice_id='$rice_id'")->save($data);
			if ($rid)
				$rid = $this->setRiceState($rice_id, 1, 1);
			$mid = 1;
		}
		if ($rid && $mid){
			$tranDb->commit();
			return true;
		}
		else{
			$tranDb->rollback();
			return false;
		}
	}

	/*
	删除早稻信息
	@param rice_id
	*/
	public function deleteERice($rice_id){
		$zero = NULL;
		$data = $this->_setCalculatedNull();
		$data["e_sown_area"] = $zero;
		$data["e_disaster_area"] = $zero;
		$data["e_production"] = $zero;
		$data["e_market_price"] = $zero;
		$data["e_purchase_price"] = $zero;
		$data["e_fertilizer_price"] = $zero;
		$tranDb = new Think\Model;
		$tranDb->startTrans();

		$modified = new InfoModifiedModel();

		$bstatus = $this->getBRiceState($rice_id);
		$lstatus = $this->getLRiceState($rice_id);
		if ($bstatus == 1 && $lstatus == 1){
			$rid = $this->where("rice_id='$rice_id'")->delete();
			$mdata = $modified->where("rice_id='$rice_id'")->select();
			if (!empty($mdata))
				$mid = $modified->where("rice_id='$rice_id'")->delete();
			else
				$mid = 1;
		}
		else{
			$rid = $this->where("rice_id='$rice_id'")->save($data);
			if ($rid)
				$rid = $this->setRiceState($rice_id, 1, 2);
			$mid = 1;
		}
		if ($rid && $mid){
			$tranDb->commit();
			return true;
		}
		else{
			$tranDb->rollback();
			return false;
		}
	}

	/*
	删除晚稻信息
	@param rice_id
	*/
	public function deleteLRice($rice_id){
		$zero = NULL;
		$data = $this->_setCalculatedNull();
		//晚稻基本指标
		$data["l_sown_area"] = $zero;
		$data["l_disaster_area"] = $zero;
		$data["l_production"] = $zero;
		$data["l_market_price"] = $zero;
		$data["l_purchase_price"] = $zero;
		$data["l_fertilizer_price"] = $zero;
		
		$tranDb = new Think\Model;
		$tranDb->startTrans();

		$modified = new InfoModifiedModel();

		$bstatus = $this->getBRiceState($rice_id);
		$estatus = $this->getERiceState($rice_id);
		if ($bstatus == 1 && $estatus == 1){
			$rid = $this->where("rice_id='$rice_id'")->delete();
			$mdata = $modified->where("rice_id='$rice_id'")->select();
			if (!empty($mdata))
				$mid = $modified->where("rice_id='$rice_id'")->delete();
			else
				$mid = 1;
		}
		else{
			$rid = $this->where("rice_id='$rice_id'")->save($data);
			if ($rid)
				$rid = $this->setRiceState($rice_id, 1, 3);
			$mid = 1;
		}
		if ($rid && $mid){
			$tranDb->commit();
			return true;
		}
		else{
			$tranDb->rollback();
			return false;
		}
	}

	/*
	*计算分析指标
	*/
	public function calculateRice($rice_id){
		$tranDb = new Think\Model();
		$tranDb->startTrans();  //启动事务，保证数据的一致性

		$ricedata = $this->where("rice_id='$rice_id'")->find();
		$calculatedData = $this->calculateIndicator($ricedata);
		$rid = $this->where("rice_id='$rice_id'")->save($calculatedData);

		$wave = new InfoWaveModel;
		$wid = $wave->addWave($calculatedData);
		if ($rid!==false && $wid){
			$tranDb->commit();
			return true;
		}
		else{
			$this->error = "计算失败！";
			$tranDb->rollback();
			return false;
		}
	}

	/*
	将所有分析指标置为NULL
	*/
	protected function _setCalculatedNull(){
		$zero = NULL;
		//早稻分析指标
		$data["ae_yield_permu"] = $zero;
		$data["ae_planting_stru"] = $zero;
		$data["ae_area_disasterr"] = $zero;
		$data["ae_suppose_yield"] = $zero;
		$data["ae_actual_yield"] = $zero;
		$data["ae_yield_disasterr"] = $zero;
		$data["ae_potential_yield_sownaera"] = $zero;
		$data["ae_rice_fertilizer"] = $zero;
		$data["ae_potential_yield_permu"] = $zero;
		//晚稻分析指标
		$data["al_yield_permu"] = $zero;
		$data["al_planting_stru"] = $zero;
		$data["al_area_disasterr"] = $zero;
		$data["al_suppose_yield"] = $zero;
		$data["al_actual_yield"] = $zero;
		$data["al_yield_disasterr"] = $zero;
		$data["al_potential_yield_sownaera"] = $zero;
		$data["al_rice_fertilizer"] = $zero;
		$data["al_potential_yield_permu"] = $zero;
		//全年分析指标
		$data["ay_yield_permu"] = $zero;
		$data["ay_planting_stru"] = $zero;
		$data["ay_area_disasterr"] = $zero;
		$data["ay_suppose_yield"] = $zero;
		$data["ay_actual_yield"] = $zero;
		$data["ay_yield_disasterr"] = $zero;
		$data["ay_potential_yield_sownaera"] = $zero;
		$data["ay_rice_fertilizer"] = $zero;
		$data["ay_potential_yield_permu"] = $zero;
		//早稻波动指标
		$data["we_price_fluctuation"] = $zero;
		$data["we_yield_fluctuation"] = $zero;
		$data["we_area_fluctuation"] = $zero;
		$data["we_yield_permu_fluctuation"] = $zero;
		//晚稻波动指标
		$data["wl_price_fluctuation"] = $zero;
		$data["wl_yield_fluctuation"] = $zero;
		$data["wl_area_fluctuation"] = $zero;
		$data["wl_yield_permu_fluctuation"] = $zero;
		//全年波动指标
		$data["wy_price_fluctuation"] = $zero;
		$data["wy_yield_fluctuation"] = $zero;
		$data["wy_area_fluctuation"] = $zero;
		$data["wy_yield_permu_fluctuation"] = $zero;
		return $data;
	}
}
?>
