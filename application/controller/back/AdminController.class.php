<?php
/**
 * 管理员管理控制器类,管理员添加，删除等等
 */
class AdminController extends PlatformController {

	/**
	 * 登录表单的展示
	 */
	public function login() {
		//不需要数据

		//展示登录表单模板即可
		include CURRENT_VIEW_PATH . 'login.html';
	}

	public function captcha(){
		$tool_captcha = new Captcha;
		$tool_captcha->generate();
	}

	/**
	 * 验证管理员信息是否正确
	 */
	public function signin() {
		header('Content-Type: text/html; charset=utf-8');
		//收集表单数据
		$tool_captcha = new Captcha;
		if(!$tool_captcha->checkCode($_POST['captcha'])){
			/*echo "post的值",$_POST['captcha'];
			echo "<hr>";
			echo "session的值",$_SESSION['captcha_code'];
			echo "<hr>";*/
			$this->_jump('index.php?p=back&c=admin&a=login','验证码错误',5);
		}
		$admin_name = $_POST['username'];
		$admin_pass = $_POST['password'];

		//调用模型，完成数据的验证
		$model_admin = new AdminModel;
		if ($admin_info = $model_admin->check($admin_name, $admin_pass)) {
			//合法
			//设置登录凭证
			//$is_login = 'yes';
			//setCookie('is_login', 'yes', time()+3600);//有效期为一小时
//			echo '管理员合法';
			new SessionDB;
			//$_SESSION['is_login']='yes';
			$_SESSION['admin'] = $admin_info; 
			unset($_SESSION['admin']['admin_pass']);
			$this->_jump('index.php?p=back&c=index&a=index');
		} else {
			//非法
			$this->_jump('index.php?p=back&c=admin&a=login', '管理员用户名或密码错误', 3);
		}
	}
}