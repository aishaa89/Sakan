<?php
ob_start(); 
session_start();
$pageTitle="contacts";
if (isset($_SESSION['userName'])) {
	include 'init.php';
	
		$stmt=$con->prepare("SELECT contact.*,users.*
		 FROM contact
		 INNER JOIN
		 users
		 ON
		 contact.User_Id=users.User_ID");
		//execute the statment
		$stmt->execute(array());
		//assign to variable
		$contacts=$stmt->fetchAll();


		?>
		<h1 class="text-center">Manage Messages</h1>
		<div class="container">
			<div class="table-responsive">
				<table class="main-table text-center table table-borderd">
				<tr>
					<td>Contact_ID</td>
					
					<td>Username </td>
					<td>PhoneNumber</td>
					<td>Message</td>
				</tr>
				<?php
				
				foreach ($contacts as $contact) {
					echo"<tr>";
					echo"<td>".$contact['Contact_ID']."</td>";
					echo"<td>".$contact['UserName']."</td>";
					echo"<td>". $contact['PhoneNumber']."</td>";
					echo"<td>".$contact['Message']."</td>";
					echo "</tr>";
				}
				?>
				</table>
			</div>
			<?php
			include $tpl.'footer.php';
			}else{
	header('location:index.php');
}
ob_end_flush();
?>