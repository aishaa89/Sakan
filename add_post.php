<?php
	session_start();
	$postStyle='';
	$pageTitle='add_post';
	include 'init.php';
	if (isset($_SESSION['user'])) {
		$getUser=$con->prepare("SELECT * FROM users WHERE Username=?");
		$getUser->execute(array($sessionUser));
		$info=$getUser->fetch();
	?>
	<div class="mainFrame" >
		<img src="images/users icons/user (14).png">
		<div class="userName">  </div>
		<br>

		<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method = "POST">
		<textarea name="textarea"  placeholder = "هل تريد الإعلان عن حاجتك لسكن؟ "></textarea>
		 <br>
		 <input class="post" type="submit" name="post" value="post">

		<!-- <input class="cancel" type="submit" name="cancel" value="cancel">-->

		 </form>
  
	</div>
	<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	$post  = filter_var($_POST['textarea'], FILTER_SANITIZE_STRING);
	$writter=$info['User_ID'];

if (! empty($post)){

	$stmt = $con-> prepare ("INSERT INTO posts (Post, Status, Post_Date,Written_By )

     VALUES ( :zpost, 0, now(), :zuser)");

$stmt->execute(array(


'zpost' => $post,
'zuser'=>$writter

));
if ($stmt){

//echo'<div class="loading">' .'your post is sent' . '</div>';

header('location: posts.php' );

	
}


}else{
	echo"<div class='alert alert-danger'>".'The Post cant be <strong>Empty</strong>'."</div>";
}

}

 ?>

	<?php
	}
	include $tp1.'footer.php';?>