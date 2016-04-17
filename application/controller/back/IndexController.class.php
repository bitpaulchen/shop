<?php

/**
 * 后台首页相关控制器类
 */
class IndexController extends PlatformController {

	public function index() {
		//判断当前是否登录
		//new SessionDB;
//		if (!isset($_SESSION['is_login']) || $_SESSION['is_login']!='yes') {
			//没有登录
		/*if (!isset($_SESSION['admin']))	{
			$this->_jump('index.php?p=back&c=admin&a=login','nomessage');
		}*/

		include CURRENT_VIEW_PATH.'index.html';
	}

	public function top(){
		include CURRENT_VIEW_PATH.'top.html';
	}

	public function menu(){
		include CURRENT_VIEW_PATH.'menu.html';
	}

	public function drag(){
		include CURRENT_VIEW_PATH.'drag.html';
	}

	public function main(){
		include CURRENT_VIEW_PATH.'main.html';
	}




}