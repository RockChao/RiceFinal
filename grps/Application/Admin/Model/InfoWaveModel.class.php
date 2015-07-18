<?php
//Date: 2014/12/7
//修改：刘建安
namespace Admin\Model;
use Model;

class InfoWaveModel extends  Model\Wave\InfoWaveModel{
	public function addWave($ricedata){
		$flag = 0;
		foreach($ricedata as $key1 => $value1){
			$firstLetter = substr($key1, 0,1);
			if ($firstLetter == "w"){
				if ($value1 > 0.08 and $value1 < 0.15){
					$flag = 1;
					break;
				}
				else if ($value1 > 0.15){
					$flag = 2;
					break;
				}
			}
		}

		if ($flag != 0){
			$wavedata["rice_id"] = $ricedata["rice_id"];
			$wavedata["wave_level"] = $flag;
		}
		else{
			return true;
		}

		if (!empty($wavedata) && $this->create($wavedata)){
			if($this->add($wavedata))
				return true;
			else
				return false;
		}
		else{
			return false;
		}
	}
}
 ?>
