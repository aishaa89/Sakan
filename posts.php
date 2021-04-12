<?php
	session_start();
	$postsStyle='';
	$pageTitle='Posts';
	include 'init.php';
	if (isset($_SESSION['user'])) {
	$stmt=$con->prepare("SELECT  Posts.* , users.UserName as By_user from posts 
inner join users on users.User_ID = posts.	Written_By 


 where status = '1'  ORDER BY post_date  DESC " );
               $stmt->execute(); 

               //Assign to variables

             $p=$stmt->fetchAll();

              // print_r($com);
       //echo'<div class="loading">' .'your post is sent' . '</div>';       
foreach ($p as $p) {


  
 
      echo'  <div class="postsFrame">'. '<br>';

        //echo '<div class= "row">';
         echo'<div class="postFrame">' ;

             echo' <img src="images/users icons/user (1).jpg " class="userImg">';
       
    
           
                echo '<div class="userName">'.$p['By_user'] .'</div>' .'<br>'.' <br>'; 
  
                 echo '<p>' .  $p['Post'] .  '</p>'.' <br>' ;

                 //$timetamp = time();

                 echo '<div class="timeOrDate">'.$p['Post_Date']  . '</div>'."<a href='post_comments.php?postid=" .$p['Post_ID']."' class='btn btn-primary'> comments </a>". '<br>' .'<br>'.'</div>'.'<br>';
                 echo ' </div>';

 }
 	echo'</div class="container">';
				echo'<a href="add_post.php" class="btn btn-primary"><i class="fa fa-plus"></i>Add Post</a>';
		echo'</div>';  
	}else{
		header('location:login.php');
		exit();
	}
	include $tp1.'footer.php';?>