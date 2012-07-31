<?php
function smarty_modifier_big_char($n) 
{
	$str = '';
	$map = array('零', '壹', '贰', '叁', '肆', '伍', '陆', '柒', '捌', 
		'玖', '拾');

	$n = (string)$n;
	$count = mb_strlen($n, 'utf-8');
	for ($i = 0; $i < $count; $i++)
	{
		$str .= (is_numeric($n[$i])) ? $map[$n[$i]] : $n[$i];
	}

	return $str;
}

//End
