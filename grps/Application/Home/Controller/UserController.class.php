<?php
//Author:Baolei
//Date: 2014/10/5
namespace Home\Controller;
use Think\Controller;
use Think\Model;
use Home\Model\InfoUserModel;


class UserController extends Controller{

	/*登陆页面
	*@param string $user_name
	*@param string $user_pw 
	*/
	public function login(){
		if(IS_POST){
			$data['user_name'] = I("user_name");
			$data['user_pw'] = (I("user_pw"));
			$user = new InfoUserModel;
			
			$result = $user->login($data);
			if ($result){   //登录成功
				if(session('user_level')==2)
					$this->redirect(U("Home/Index/index"),"",0);
				else if (session("user_level") == 1)
					$this->redirect(U("Admin/Index/index"), "", 0);
				else if (session("user_level") == 3)
					$this->redirect(U("Guest/Index/index"), "", 0);
				else
					$this->error("无权访问");
			}
			else    //登录失败
				$this->error($user->getError());		
		}
		else
			$this->display();
	}

	/*登出页面*/
	public function logout()
	{
		$user = new InfoUserModel;
		$user->logout();
        $this->redirect('login');
	}
	
	/*  显示个人信息 */
	public function showInfo(){
		$user = new InfoUserModel;
		$user_id = session('user_id');
		$data = $user->getInfo($user_id);
		$data["user_region"] = getDistrictNameById($data["user_region"]);
		if($data == false)
			$this->error($user->error);
		else{
			$this->assign("userdata", $data);
			$this->display();
		}
	}

	/*更改用户基本信息
	*@param user_phone 手机
	*@param user_address 地址
	*@param user_email 邮箱
	*/
	public function updateUser(){
		$user_id = session('user_id');
		if(!islogin())
			$this->error('您还未登录', U('User/login'));
		//显示当前个人信息
		$user = M('InfoUser');
		$temp = $user->where("user_id = '$user_id'")->getField('user_email,user_phone,user_address,user_name');
		$userdata = current($temp);
		$this->assign("userdata",$userdata);

		if(IS_POST){
			$data['user_id'] = session('user_id');
			$data['user_phone'] = I('user_phone');
			$data['user_address'] = I('user_address');
			$data['user_email'] = I('user_email');	
			$user = new InfoUserModel;
			
			$result = $user->updateUserInfo($data);
			if($result){
				$this->success("修改成功");
			}
			else{
				$this->error($user->getError());
			} 
		}
		else
			$this->display();
	}

	/*
	* 检测电话号码是否可用
	*/
	public function checkPhone(){
		$phone = I("param");
		$oldname = $_GET["user_name"];
		$data = M("InfoUser")->where("user_phone='$phone' and user_name!='$oldname'")->find();
		if (empty($data)){
			echo '{
				"info":"该电话号码可用！",
				"status":"y"
			}';
		}
		else{
			echo '{
				"info":"该电话号码已被注册！",
				"status":"no"
			}';
		}
	}

	/*
	* 检测邮箱是否可用
	*/
	public function checkEmail(){
		$email = I("param");
		$oldname = $_GET["user_name"];
		$data = M("InfoUser")->where("user_email='$email' and user_name!='$oldname'")->find();
		if (empty($data)){
			echo '{
				"info":"该邮箱可用！",
				"status":"y"
			}';
		}
		else{
			echo '{
				"info":"该邮箱已被注册！",
				"status":"n"
			}';
		}
	}

}
