<?php
//作者：刘建安
//时间：2014/11/17
namespace Admin\Model;

class InfoGuestModel extends InfoUserModel{
	protected $tableName = 'info_user'; 
	protected $_validate = array(
		/* 验证用户名 */
		array('user_name','require',"用户名必须提供"),  //用户名必须存在
		array('user_name','',"该用户名已存在",self::EXISTS_VALIDATE,'unique'),//用户名已存在
		array('user_name','1,20',"用户名长度必须为1到20个字符",self::EXISTS_VALIDATE,'length'),//用户名长度不合法,
		
		/* 验证密码 */
		array('user_pw','require',"密码必须提供"),
		array('user_pw','6,16',"密码长度必须为6~16位",self::EXISTS_VALIDATE,'length'),  //密码长度必须为6~16
		array('user_repw','user_pw',"确认密码不相同",0,'confirm'),  //确认密码相同
 	);
}