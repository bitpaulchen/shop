<?php
/**
*session入库工具类，工具类是完成一个特定功能的类
*/
class SessionDB{
	private $_db;
	/**
	*构造方法，实例化时，开启session机制
	*/
	public function __construct(){
		ini_set('session.save_handler','user');
		session_set_save_handler(
			array($this,'sess_open'),
			array($this,'sess_close'),
			array($this,'sess_read'), 
			array($this,'sess_write'), 
			array($this,'sess_destroy'), 
			array($this,'sess_gc')
			);
		@session_start();
	} 

	public function sess_open(){
		$this->_db = MySQLDB::getInstance($GLOBALS['config']['db']);//第二次出错导致数据库连接出错
	}

	public function sess_close(){
		return true;
	}

	public function sess_read($sess_id){
		$sql = "select sess_data from `it_session` where sess_id='$sess_id'";//第一次出错，导致传递sessionid
		return (string)$this->_db->fetchColumn($sql);
	}

	public function sess_write($sess_id,$sess_data){
		$expires = time();
		$sql = "replace into  `it_session` values ('$sess_id','$sess_data','$expires')";
		$this->_db->query($sql);
	}

	public function sess_destroy($sess_id){
		$sql = "delete from `it_session` where $sess_id='sess_id'";
		$this->_db->query($sql);
	}

	public function sess_gc($amx_lifetime){
		$now = time();
		$sql = "delete from `it_session` where expires<$now-$max_lifetime";
		$this->_db->query($sql);
	}

}

?>