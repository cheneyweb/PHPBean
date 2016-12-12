<?php
	// $_SERVER ["DOCUMENT_ROOT"]
	$PHP_SELF=$_SERVER['PHP_SELF'];
	$url='http://'.$_SERVER['HTTP_HOST'].substr($PHP_SELF,0,strrpos($PHP_SELF,'/')+1);
	echo $url;
?>
