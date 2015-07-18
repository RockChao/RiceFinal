<?php
//作者：刘建安
//时间：2014/11/8
namespace Guest\Controller;
use Think\Controller;

class RiceController extends UserController{

	public function manageRice(){
		$rice = M("InfoRice");
		$ricedata = $rice->where("rice_status=365")->select();   //得到水稻信息
		foreach($ricedata as  &$value){
			$dist_id = $value['dist_id'];
			$dist_name = getDistrictNameByID($dist_id);
			$value['dist_name'] = $dist_name;   //将地区ID换成地区名
			//显示审核状态
			$value['rice_status'] = getRiceStatus($value['rice_status']);
		}
		$this->assign("ricedata",$ricedata);
		$this->display();	
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

		$ricedata['brice_status'] = $rice->getRiceState($bstatus);
		$ricedata['erice_status'] = $rice->getRiceState($estatus);
		$ricedata['lrice_status'] = $rice->getRiceState($lstatus);
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
		$this->assign("value", $ricedata);
		$this->display();
	}
}
