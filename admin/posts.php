<?php
ob_start(); 
session_start();
$pageTitle="posts";
if (isset($_SESSION['userName'])) {
	include 'init.php';
	$do=isset($_GET['do'])? $_GET['do'] : 'manage';
	if ($do=='manage') {
		$stmt=$con->prepare("SELECT posts.*,users.UserName
		 FROM posts
		 INNER JOIN
		 users
		 ON
		 posts.Written_By=users.User_ID");
		//execute the statment
		$stmt->execute(array());
		//assign to variable
		$posts=$stmt->fetchAll();


		?>
		<h1 class="text-center">Manage Posts</h1>
		<div class="container">
			<div class="table-responsive">
				<table class="main-table text-center table table-borderd">
				<tr>
					<td>Post_ID</td>
					<td>Post</td>
					<td>Username </td>
					<td>Control</td>
				</tr>
				<?php
				
				foreach ($posts as $post) {
					echo"<tr>";
					echo"<td>".$post['Post_ID']."</td>";
					echo"<td>".$post['Post']."</td>";
					echo"<td>". $post['UserName']."</td>";
					echo"<td>
                
                    <a href='posts.php?do=edit&postid=".$post['Post_ID']."' class='btn btn-success'><i class='fa fa-edit'></i>Edit</a>
					
					<a href='posts.php?do=delete&postid=".$post['Post_ID']."'class='btn btn-danger'>
					<i class='fa fa-close'></i>Delete</a>";
					
					
					if($post['Status'] == 0){
						echo "<a
						 href='posts.php?do=approve&postid=".$post['Post_ID']."'
						  class='btn btn-info activate'><i class='fa fa-check'>Approve</i></a>";

					}
					echo"</td>";
					echo "</tr>";
				}
				?>
				</table>
			</div>
				<a href="posts.php?do=add" class="btn btn-primary"><i class="fa fa-plus"></i>Add New Post</a>
		</div>
		
	<?php
    }elseif ($do=='add') {?>
		<h1 class='text-center'>New Post </h1>
		<div class="container">
		<form class="form-horizontal" action="?do=insert" method="POST" enctype="multipart/form-data">
	<!--start description field-->
			<div class="form-group form-group-lg">
			<label class="col-sm-2 control-label">Post</label>
				<div class="col-sm-10 col-md-6">
				<textarea  name="post" rows="5" cols="30" style="width:450px; height:96px;" required="required">
				</textarea>

				</div>	
			</div>
		 
	<!-- end description field -->
	<!-- start member field -->	
			<div class="form-group form-group-lg">
				<label class="col-sm-2 control-label">member</label>
				<div class="col-sm-10 col-md-6">
					<select name="member">
						<option value="0">...</option>
						<?php
							$stmt=$con->prepare("SELECT * FROM users");
							$stmt->execute();
							$users=$stmt->fetchAll();
							foreach ($users as $user) {
								echo '<option value="'.$user[User_ID].'">'.$user['UserName']."</option>";
							}

						 ?>
					</select>
				</div>	
			</div>
		 
	<!-- end member field -->
	
	
	<!--start submit field-->
			<div class="form-group form-group-lg">
				<div class="col-sm-offset-2 col-sm-2">
					<input type="submit" value="share" class="btn btn-primary btn-sm">
				</div>
				
			</div>
		</form>
	<!--end submit field-->
		</div>
	<?php }elseif ($do=='insert') {?>
			<h1 class="text-center">Insert Post</h1>
			<div class="container">
			<?php

				$post=$_POST['post'];
				$member=$_POST['member'];
			//validate form
			$formErrors=array();
			if (empty($post)) {
				$formErrors[]='The Post cant be <strong>Empty</strong>';
			}	
			if(empty($member)){
				$formErrors[]='you must choose the <strong> member</strong>';
			}
			//loop into errors array and echo it
			foreach ($formErrors as $error) {
				echo '<div class="alert alert danger">'.$error.'</div>';
			}
			//check if there’s no error proceed the insert operaion
			if (empty($formErrors)) {
			 //insert item info in database
			 	$stmt=$con->prepare("INSERT INTO
			 		posts(Post,Post_Date,Written_By)
			 		VALUES(:zpost,now(),:zuser_id)");
			 	$stmt->execute(array(
			 	'zpost'=>$post,
			 	'zuser_id'=>$member
			 	));
			 //echo success message
			 $theMsg="<div class='alert alert-success'>".$stmt->rowCount().'Record inserted'."</div>";
			 redirectHome($theMsg,'back');			
			 }else{
			 	echo "<div class='container'>";
			 	$theMsg='<div class="alert alert-danger">'.$error .'</div>';
			 	redirectHome($theMsg,'');
			 	echo "</div>";
			 }

				
		echo"</div>";
		

}elseif ($do=='edit') {
//check if get request  item is numeric &get its integer value
	$postid=isset($_GET['postid'])&&is_numeric($_GET['postid'])?intval($_GET['postid']):0;
//select ALL depend on this ID
	$stmt1=$con->prepare("SELECT * FROM posts WHERE Post_ID=?");
//execute quary
	$stmt1->execute(array($postid));
//fetch the data
	$post=$stmt1->fetch();
//the row count 
$count=$stmt1->rowCount();
if($count >0){ ?>
	<h1 class="text-center">Edit Post</h1>
	<div class="container">
		<form class="form-horizontal" action="?do=update" method="POST">
		<input type="hidden" name="postid" value="<?php echo $postid;?>">
		
		
		<!--start description field -->
		<div class="form-group form-group-lg">
			<label class="col-sm-2 contol-label">Post</label>
			<div class="col-sm-10 col-md-6">
				<textarea  name="post" rows="5" cols="30" style="width:450px; height:96px;"/>
				<?php echo $post['Post'];?>
				</textarea>

			</div>
		</div>
		<!--end description field -->
		<!--start member field -->
		<div class="form-group form-group-lg">
			<label class="col-sm-2 control-label">Member</label>
			<div class="col-sm-10 col-md-6">
				<select name="member">
				<?php
					$stmt=$con->prepare("SELECT * FROM users");
					$stmt->execute();
					$users=$stmt->fetchAll();
					foreach ($users as $user) {
						echo "<option value='".$user['User_ID']."'";
						if ($post['Written_By']==$user['User_ID']) {
							echo 'selected';
						}
						echo">".$user['UserName']."</option>";
					}
				?>
					
				</select>
			</div>
		</div>
		<!--end member field -->

		<!--start submit field -->
		<div class="col-sm-offset-2">
			<input type="submit"
				value="Save"
				class ="btn btn-primary btn-sm">
		</div>
		<!--end submit field -->
		</form>
	</div>
	<?php
	}else{
		echo "<div class='container'>";
		$theMsg='<div class="alert alert-danger">there is no such ID</div>';
		redirectHome($theMsg,'');
		echo "</div>";
	}
	
		
}
elseif ($do=='update') {
		echo "<h1 class='text-center'>Update Post</h1>";
		echo "<div class='container'>";
		if ($_SERVER['REQUEST_METHOD']=='POST') {
		//GET variables from  the form
			$id=$_POST['postid'];
			$post=$_POST['post'];
			$member=$_POST['member'];
		//validate the form
		
			$formErrors=array();
			if (empty($post)) {
				$formErrors[]='the post can not be<strong>EMPTY</strong>';
			}
			if (empty($member)) {
				$formErrors[]='you must choose the<strong>Member</strong>';
			}
		// loop into Errors array and echo it
			foreach ($formErrors as $error) {
				echo '<div class="alert alert-danger">'.$error.'</div>';
				}
		//check if there is no Error proceed update operation
			if (empty($formErrors)) {
				$stmt=$con->prepare("UPDATE posts SET
					
					Post=?
					WHERE
					Post_ID=?");
				$stmt->execute(array($post,$id));
				//Echo success message
				$theMsg='<div class="alert alert-success">'.$stmt->rowCount().'record updated'.'</div>';
				redirectHome($theMsg,'back');
					}		
		}else{
			$theMsg="<div class='alert alert-danger'>sorry you can not Browse this page Directly </div>";
				redirectHome($theMsg,'');
		}
		echo"</div>";
	}elseif ($do=='delete') {
		echo "<h1 class='text-center'>Delete Post</h1>";
		echo "<div class='container'>";
		//check if Get request item ID is numeric&& get integer value of it
		$postid=isset($_GET['postid'])&&is_numeric($_GET['postid'])?intval($_GET['postid']):0;
		//select all data depend on this ID
		$check=checkItem('Post_ID','posts',$postid);
		//if there is such ID show the form
		if($check>0){
			$stmt=$con->prepare("DELETE FROM posts WHERE Post_ID=:zid");
			$stmt->bindparam(":zid",$postid);
			$stmt->execute();
		//Echo success message
			$theMsg='<div class="alert alert-success">'.$stmt->rowCount().'record Deleted'.'</div>';
			redirectHome($theMsg,'back');	
		}else{
			$theMsg="<div class='alert alert-danger'>this ID isnot Exist </div>";
			redirectHome($theMsg,'');
		}
		echo "</div>";
		
	}elseif ($do=='approve') {
		echo "<h1 class='text-center'>Approve Post</h1>";
		echo "<div class='container'>";
		//check if Get Request Item ID is numeric&&Get integer value of it
			$postid=isset($_GET['postid'])&&is_numeric($_GET['postid'])?intval($_GET['postid']):0;
		//SELECT all data depend on this ID
		$check=checkItem('Post_ID','posts',$postid);
		//if there such ID show the form
		if ($check>0) {
				$stmt=$con->prepare("UPDATE posts SET Status=1 WHERE Post_ID=?");
				$stmt->execute(array($postid));
		//Echo success message
			$theMsg='<div class="alert alert-success">'.$stmt->rowCount().'record Updated'.'</div>';
			redirectHome($theMsg,'back');		
			}else{
				$theMsg="<div class='alert alert-danger'>this ID isnot Exist </div>";
				redirectHome($theMsg,'');
			}	
		echo "</div>";
	}
	include $tpl.'footer.php';
}
else{
	header('location:index.php');
}
ob_end_flush();
