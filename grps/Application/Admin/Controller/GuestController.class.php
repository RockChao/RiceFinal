<?php
//作者：刘建安
//时间：2014/11/14
namespace Admin\Controller;

class GuestController extends AdminController{
	//显示所有访客的信息
	public function manageGuest (){
		$guest  = D("InfoGuest");
		$guestdata = $guest->where("user_level=3")->select();
		$this->assign("userdata", $guestdata);
	    $disalist = $this->getDisasterData();
	    $ricedata["disa_number"] = count($disalist);
	    $wavedata = $this->getWaveRice();
	    $ricedata["wave_number"] = count($wavedata);
	    $this->assign("wavedata", $wavedata);
	    $this->assign("disalist", $disalist);
	    $this->assign("ricedata", $ricedata);
		$this->display();
	}

		/*  添加新用户，判断信息是否合法
	同一地区只能有一个用户
	 */
	public function addGuest(){
		if (IS_POST){
			/*
			$verify = I("verify")
			if (checkVeriy($verify)){
				$this->error("验证码不正确");	
			}	
			*/
			$data['user_name'] =  I("user_name");
			$data['user_pw'] = I("user_pw");
			$data['user_repw'] = I("user_repw");
			$data["user_level"] = 3;
			
			if (preg_match("/\s/", $data['user_name'] ) || preg_match("/\s/", $data['user_pw'] )) {
    			$this->error("用户名和密码中不能包含空格！");	
			}
			$guest = D("InfoGuest");
			$uid = $guest->addUser($data);
			if ( $uid){
				echo '{
					"info":"添加用户成功",
					"status":"y"
				}';
			}
			else{
				echo '{
					"info":"添加用户失败",
					"status":"n"
				}';
			}
		}
		else{
		   	$disalist = $this->getDisasterData();
		    $ricedata["disa_number"] = count($disalist);
		    $wavedata = $this->getWaveRice();
	   		$ricedata["wave_number"] = count($wavedata);
	    	$this->assign("wavedata", $wavedata);
		    $this->assign("disalist", $disalist);
		    $this->assign("ricedata", $ricedata);
			$this->display();	
		}
	}
	/*   删除用户 ,但不能删除管理员本人 */
	public function deleteGuest(){
		$user_id =(int)I("user_id");
		$user = D('InfoGuest');
		$uid = $user->deleteUser($user_id);
		if ($uid){
			$this->success("删除用户成功！");	
		}
		else{
			$this->error($user->getError());
		}
	}
	
	/* 修改用户信息 */
	public function updateInfo(){
		if (IS_POST){
			$data["user_name"] = I("user_name");
			$data["user_pw"] = I("user_pw");
			$data["user_id"] = I("user_id");
			$user = D('InfoGuest');
			$uid = $user->updateUserInfo($data);			
			if ($uid){
				//$this->success("修改成功！",U("manageGuest"));
				echo '{
					"info":"修改成功",
					"status":"y"
				}';
			}
			else{
				echo '{
					"info":"修改失败",
					"status":"n"
				}';
				//$this->error($user->getError());
			}
		}
		else{
			$user_id = I("user_id");
			$user = D("InfoGuest");
			$userinfo = $user->where("user_id='$user_id'")->find();
		    $disalist = $this->getDisasterData();
		    $ricedata["disa_number"] = count($disalist);
		    $wavedata = $this->getWaveRice();
	    	$ricedata["wave_number"] = count($wavedata);
	    	$this->assign("wavedata", $wavedata);
		    $this->assign("disalist", $disalist);
		    $this->assign("ricedata", $ricedata);
			$this->assign("userinfo", $userinfo);
			$this->display();	
		}
	}

	/*
	检测添加用户时用户名是否合法
	*/
	public function checkName(){
		$name = I("param");
		$oldname = $_GET["user_name"];
		$data = M("InfoUser")->where("user_name='$name' and user_name!='$oldname'")->find();
		if (empty($data)){
			echo '{
				"info":"该用户名可用！",
				"status":"y"
			}';
		}
		else{
			echo '{
				"info":"该用户名已被注册！",
				"status":"n"
			}';
		}
	}
}