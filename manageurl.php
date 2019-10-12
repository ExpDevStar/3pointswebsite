<?php
	$url 	= $_GET['file'];
	$urlArr = explode('/', $url);
	$file 	= end($urlArr);
	include_once($file);
?>