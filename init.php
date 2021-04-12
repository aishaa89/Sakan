<?php
	include 'admin/connect.php';
	$sessionUser='';
	if (isset($_SESSION['user'])) {
		$sessionUser=$_SESSION['user'];
	}
	//routes
	$tp1='includes/templates/';//template diractory
	$lang='includes/languages/';//language directory
	$func='includes/functions/';//functions directory
	$css='layout/css';//css directory
	$js='layout/js';//js directory
	//include important files
	include $lang.'english.php';
	include $func.'functions.php';
	include $tp1.'header.php';
	include $tp1.'toolbox.php';
	include $tp1.'navbar.php';
?>