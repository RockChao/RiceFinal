<?php
//作者：刘建安
//时间：2014/10/12
namespace Model\City;
use Think\Model;

class InfoDistrictModel extends Model{
	public function index(){
	}	
	protected $_auto  = array(
		array("dist_account_num", 0)
	);
}
?>