<?php
/**
*分类控制器类
*/
class CategoryController extends PlatformController{
	//分类列表
	public function show(){
		$model_category = new CategoryModel;
		$list  = $model_category->getlist();

		include CURRENT_VIEW_PATH.'cat_list.html';
	}
}

?>