<?php
ob_start(); 
session_start();
$pageTitle="opinions";
if (isset($_SESSION['userName'])) {
	include 'init.php';
	$do=isset($_GET['do'])? $_GET['do'] : 'manage';
	if ($do=='manage') {
		$stmt=$con->prepare("SELECT * from opinions");
		//execute the statment
		$stmt->execute(array());
		//assign to variable
		$opinions=$stmt->fetchAll();


		?>
		<h1 class="text-center">Manage opinions</h1>
		<div class="container">
			<div class="table-responsive">
				<table class="main-table text-center table table-borderd">
				<tr>
					<td>Opinion_ID</td>
					<td>Opinion</td>
					<td>Username </td>
					<td>Control</td>
				</tr>
				<?php
				
				foreach ($opinions as $opinion) {
					echo"<tr>";
					echo"<td>".$opinion['Opinion_ID']."</td>";
					
					echo"<td>" .$opinion['Opinion']."</td>";
					
					echo"<td>". $opinion['UserName']."</td>";
					echo"<td>
                
                    
					
					<a href='opinions.php?do=delete&opinionid=".$opinion['Opinion_ID']."'class='btn btn-danger'>
					<i class='fa fa-close'></i>Delete</a>";
					
					
					if($opinion['Share'] == 0){
						echo "<a
						 href='opinions.php?do=share&opinionid=".$opinion['Opinion_ID']."'
						  class='btn btn-info Share'><i class='fa fa-check'>Share</i></a>";

					}
					echo"</td>";
					echo "</tr>";
				}
				?>
				</table>
			</div>
				
		</div>
		
	<?php
   }elseif ($do=='delete') {
		echo "<h1 class='text-center'>Delete Opinion</h1>";
		echo "<div class='container'>";
		//check if Get request item ID is numeric&& get integer value of it
		$opinionid=isset($_GET['opinionid'])&&is_numeric($_GET['opinionid'])?intval($_GET['opinionid']):0;
		//select all data depend on this ID
		$check=checkItem('Opinion_ID','opinions',$opinionid);
		//if there is such ID show the form
		if($check>0){
			$stmt=$con->prepare("DELETE FROM opinions WHERE Opinion_ID=:zid");
			$stmt->bindparam(":zid",$opinionid);
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
		echo "<h1 class='text-center'>Share Opinion</h1>";
		echo "<div class='container'>";
		//check if Get Request Item ID is numeric&&Get integer value of it
			$opinionid=isset($_GET['opinionid'])&&is_numeric($_GET['opinionid'])?intval($_GET['opinionid']):0;
		//SELECT all data depend on this ID
		$check=checkItem('Opinion_ID','opinions',$opinionid);
		//if there such ID show the form
		if ($check>0) {
				$stmt=$con->prepare("UPDATE opinions SET Share=1 WHERE Opinion_ID=?");
				$stmt->execute(array($opinionid));
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
