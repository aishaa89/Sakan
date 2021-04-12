<?php
session_start();
//error_reporting(0);
	//$advertiseStyle='';
	$pageTitle='order';
	include 'init.php';
	if (isset($_SESSION['user'])) {
		$getUser=$con->prepare("SELECT * FROM users WHERE Username=?");
		$getUser->execute(array($sessionUser));
		$info=$getUser->fetch();
		//check if get request  item is numeric &get its integer value
	$itemid=isset($_GET['itemid'])&&is_numeric($_GET['itemid'])?intval($_GET['itemid']):0;
//select ALL depend on this ID
	$stmt1=$con->prepare("SELECT * FROM items WHERE Item_ID=?");
//execute quary
	$stmt1->execute(array($itemid));
//fetch the data
	$item=$stmt1->fetch();

	$user    = $info['User_ID'];
	$item    =$item['Item_ID'] ;

	 $stmt=$con->prepare("INSERT INTO
			 		orders(User_Id,Item_Id)
			 		VALUES(:zuser,:zitem)");
			 	$stmt->execute(array(
			 	'zuser'=>$user,
			 	'zitem'=>$item

			 	)); 	


		//Echo success message
				echo"<div class='alert alert-success'>".'The order is sent successfuly and we will conect with you soon'."</div>";
	
	?>

	<?php
	}else{
		header('location:login.php');
		exit();
	}
	include $tp1.'footer.php';?>