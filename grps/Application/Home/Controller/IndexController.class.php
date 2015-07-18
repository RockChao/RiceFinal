<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller{
/*
*未登录则重定向到User的login
*已经登录加载主页
*/
  public function index ()
  {
  	if(islogin() && $_SESSION["user_level"] == 2)
  		$this->display();
  	else
    	$this->redirect('Home/User/login' );
  }
}