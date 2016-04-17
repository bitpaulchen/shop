<?php

/**
 * 验证码
 */
class Captcha {
	/**
	 * 生成验证码
	 * @param $len 码值数量
	 * @param $font_size 内置字体大小
	 */
	public function generate($len=4, $font_size=5) {
		//生成码值
		$chars = '123456789qwertyuiopasdfghjklzxcvbnm';
		//随机取4个
		$captcha_code = '';
		for($i=1; $i<=$len; ++$i) {
			$rand_index = mt_rand(0, strlen($chars)-1);
			$captcha_code .= $chars[$rand_index];
		}
		//保存到SESSION中
		@session_start();
		$_SESSION['captcha_code'] = $captcha_code;

		//获得随机的背景图片
		$bg_file = TOOL_PATH . 'captcha/captcha_bg' . mt_rand(1, 5) . '.jpg';
		//创建画布
		$img = imageCreateFromJPEG($bg_file);
		//图片的大小
		$img_w = imagesx($img);
		$img_h = imagesy($img);

		//操作
		//确定文字颜色
		if (mt_rand(1, 2) == 1) {
			$str_color = imageColorAllocate($img, 0, 0, 0);//黑
		} else {
			$str_color = imageColorAllocate($img, 0xff, 0xff, 0xff);//白
		}

		//计算出字符串位置
		$str_w = $len * imageFontWidth($font_size);
		$str_x = ($img_w-$str_w)/2;
		$str_h = imageFontHeight($font_size);
		$str_y = ($img_h-$str_h)/2;
		//写字符串
		imageString($img, $font_size, $str_x, $str_y, $captcha_code, $str_color);

		//输出
		header('Content-Type: image/png; charset=utf-8');//告知浏览器输出内容为PNG格式的图片
		imagePNG($img);
		//销毁
		imageDestroy($img);
	}

	/**
	 * 验证
	 *
	 * @param $code string 表单所提交的数据
	 *
	 * @return bool
	 */
	public function checkCode($code) {
		@session_start();
		return $code == $_SESSION['captcha_code'];
	}
}