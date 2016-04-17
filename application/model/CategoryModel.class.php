<?php

/**
 * it_category表的操作模型类
 */
class CategoryModel extends Model {

	/**
	 * 获取列表分类信息
	 *
	 */
	public function getList() {
		$sql = "select * from `it_category` ORDER BY sort_order";
		
		return $this->_db->fetchAll($sql);
	}
}