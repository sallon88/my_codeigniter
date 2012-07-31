<?php
function smarty_function_myform($params, $smarty)
{
	$r = $params['r'] ?: 3;
	$c = $params['c'] ?: 4;

	$str = '<table width="50%" border="1" cellspacing="1">';
	for ($i = 0; $i < $r; $i++)
	{
		$str .= '<tr>';
		for ($j = 0; $j < $c; $j++)
		{
			$str .= '<td>&nbsp;</td>';
		}
		$str .= '</tr>';
	}
	$str .= '</table>';

	return $str;
}

//End
