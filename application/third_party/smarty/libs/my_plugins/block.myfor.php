<?php
function smarty_block_php($params, $content, $smarty, &$repeat)
{
	return eval($content);
}

//End
