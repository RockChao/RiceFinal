<?php
//访客的Model
//作者：刘建安
//时间：2014/11/8
namespace Guest\Model;
use Model;
class InfoUserModel extends Model\User\InfoUserModel{      
    public function index(){
    }
     public function updateUserInfo($data){
     	
    }
    /*
	*获取用户信息
	*@param interger $user_id
	*return array $info 成功
	*       integer -1 失败
	*/
	public function getInfo($user_id){
		$info = $this->where("user_id = '$user_id'")->select();
		if(!empty($info)&&$info) 
			return $info[0];
		 else{
		 	$this->error = "获取信息失败";
		 	return false;
		 }
	}
}
?>