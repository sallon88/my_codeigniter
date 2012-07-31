<?php
/**
 * 使用GD函数实现生成验证码
 */
session_start();

//创建画布和背景
$im = imagecreatetruecolor(100, 30);
$bgcolor = imagecolorallocate($im, 250, 250, 250);
$bdcolor = imagecolorallocate($im, 200, 200, 200);

imagefill($im, 0, 0, $bgcolor);
imagerectangle($im, 0, 0, 99, 29, $bdcolor);

//生成干挠像素点
for ($i = 0; $i < 500; $i++)
{
	$rand_color = imagecolorallocate($im, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
	imagesetpixel($im, mt_rand(0, 100), mt_rand(0, 30), $rand_color);
}

//生成干挠线
for ($i =0; $i < 5; $i++)
{
	$rand_color = imagecolorallocate($im, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
	$x1 =  mt_rand(0, 100);
	$y1 = mt_rand(0, 30);
	$x2 =  mt_rand(0, 100);
	$y2 = mt_rand(0, 30);
	imageline($im, $x1, $y1, $x2, $y2, $rand_color);
}

//生成随机验证码
$alphanum = array_merge(range(0, 9), range('A', 'Z'));

//过滤相似字符
$similar = array(0, 1, 2, 5, 'I', 'O', 'Q', 'S', 'U', 'V', 'Z'); 
$alphanum = array_diff($alphanum, $similar);

shuffle($alphanum);


//将随机验证码写入图像
$text = '';
for ($i = 0; $i < 4; $i++)
{
	$rand_color = imagecolorallocate($im, mt_rand(0, 150), mt_rand(0, 150), mt_rand(0, 150));
	putenv('GDFONTPATH=' . realpath('.'));
	imagettftext($im, 16, mt_rand(-45, 45), $i*20+10, 23, $rand_color, 'segoepr.ttf', $alphanum[$i]); 
	$text .= $alphanum[$i];
}

//将验证码写入session
$_SESSION['captcha'] = $text;

//输出图像
header('Content-Type:image/jpeg');
imagejpeg($im);

//释放资源
imagedestroy($im);

/* End of file 3.php */
