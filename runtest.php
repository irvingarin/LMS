<?php 
	$result = shell_exec(__DIR__."/cpp/test.exe");//
		//echo $result;

?>
<textarea><?=$result?></textarea>