<?php
/**
 * Generate Auto Number for Documents
 *
 * @param $t type
 */
if (! function_exists('AutoGenDocNumber')) {
	function AutoGenDocNumber($t)
	{
        $n = App\Model\AutoFomatNumber::find(1);

	    return $n;
	}
}
