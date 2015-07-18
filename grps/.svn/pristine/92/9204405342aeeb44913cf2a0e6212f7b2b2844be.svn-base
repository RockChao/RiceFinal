<?php
namespace Home\Controller;
use Think\Controller;
class HomeController extends Controller{

	protected function _initialize(){
		if(!isLogin())
			$this->redirect('Home/User/login' );
		else if(session('user_level')!=2&&session('user_level')==1)
			$this->error('无权访问,请先注销管理员账户再登陆');
	}
}