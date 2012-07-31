<?php
function smarty_block_php($params, $content, $smarty, &$repeat)
{
	eval($content);
	return '';
}

//End
