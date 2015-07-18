<?php
//作者：刘建安
//修改时间：2014/10/19
namespace Admin\Controller;
use Think\Controller;

class UserController extends Controller{
	public function index(){
		if (!isset($_SESSION['user_name'])){
			$this->redirect("Index/index",array('cate_id' => 2), 1, "请先登录！");	
		}
	}
	
	public function getDisasterData(){
	    $currentDate = date("Y-m-d H:i:sa", time());
	    $withinOneMonth = date('Y-m-d H:i:sa',strtotime("$currentDate -1 month"));
	    $disaster = M("InfoDisaster");
	    $dist = M("InfoDistrict");
	    $disaData = $disaster->where("disa_status=2")->select();
	    $disalist = array();
	    foreach($disaData as $key1 => $value1){
	    	$dist_id = $value1["disa_dist"];
	    	$tmpData["dist_latitude"] = $dist->where("dist_id='$dist_id'")->getField("dist_latitude");
	    	$tmpData["dist_longitude"] = $dist->where("dist_id='$dist_id'")->getField("dist_longitude");
	    	$tmpData["dist_id"] = $dist_id;
	    	$tmpData["dist_name"] = getDistrictNameById($dist_id);
	    	array_push($disalist, $tmpData);
	    }
	    return $disalist;
	}

	/*  用户注销 */
	public function logout(){
		$user = D("InfoUser");
		$user->logout();	
		 $this->redirect('Home/User/login');
	}
	
	
	/*  显示管理用户的界面 */
	public function manageUser(){
		if (isLogin() != 0 && session('user_level') == 1){
			$user = M("InfoUser");
			$userdata = $user->where("user_level=2")->select();
			foreach($userdata as &$value){
				$value['user_region']= getDistrictNameById($value['user_region']);
			}
			$this->assign("userdata", $userdata);
		    $disalist = $this->getDisasterData();
		    $ricedata["disa_number"] = count($disalist);
		    $wavedata = $this->getWaveRice();
	    	$ricedata["wave_number"] = count($wavedata);
	    	$this->assign("wavedata", $wavedata);
		    $this->assign("disalist", $disalist);
		    $this->assign("ricedata", $ricedata);
			$this->display();	
		}
		else{
			$this->error("请先登录", U('Home/User/login'));
		}
	}
	
	/*  添加新信息员，判断信息是否合法
	同一地区只能有一个用户
	 */
	public function addUser(){
		if (isLogin() != 0 && session('user_level') == 1){
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
				$data['user_phone'] = I("user_phone");
				$data['user_email'] = I("user_email");
				$data['user_address'] = I("user_address");
				$data['user_region'] = (int)I("user_region");
				$data['user_level'] = 2;
						
				if (preg_match("/\s/", $data['user_name'] ) || preg_match("/\s/", $data['user_pw'] )) {
		        	$this->error("用户名和密码中不能包含空格！");	
				}
			
				if(empty($data['user_region']) && !$data['user_region']){
					$this->error("区县必须提供！");	
				}
				$user = D("InfoUser");
				$uid = $user->addUser($data);
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
				$dist = M("InfoDistrict");
			    $distlist = $dist->select();
			    $citylist =  array();
			    foreach($distlist as $key => $value){
			    	if ($value["dist_id"] == $value["dist_belongto"]){
			    		array_push($citylist, $value);
			    	}	
			    }
			    $disalist = $this->getDisasterData();
			    $ricedata["disa_number"] = count($disalist);
			    $wavedata = $this->getWaveRice();
	    		$ricedata["wave_number"] = count($wavedata);
	    		$this->assign("wavedata", $wavedata);
			    $this->assign("disalist", $disalist);
			    $this->assign("ricedata", $ricedata);
			    $this->assign("distlist", $distlist);
			    $this->assign("citylist", $citylist);
				$this->display();	
			}
		}
		else{
			$this->error("请先登录", U('Home/User/login'));
		}
	}
	
	/*   删除用户 ,但不能删除管理员本人 */
	public function deleteUser(){
		if (isLogin() != 0 && session('user_level') == 1){
			$user_id =(int)I("user_id");
			$user = D('InfoUser');
			$uid = $user->deleteUser($user_id);
			if ($uid){
				$this->success("删除用户成功！");	
			}
			else{
				$this->error($user->getError());
			}
		}
		else{
			$this->error("请先登录", U('Home/User/login'));
		}
	}
	
	/* 修改用户信息 */
	public function updateInfo(){
		if (isLogin() != 0 && session('user_level') == 1){
			if (IS_POST){
				$data["user_region"] = getDistrictIdByName(I("user_region"));
				$data["user_name"] = I("user_name");
				$data["user_pw"] = I("user_pw");
				$data["user_phone"] = I("user_phone");
				$data['user_email'] = I('user_email');
				$data["user_address"] = I("user_address");
				$data["user_id"] = I("user_id");
				$user = D('InfoUser');
				
				$uid = $user->updateUserInfo($data);			
				if ($uid > 0){
					$this->success("修改成功！");
				}
				else{
					$this->error($user->getError());
				}
			}
			else{
				$user_id = I("user_id");
				$user = M("InfoUser");
				$userinfo = $user->where("user_id='$user_id'")->find();
				$userinfo['user_region'] = getDistrictNameById($userinfo['user_region']);
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
		else{
			$this->error("请先登录", U('Home/User/login'));
		}
	}
	
	/*
	修改管理员密码
	*/
	public function changeAdminPassword(){
		if (isLogin() != 0 && session('user_level') == 1){
			if(IS_POST){
				$data["user_id"] = I("user_id");
				$data["user_pw"] = I("user_npw");
				$data["user_pw"] = I("user_nnpw");
				$user = D("InfoUser");
				if ($user->changeAdminPassword($data)){
					
				echo $data["user_pw"];
				echo $data["user_npw"];
				echo $data["user_nnpw"];

				}
				else{
					$this->error($user->getError());
				}			}
			else
			{
				$this->assign("data", $data);
				$this->display();
			}
		}
		else{
			$this->error("请先登录", U('Home/User/login'));
		}
	}

	/*
	用于动态检测用户名是否可用
	*/
	public function checkName(){
		$user = M("InfoUser");
		$username = I("param");
		$oldname = $_GET["user_name"];
		//$oldname = 2;
		//$oldname = "wwwwww";
		$nameData = $user->where("user_name='$username' and user_name!='$oldname'")->find();
		if (empty($nameData)) {
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

	/*
	用于动态检测手机号是否可用
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
	用于动态检测邮箱是否可用
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

	/*
	返回infowave表里的所有数据
	*/
	private function getWaveRice(){
		$waveRice = M("InfoWave");
		$rice = M("InfoRice");
		$dist = M("InfoDistrict");
		$wavedata = $waveRice->select();
		foreach($wavedata as &$value){
			$rid = $value["rice_id"];
			$dist_id = $rice->where("rice_id='$rid'")->getField("dist_id");
			$value["dist_latitude"] = $dist->where("dist_id='$dist_id'")->getField("dist_latitude");
			$value["dist_longitude"] = $dist->where("dist_id='$dist_id'")->getField("dist_longitude");
			$value["dist_name"] = getDistrictNameById($dist_id);
			$value["dist_id"] = $dist_id;
			if ($value["wave_level"] == 1){
				$value["level"] = "黄色预警";
			}
			else if ($value["wave_level"] == 2){
				$value["level"] = "红色预警";
			}
		}
		return $wavedata;
	}
}
?>