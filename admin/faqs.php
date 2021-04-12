<?php
ob_start(); 
session_start();
$pageTitle="Faqs";
if (isset($_SESSION['userName'])) {
	include 'init.php';
	$do=isset($_GET['do'])? $_GET['do'] : 'manage';
	if ($do=='manage') {
		$stmt=$con->prepare("SELECT *
		 FROM faqs");
		//execute the statment
		$stmt->execute(array());
		//assign to variable
		$faqs=$stmt->fetchAll();


		?>
		<h1 class="text-center">Manage FAQS</h1>
		<div class="container">
			<div class="table-responsive">
				<table class="main-table text-center table table-borderd">
				<tr>
					<td>Faq_ID</td>
					<td>Question</td>
					<td>Answer </td>
					<td>Control</td>
				</tr>
				<?php
				
				foreach ($faqs as $faq) {
					echo"<tr>";
					echo"<td>".$faq['Faq_ID']."</td>";
					echo"<td>".$faq['Question']."</td>";
					echo"<td>". $faq['Answer']."</td>";
					echo"<td>
                
                    <a href='faqs.php?do=edit&faqid=".$faq['Faq_ID']."' class='btn btn-success'><i class='fa fa-edit'></i>Edit</a>
					
					<a href='faqs.php?do=delete&faqid=".$faq['Faq_ID']."'class='btn btn-danger'>
					<i class='fa fa-close'></i>Delete</a>";
					
					
					if($faq['Share'] == 0){
						echo "<a
						 href='faqs.php?do=share&faqid=".$faq['Faq_ID']."'
						  class='btn btn-info activate'><i class='fa fa-check'>Share</i></a>";

					}
					echo"</td>";
					echo "</tr>";
				}
				?>
				</table>
			</div>
				<a href="faqs.php?do=add" class="btn btn-primary"><i class="fa fa-plus"></i>Add New Faq</a>
		</div>
		
	<?php
    }elseif ($do=='add') {?>
		<h1 class='text-center'> Add New Faq </h1>
		<div class="container">
		<form class="form-horizontal" action="?do=insert" method="POST" >
	<!--start description field-->
			<div class="form-group form-group-lg">
			<label class="col-sm-2 control-label">Question</label>
				<div class="col-sm-10 col-md-6">
				<textarea  name="question" rows="5" cols="30" style="width:450px; height:96px;" required="required">
				</textarea>

				</div>	
			</div>
		 
	<!-- end description field -->
<!--start description field-->
			<div class="form-group form-group-lg">
			<label class="col-sm-2 control-label">Answer</label>
				<div class="col-sm-10 col-md-6">
				<textarea  name="answer" rows="5" cols="30" style="width:450px; height:96px;" required="required">
				</textarea>

				</div>	
			</div>
		 
	<!-- end description field -->
	
	
	<!--start submit field-->
			<div class="form-group form-group-lg">
				<div class="col-sm-offset-2 col-sm-2">
					<input type="submit" value="save" class="btn btn-primary btn-sm">
				</div>
				
			</div>
		</form>
	<!--end submit field-->
		</div>
	<?php }elseif ($do=='insert') {?>
			<h1 class="text-center">Insert Faq</h1>
			<div class="container">
			<?php

				$question=$_POST['question'];
				$answer=$_POST['answer'];
			//validate form
			$formErrors=array();
			if (empty($question)) {
				$formErrors[]='The question cant be <strong>Empty</strong>';
			}	
			if(empty($answer)){
				$formErrors[]='The Answer cant be <strong>Empty</strong>';
			}
			//loop into errors array and echo it
			foreach ($formErrors as $error) {
				echo '<div class="alert alert danger">'.$error.'</div>';
			}
			//check if there’s no error proceed the insert operaion
			if (empty($formErrors)) {
			 //insert item info in database
			 	$stmt=$con->prepare("INSERT INTO
			 		faqs(Question,Answer,Share)
			 		VALUES(:zquestion,:zanswer,0)");
			 	$stmt->execute(array(
			 	'zquestion'=>$question,
			 	'zanswer'=>$answer
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
	$faqid=isset($_GET['faqid'])&&is_numeric($_GET['faqid'])?intval($_GET['faqid']):0;
//select ALL depend on this ID
	$stmt1=$con->prepare("SELECT * FROM faqs WHERE Faq_ID=?");
//execute quary
	$stmt1->execute(array($faqid));
//fetch the data
	$faq=$stmt1->fetch();
//the row count 
$count=$stmt1->rowCount();
if($count >0){ ?>
	<h1 class="text-center">Edit Faq</h1>
	<div class="container">
		<form class="form-horizontal" action="?do=update" method="POST">
		<input type="hidden" name="faqid" value="<?php echo $faqid;?>">
		
		
		<!--start description field -->
		<div class="form-group form-group-lg">
			<label class="col-sm-2 contol-label">Question</label>
			<div class="col-sm-10 col-md-6">
				<textarea  name="question" rows="5" cols="30" style="width:450px; height:96px;"/>
				<?php echo $faq['Question'];?>
				</textarea>

			</div>
		</div>
		<!--end description field -->
		<!--start description field -->
		<div class="form-group form-group-lg">
			<label class="col-sm-2 contol-label">Answer</label>
			<div class="col-sm-10 col-md-6">
				<textarea  name="answer" rows="5" cols="30" style="width:450px; height:96px;"/>
				<?php echo $faq['Answer'];?>
				</textarea>

			</div>
		</div>
		<!--end description field -->

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
		echo "<h1 class='text-center'>Update Faq</h1>";
		echo "<div class='container'>";
		if ($_SERVER['REQUEST_METHOD']=='POST') {
		//GET variables from  the form
			$id=$_POST['faqid'];
			$question=$_POST['question'];
			$answer=$_POST['answer'];
		//validate the form
		
			$formErrors=array();
			if (empty($question)) {
				$formErrors[]='the question can not be<strong>EMPTY</strong>';
			}
			if (empty($answer)) {
				$formErrors[]='the answer can not be<strong>EMPTY</strong>';
			}
		// loop into Errors array and echo it
			foreach ($formErrors as $error) {
				echo '<div class="alert alert-danger">'.$error.'</div>';
				}
		//check if there is no Error proceed update operation
			if (empty($formErrors)) {
				$stmt=$con->prepare("UPDATE faqs SET
					
					Question=?,
					
					Answer=?
					WHERE
					Faq_ID=?
					");
				$stmt->execute(array($question,$answer,$id));
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
		echo "<h1 class='text-center'>Delete Faq</h1>";
		echo "<div class='container'>";
		//check if Get request item ID is numeric&& get integer value of it
		$faqid=isset($_GET['faqid'])&&is_numeric($_GET['faqid'])?intval($_GET['faqid']):0;
		//select all data depend on this ID
		$check=checkItem('Faq_ID','faqs',$faqid);
		//if there is such ID show the form
		if($check>0){
			$stmt=$con->prepare("DELETE FROM faqs WHERE Faq_ID=:zid");
			$stmt->bindparam(":zid",$faqid);
			$stmt->execute();
		//Echo success message
			$theMsg='<div class="alert alert-success">'.$stmt->rowCount().'record Deleted'.'</div>';
			redirectHome($theMsg,'back');	
		}else{
			$theMsg="<div class='alert alert-danger'>this ID isnot Exist </div>";
			redirectHome($theMsg,'');
		}
		echo "</div>";
		
	}elseif ($do=='share') {
		echo "<h1 class='text-center'>Share Faq</h1>";
		echo "<div class='container'>";
		//check if Get Request Item ID is numeric&&Get integer value of it
			$faqid=isset($_GET['faqid'])&&is_numeric($_GET['faqid'])?intval($_GET['faqid']):0;
		//SELECT all data depend on this ID
		$check=checkItem('Faq_ID','faqs',$faqid);
		//if there such ID show the form
		if ($check>0) {
				$stmt=$con->prepare("UPDATE faqs SET Share=1 WHERE Faq_ID=?");
				$stmt->execute(array($faqid));
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
