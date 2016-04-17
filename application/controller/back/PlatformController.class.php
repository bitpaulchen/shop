<?php
/**
*后台平台控制器，仅被后台访问，被几乎后台所有功能共享
*/
class PlatformController extends Controller{

	public function __construct(){
		$this->_initSession();
		$this->_checkSignin();

	}
	//初始化session
	protected function _initSession(){
		new SessionDB;
	}

	//验证是否登录

	protected function _checkSignin(){
		$no_check = array(
			'admin'=> array('login','signin','captcha'));
			//控制器=>动作
			if(isset($no_check[CONTROLLER])&&in_array(ACTION, $no_check[CONTROLLER])){
				return;
			}
		if(!isset($_SESSION['admin'])){
			$this->_jump('index.php?p=back&c=admin&a=login');
		}
	}
}

?>