<?php
//作者：刘建安
//时间：2014/11/9
namespace Model\Disaster;
use Think\Model;

class InfoDisasterModel extends Model{
	protected $_validate = array(
		array("disa_situ", 'require', "灾情不为空"),
		array("disa_dist", 'require', "受灾地区不为空"),
		array("disa_area", 'require', "受灾面积不为空"),
		array("disa_area", '/^((0-9)+\.([0-9]*[1-9][0-9]*){0,2})$|^([0-9]*[1-9][0-9]*\.([0-9]+){0,2})$|^([0-9]*[1-9][0-9]*)$/u','受灾面积为最多有两位小数的实数',self::EXISTS_VALIDATE,'regex')
	);
	
}