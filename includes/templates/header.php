<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo $pageTitle ?></title>
	<link rel="stylesheet" href="layout/css/bootstrap.min.css">
	<link rel="stylesheet" href="layout/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="layout/css/front.css">
	<!--<link rel='stylesheet' href='layout/css/style.css'/>-->
	<!--<link rel="stylesheet" href="layout/css/flatsStyle.css">--> 
	<link rel='stylesheet' href='layout/css/media.css'/>
	<link rel='stylesheet' href='layout/css/default-theme.css'/>
	<link rel='stylesheet' href='layout/css/hover.css'/>
	<?php
	if(isset($flatStyle)){
	echo'<link href="layout/css/styleLink.css" rel="stylesheet" type="text/css" media="all" />';}
?>
<?php
	if(isset($advertiseStyle)){
	echo'<link href="layout/css/style2.css" rel="stylesheet" type="text/css" media="all" />';}
?>
<?php
	if(isset($postsStyle)){
	echo'<link href="layout/css/posts.css" rel="stylesheet" type="text/css" media="all" />';}
?>
<?php
	if(isset($postStyle)){
	echo'<link href="layout/css/post.css" rel="stylesheet" type="text/css" media="all" />';}
?>
<?php
	if(isset($commentStyle)){
	echo'<link href="layout/css/comment.css" rel="stylesheet" type="text/css" media="all" />';}
?>
	<!-- if IE -->
        <script src="layout/js/html5shiv.min.js"></script>
        <script src="layout/js/respond.min.js"></script>
   <!-- end if -->
</head>
<body>

	