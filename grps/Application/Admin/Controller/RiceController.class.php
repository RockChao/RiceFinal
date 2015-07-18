<?php
//作者：刘建安
//时间：2014/10/19
namespace Admin\Controller;

class RiceController extends AdminController{
	
	/*  列出所有未审核的水稻信息  */
	public function uncheckRice(){
		$rice = D("InfoRice");
		$ricedata = $rice->getUncheckRice();

	    $disalist = $this->getDisasterData();
	    $ricedata1["disa_number"] = count($disalist);
	    $wavedata = $this->getWaveRice();
	    $ricedata1["wave_number"] = count($wavedata);
	    $this->assign("wavedata", $wavedata);
	    $this->assign("disalist", $disalist);
	    $this->assign("ricedata1", $ricedata1);
		$this->assign("ricedata", $ricedata);
		
		$this->display();
	}
	
	/*
	审核水稻信息
	@param $Post :
	rice_id,
	user_id,
	*/
	public function checkRice(){
		if (IS_POST){
			$flag = $_POST["flag"];
			if (isset($_POST["flag"]) && !empty($_POST["flag"]) && $flag){
				$failed = true;
			}
			else{
				$failed = false;
			}
			$rice_kind = I("rice_kind"); //需要从前台页面传入水稻的种类
			$rice_id = I("rice_id");		
			$user_level = session("user_level");
			$rice = D("InfoRice");
			if (1 == $rice_kind){
				$rice_status = $rice->getBRiceState($rice_id);
			}
			else if (2 == $rice_kind){
				$rice_status = $rice->getERiceState($rice_id);
			}
			else if (3 == $rice_kind){
				$rice_status = $rice->getLRiceState($rice_id);
			}
				
			if ($user_level == 1){  //判断管理员权限
				if ($rice_status == 2){  //判断是否已经通过审核或被退回
					$rid = $rice->checkRice($rice_id, $failed, $rice_kind);
					if ($rid){ //审核成功
						echo '{
							"info":"审核成功",
							"status":"y"
						}';
					}
					else{	
						echo '{
							"info":"审核失败",
							"status":"n"
						}';
					}
				}
				// else if ($rice_status == 3){  //已经通过审核，不能重复审核
				// 	$this->error("该地区已经通过审核！");
				// }
				// else if ($rice_status == 4){  //该信息不能通过审核
				// 	$this->error("该水稻信息没有通过审核！");	
				// }
				// else if ($rice_status == 1){  //该信息不能通过审核
				// 	$this->error("该水稻信息未提交！");	
				// }
				// else if ($rice_status == 0){  //该信息不能通过审核
				// 	$this->error("该水稻信息获取失败！");	
				// }		
			}
			else{  //非管理员
				$this->error("您没有权限进行这项操作！");	
			}
		}
		else{
			$rice_id = I("rice_id");
			$rice = D("InfoRice");
			$data = $rice->where("rice_id='$rice_id'")->find();
			$data['rice_region'] = getDistrictNameById($data['dist_id']);
			//显示审核状态
			$bstatus = $data["rice_status"] & 7;
			$estatus = ($data["rice_status"] >>3 )& 7;
			$lstatus = ($data["rice_status"] >>6 ) & 7;
	
			$data['brice_status'] = $rice->getRiceState($bstatus);
			$data['erice_status'] = $rice->getRiceState($estatus);
			$data['lrice_status'] = $rice->getRiceState($lstatus);
		    $disalist = $this->getDisasterData();
		    $data["disa_number"] = count($disalist);
		    $wavedata = $this->getWaveRice();
	    	$data["wave_number"] = count($wavedata);
	    	$this->assign("wavedata", $wavedata);
		    $this->assign("disalist", $disalist);	
			$this->assign("ricedata", $data);
			$this->display();
		}
	}
	
	/*  列出所有水稻的概要信息 */
	public function manageRice(){
		$rice = D("InfoRice");
		$ricedata = $rice->select();   //得到水稻信息
		foreach($ricedata as  &$value){
			$dist_id = $value['dist_id'];
			$dist_name = getDistrictNameByID($dist_id);
			$value['dist_name'] = $dist_name;   //将地区ID换成地区名
			//显示审核状态
			$bstatus = $value["rice_status"] & 7;
			$estatus = ($value["rice_status"] >>3 )& 7;
			$lstatus = ($value["rice_status"] >>6 ) & 7;
	
			$value['brice_status_id'] = $rice->getRiceState($bstatus);
			$value['erice_status_id'] = $rice->getRiceState($estatus);
			$value['lrice_status_id'] = $rice->getRiceState($lstatus);

			$value['brice_status'] = getRiceStatus($value['brice_status_id']);
			$value['erice_status'] = getRiceStatus($value['erice_status_id']);
			$value['lrice_status'] = getRiceStatus($value['lrice_status_id']);
			if ($value['brice_status_id'] == 3 && $value['erice_status_id'] == 3&& $value['lrice_status_id'] ==3)
				$value['rice_status2'] = 2;
			else
				$value['rice_status2'] = 1;
		}
	    $disalist = $this->getDisasterData();
	    $ricedata1["disa_number"] = count($disalist);
	    $wavedata = $this->getWaveRice();
	    $ricedata1["wave_number"] = count($wavedata);
	    $this->assign("wavedata", $wavedata);
	    $this->assign("disalist", $disalist);
	    $this->assign("ricedata1", $ricedata1);
		$this->assign("ricedata",$ricedata);
		$this->display();	
	}

	/*
	更新水稻信息，管理员只能更新已经通过审核的水稻信息
	@param rice_kind 提交稻谷信息种类 1代表基本信息 2早稻信息 3晚稻信息
	@param reason  修改理由
	*/
	public function updateRice(){
		if (IS_POST){
			$user_id = (int)session('user_id');
			$modifier['modifier_level'] = (int)session('user_level');
			$modifier['modifier_id'] = (int)$user_id;
			$rice = D("InfoRice");
			$rice_id = (int)I('rice_id');
			$rice_kind = (int)I("rice_kind");
			
			$rice_status = $rice->where("rice_id='$rice_id'")->getField("rice_status");
			$reason = trim(I("reason")); //修改理由
			if ($modifier['modifier_level'] == 1){
				$dist_name = I('rice_region');	
				$dist_id = getDistrictIdByName($dist_name);
				$data['rice_id'] = $rice_id;
				$data['rice_status'] = $rice_status;
				if (1 == $rice_kind){
					$data['dist_id'] =$dist_id;
					$data['population'] = I('population');
					$data['agri_population'] = I('agri_population');
					$data['agri_area'] = I('agri_area');
					$data['field_area'] = I('field_area');
					$data['total_sown_area'] = I('total_sown_area');
					$data['zone_area'] = I('zone_area');
				}
				else if (2 == $rice_kind){//早稻信息
					$data['e_sown_area'] = I('e_sown_area');
					$data['e_disaster_area'] = I('e_disaster_area');
					$data['e_production'] = I('e_production');
					$data['e_market_price'] = I('e_market_price');
					$data['e_purchase_price'] = I('e_purchase_price');
					$data['e_fertilizer_price'] = I('e_fertilizer_price');
				}
				else{//晚稻信息
					$data['l_sown_area']= I('l_sown_area');
					$data['l_disaster_area'] = I('l_disaster_area');
					$data['l_production'] = I('l_production');
					$data['l_market_price'] = I('l_market_price');
					$data['l_purchase_price'] = I('l_purchase_price');
					$data['l_fertilizer_price'] = I('l_fertilizer_price');
				}
				$rid = $rice->updateRice($data, $rice_kind, $reason);  //会自动计算分析指标（如果都通过审核了）
				if ($rid){
					$this->success("修改成功！");
				}
				else{
					$this->error($rice->getError());	
				}

			}
		}
		else{
			//显示水稻信息更新的输入页面
			$rice_id = I("rice_id");
			$rice = D("InfoRice");
			$data = $rice->where("rice_id='$rice_id'")->find();
			$data['rice_region'] = getDistrictNameById($data['dist_id']);
			$bstatus = $data["rice_status"] & 7;
			$estatus = ($data["rice_status"] >>3 )& 7;
			$lstatus = ($data["rice_status"] >>6 ) & 7;

			$data['brice_status'] = $rice->getRiceState($bstatus);
			$data['erice_status'] = $rice->getRiceState($estatus);
			$data['lrice_status'] = $rice->getRiceState($lstatus);	
		    $disalist = $this->getDisasterData();
		    $data["disa_number"] = count($disalist);
		    $wavedata = $this->getWaveRice();
	    	$data["wave_number"] = count($wavedata);
	    	$this->assign("wavedata", $wavedata);
		    $this->assign("disalist", $disalist);
			$this->assign("ricedata", $data);
			$this->display();
		}
	}
	
	/*   列出一项水稻的所有信息 */
	public function detailRice(){
		$rice_id = I("rice_id");
		$rice = D("InfoRice");
		$ricedata = $rice->where("rice_id='$rice_id'")->find();
		$ricedata["dist_name"] = getDistrictNameById($ricedata["dist_id"]);
		$bstatus = $ricedata["rice_status"] & 7;
		$estatus = ($ricedata["rice_status"] >>3 )& 7;
		$lstatus = ($ricedata["rice_status"] >>6 ) & 7;

		$ricedata['brice_status_id'] = $rice->getRiceState($bstatus);
		$ricedata['erice_status_id'] = $rice->getRiceState($estatus);
		$ricedata['lrice_status_id'] = $rice->getRiceState($lstatus);
		$ricedata['brice_status'] = getRiceStatus($ricedata['brice_status_id']);
		$ricedata['erice_status'] = getRiceStatus($ricedata['erice_status_id']);
		$ricedata['lrice_status'] = getRiceStatus($ricedata['lrice_status_id']);

		//将所有百分数乘以100
		$ricedata['ae_planting_stru'] = number_format($ricedata['ae_planting_stru'] * 100,2);
		$ricedata['ae_area_disasterr'] = number_format($ricedata['ae_area_disasterr'] * 100, 2);
		$ricedata['ae_yield_disasterr'] = number_format($ricedata['ae_yield_disasterr'] * 100, 2);
		$ricedata['ae_rice_fertilizer'] = number_format($ricedata['ae_rice_fertilizer'] * 100, 2);
		$ricedata['al_planting_stru'] = number_format($ricedata['al_planting_stru'] * 100, 2);
		$ricedata['al_area_disasterr'] = number_format($ricedata['al_area_disasterr'] * 100, 2);
		$ricedata['al_yield_disasterr'] = number_format($ricedata['al_yield_disasterr'] * 100, 2);
		$ricedata['al_rice_fertilizer'] = number_format($ricedata['al_rice_fertilizer'] * 100, 2);
		$ricedata['ay_planting_stru'] = number_format($ricedata['ay_planting_stru'] * 100, 2);
		$ricedata['ay_area_disasterr'] = number_format($ricedata['ay_area_disasterr']*100, 2);
		$ricedata['ay_yield_disasterr'] = number_format($ricedata['ay_yield_disasterr'] * 100, 2);
		$ricedata['ay_rice_fertilizer'] = number_format($ricedata['ay_rice_fertilizer'] * 100, 2);
		$ricedata['we_price_fluctuation'] = number_format($ricedata['we_price_fluctuation'] * 100, 2);
		$ricedata['we_yield_fluctuation'] = number_format($ricedata['we_yield_fluctuation'] * 100, 2);
		$ricedata['we_area_fluctuation'] = number_format($ricedata['we_area_fluctuation'] * 100, 2);
		$ricedata['we_yield_permu_fluctuation'] = number_format($ricedata['we_yield_permu_fluctuation'] * 100, 2);
		$ricedata['wl_price_fluctuation'] = number_format($ricedata['wl_price_fluctuation'] * 100, 2);
		$ricedata['wl_yield_fluctuation'] = number_format($ricedata['wl_yield_fluctuation'] * 100, 2);
		$ricedata['wl_area_fluctuation'] = number_format($ricedata['wl_area_fluctuation'] * 100, 2);
		$ricedata['wl_yield_permu_fluctuation'] = number_format($ricedata['wl_yield_permu_fluctuation'] * 100, 2);
		$ricedata['wy_price_fluctuation'] = number_format($ricedata['wy_price_fluctuation'] * 100, 2);
		$ricedata['wy_yield_fluctuation'] = number_format($ricedata['wy_yield_fluctuation'] * 100, 2);
		$ricedata['wy_area_fluctuation'] = number_format($ricedata['wy_area_fluctuation'] * 100, 2);
		$ricedata['wy_yield_permu_fluctuation'] = number_format($ricedata['wy_yield_permu_fluctuation'] * 100, 2);

		if ($ricedata['brice_status_id'] == 3 || $ricedata['erice_status_id'] == 3 || $ricedata['lrice_status_id'] == 3){
					$ricedata["rice_status"] = 1;
		}
		if ($ricedata['brice_status_id'] == 3 && $ricedata['erice_status_id'] == 3 && $ricedata['lrice_status_id'] == 3){
			$ricedata["rice_status2"] = 2;
		}

	    $disalist = $this->getDisasterData();
	    $ricedata["disa_number"] = count($disalist);
	    $wavedata = $this->getWaveRice();
	    $ricedata["wave_number"] = count($wavedata);
	    $this->assign("wavedata", $wavedata);
	    $this->assign("disalist", $disalist);
	    $this->assign("ricedata", $ricedata);
		$this->display();
	}
	
	/*
	删除整条水稻信息
	@param rice_id
	*/
	public function deleteRice(){
		$rice_id = I("rice_id");
		$rice = D("InfoRice");
		if ($rice->deleteRice($rice_id)){
			$this->success("删除成功");
		}
		else{
			$this->error("删除失败");
		}
	}

	/*
	删除基本水稻信息
	@param rice_id
	*/
	public function deleteBRice(){
		$rice_id = I("rice_id");
		$rice = D("InfoRice");
		if ($rice->deleteBRice($rice_id)){
			$this->success("删除成功");
		}
		else{
			$this->error("删除失败");
		}
	}

	/*
	删除早稻信息
	@param rice_id
	*/
	public function deleteERice(){
		$rice_id = I("rice_id");
		$rice = D("InfoRice");
		if ($rice->deleteERice($rice_id)){
			$this->success("删除成功");
		}
		else{
			$this->error("删除失败");
		}
	}

	/*
	删除晚稻信息
	*@param rice_id
	*/
	public function deleteLRice(){
		$rice = D('InfoRice');
		if($rice->deleteLRice(I('rice_id')))
			$this->success("删除成功");
		else
			$this->error("删除失败");
	}

	/* 
	显示管理员对水稻的修改历史
    */
	public function showModifiedHistory(){
		$rice_id = I("rice_id");
		$modified = M("InfoModified");
		$mdata = $modified->where("rice_id='$rice_id'")->select();
	    $disalist = $this->getDisasterData();
	    $ricedata["disa_number"] = count($disalist);
	    $wavedata = $this->getWaveRice();
	    $ricedata["wave_number"] = count($wavedata);
	    $this->assign("wavedata", $wavedata);
	    $this->assign("disalist", $disalist);
	    $this->assign("ricedata", $ricedata);
		$this->assign("mdata", $mdata);
		$this->display();
	}

	/*
	计算分析指标
	只有当所有基本指标都已经提交后，才能计算分析指标
	*/
	public function calculateRice(){
		$rice_id = (int)I("rice_id");
		$rice = D("InfoRice");
		$rid = $rice->calculateRice($rice_id);

		if ($rid){
			$this->success("计算成功");
		}
		else{
			$this->error($rice->getError());
		}
	}

	/**
	*导出excell表格，格式为xls
	*@param Array riceIDs 需要导出的字段；
	*/
	public function exportDataToExcel(){
		if(ISPOST){
			vendor('Classes.PHPExcel');
			$objExcel = \PHPExcel_IOFactory::load(dirname(__FILE__).'/template_of_rice.xlsx');
       	 	//set document Property
			$objWriter = \PHPExcel_IOFactory::createWriter($objExcel, 'Excel2007');


			$riceIds = I('rice_ids');
			$size = count($riceIds);
			if($riceIds==null){
				$this->error("请选择需要导出数据项");
			}
			$riceModel = D('InfoRice');
			// Add data
			for ($i = 0; $i < $size; $i++) {
				$riceData=$riceModel->where("rice_id = '$riceIds[$i]'")->find();

				$j =$i+5;
				$objExcel->getActiveSheet()
				->setCellValue('A' . $j, getDistrictNameById($riceData['dist_id']))
				->setCellValue('B' . $j, $riceData['year'])
				->setCellValue('C' . $j, $riceData['population']) 
				->setCellValue('D' . $j, $riceData['agri_population']) 
				->setCellValue('E' . $j, $riceData['agri_area']) 
				->setCellValue('F' . $j, $riceData['field_area']) 
				->setCellValue('G' . $j, $riceData['total_sown_area']) 
				->setCellValue('H' . $j, $riceData['zone_area']) 
				->setCellValue('I' . $j, $riceData['e_sown_area']) 
				->setCellValue('J' . $j, $riceData['e_disaster_area']) 
				->setCellValue('K' . $j, $riceData['e_production']) 
				->setCellValue('L' . $j, $riceData['e_market_price']) 
				->setCellValue('M' . $j, $riceData['e_purchase_price']) 
				->setCellValue('N' . $j, $riceData['e_fertilizer_price'])
				->setCellValue('O' . $j, $riceData['l_sown_area'])
				->setCellValue('P' . $j, $riceData['l_disaster_area'])
				->setCellValue('Q' . $j, $riceData['l_disaster_area'])
				->setCellValue('R' . $j, $riceData['l_market_price'])
				->setCellValue('S' . $j, $riceData['l_purchase_price'])
				->setCellValue('T' . $j, $riceData['l_fertilizer_price'])
				->setCellValue('U' . $j, $riceData['ae_yield_permu'])
				->setCellValue('V' . $j, $riceData['ae_planting_stru'])
				->setCellValue('W' . $j, $riceData['ae_area_disasterr'])
				->setCellValue('X' . $j, $riceData['ae_suppose_yield'])
				->setCellValue('Y' . $j, $riceData['ae_actual_yield'])
				->setCellValue('Z' . $j, $riceData['ae_yield_disasterr'])

				->setCellValue('AA' . $j, $riceData['ae_potential_yield_sownaera'])
				->setCellValue('AB' . $j, $riceData['ae_rice_fertilizer'])
				->setCellValue('AC' . $j, $riceData['ae_potential_yield_permu']) 
				->setCellValue('AD' . $j, $riceData['al_yield_permu']) 
				->setCellValue('AE' . $j, $riceData['al_planting_stru']) 
				->setCellValue('AF' . $j, $riceData['al_planting_stru']) 
				->setCellValue('AG' . $j, $riceData['al_suppose_yield']) 
				->setCellValue('AH' . $j, $riceData['al_suppose_yield']) 
				->setCellValue('AI' . $j, $riceData['al_yield_disasterr']) 
				->setCellValue('AJ' . $j, $riceData['al_potential_yield_sownaera']) 
				->setCellValue('AK' . $j, $riceData['al_rice_fertilizer']) 
				->setCellValue('AL' . $j, $riceData['al_potential_yield_permu']) 
				->setCellValue('AM' . $j, $riceData['ay_yield_permu']) 
				->setCellValue('AN' . $j, $riceData['ay_planting_stru'])
				->setCellValue('AO' . $j, $riceData['ay_area_disasterr'])
				->setCellValue('AP' . $j, $riceData['ay_suppose_yield'])
				->setCellValue('AQ' . $j, $riceData['ay_actual_yield'])
				->setCellValue('AR' . $j, $riceData['ay_yield_disasterr'])
				->setCellValue('AS' . $j, $riceData['ay_potential_yield_sownaera'])
				->setCellValue('AU' . $j, $riceData['ay_rice_fertilizer'])
				->setCellValue('AT' . $j, $riceData['ay_potential_yield_permu'])

				->setCellValue('AV' . $j, $riceData['we_price_fluctuation'])
				->setCellValue('AW' . $j, $riceData['we_yield_fluctuation'])
				->setCellValue('AX' . $j, $riceData['we_yield_permu_fluctuation'])
				->setCellValue('AY' . $j, $riceData['we_area_fluctuation'])
				->setCellValue('AZ' . $j, $riceData['wl_price_fluctuation'])
				->setCellValue('BA' . $j, $riceData['wl_yield_fluctuation'])
				->setCellValue('BB' . $j, $riceData['wl_yield_permu_fluctuation'])
				->setCellValue('BC' . $j, $riceData['wl_area_fluctuation'])
				->setCellValue('BD' . $j, $riceData['wy_price_fluctuation'])
				->setCellValue('BE' . $j, $riceData['wy_yield_fluctuation'])
				->setCellValue('BF' . $j, $riceData['wy_yield_permu_fluctuation'])
				->setCellValue('BG' . $j, $riceData['wy_area_fluctuation']);                               					                              	                                      					                              	                                      					                              
			}

			$outfile = date('Y:M:D:H:i:s')."rice.xlsx";

       		 //export to exploer

			header("Content-Type: application/force-download");
			header("Content-Type: application/octet-stream");
			header("Content-Type: application/download");
			header('Content-Disposition:inline;filename="'.$outfile.'"');
			header("Content-Transfer-Encoding: binary");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Pragma: no-cache");
			$objWriter->save('php://output');
		}
	}

	private function addWave($ricedata){
		if(!empty($ricedata)){
			$wave = D("InfoWave");
			return $wave->addWave($ricedata);
		}
		else
			return false;
	}

	/*
	*标记波动水稻为已查看
	*/
	public function checkWave(){
		$wid = I("wave_id");
		$wave = M("InfoWave");
		if ($wave->where("wave_id='$wid'")->delete()){
			$this->success("标记成功");
		}
		else{
			$this->error("标记失败");
		}
	}

	/*
	*显示某一项波动水稻的具体信息
	*/
	public function detailWave(){
		$rid = (int)I("rice_id");
		$wave_id = (int)I("wave_id");
		$rice = D("InfoRice");
		$ricedata = $rice->where("rice_id='$rid'")->find();
		if (!empty($ricedata)){
			$ricedata["dist_name"] = getDistrictNameById($ricedata["dist_id"]);
			$bstatus = $ricedata["rice_status"] & 7;
			$estatus = ($ricedata["rice_status"] >>3 )& 7;
			$lstatus = ($ricedata["rice_status"] >>6 ) & 7;

			$ricedata['brice_status'] = $rice->getRiceState($bstatus);
			$ricedata['erice_status'] = $rice->getRiceState($estatus);
			$ricedata['lrice_status'] = $rice->getRiceState($lstatus);

			$wavedata = $this->getWaveRice();
	    	$ricedata["wave_number"] = count($wavedata);
	    	$disalist = $this->getDisasterData();
	    	$ricedata["disa_number"] = count($disalist);
	    	$ricedata["wave_id"] = $wave_id;
	    	$this->assign("disalist", $disalist);
	    	$this->assign("wavedata", $wavedata);
			$this->assign("ricedata", $ricedata);
			$this->display();
		}
		else{
			$this->error("该项水稻信息不存在");
		}
	}
}
