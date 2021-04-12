<?php
	session_start();
	$commentStyle='';
	$pageTitle='Post_Comments';
	include 'init.php';

$post_id=isset($_GET['postid'])&&is_numeric($_GET['postid'])?intval($_GET['postid']):0;

$stmt1=$con->prepare("SELECT * FROM posts WHERE Post_ID=?");
//execute quary
	$stmt1->execute(array($post_id));
//fetch the data

$post=$stmt1->fetch();
//print_r($post);

	if (isset($_SESSION['user'])) {
		$getUser=$con->prepare("SELECT * FROM users WHERE Username=?");
		$getUser->execute(array($sessionUser));
		$info=$getUser->fetch();
	?>
	<div class="container">
  <div class="addcomment">

  
<div class="col-md-offset-2" >
  
  
    <form  method="POST">
    
    <textarea  placeholder="add comment" type="text" name="comment">
        </textarea>
    <input class="btn btn-primary" type="submit" value="Add commment">
    </form>
     </div> 
    </div>

     </div>

    <?php
     if($_SERVER['REQUEST_METHOD']=='POST'){
            $comment   =filter_var($_POST['comment'],FILTER_SANITIZE_STRING);
            $postId=$post['Post_ID'];
            $writterId=$info['User_ID'];
            
          
         if(! empty($comment)){
             $stmt = $con->prepare("INSERT INTO
   post_comments (Comment,Post_Id,Comment_Writter)
             VALUES(:zcomment,:zpostId,:zwritterId)");
             
             $stmt->execute(array(
             
             'zcomment' => $comment,
                'zpostId'=> $postId ,
                 'zwritterId'=>$writterId
             
             ));
             if($stmt){
                 
                 echo '<div class="alert alert-success">Comment Added </div>';
             }
             
         }   
            
        }
        
             $stmt=$con->prepare("SELECT post_comments.*,users.UserName
								FROM post_comments 
								INNER JOIN
								 users
								 ON
								 post_comments.Comment_Writter=users.User_ID 
								WHERE
								Post_Id = ?
								ORDER BY
								 PostComment_ID DESC " );
               $stmt->execute(array($post['Post_ID'])); 
                 $comments=$stmt->fetchAll();
    
     foreach($comments as $comment){ ?>

                         <div class="container">
	                          <div class="comment-box">
		                         <div class="row">
			                      <div class="col-md-3 ">
			                           <img class="img-responsive img-thumbnail img-circle center-block" src="images/users icons/user (1).jpg">
			                     
			                    <?php echo $comment['UserName']?></div>
		                        <div class="col-md-9"><p class="lead"><?php echo $comment['Comment']?></p></div>
									</div>
    							</div>
 						 </div>         
  <?php
   }
   }

	include $tp1.'footer.php';?>