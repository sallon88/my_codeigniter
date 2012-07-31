<?php
function smarty_modifier_tran_status($n) 
{
	$map = array(
		0 => '禁用',
		1 => '启用'
		);

	return $map[(int)$n];
}

//End
