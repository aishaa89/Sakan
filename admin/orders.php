<?php
ob_start(); 
session_start();
$pageTitle="oredrs";
if (isset($_SESSION['userName'])) {
	include 'init.php';
	$do=isset($_GET['do'])? $_GET['do'] : 'manage';
	if ($do=='manage') {
        /*$stmt=$con->prepare("SELECT * FROM orders ");*/
		$stmt=$con->prepare("SELECT 
                                 orders.*,
                                 users.*,
                                 items.*
		                     FROM 
                                 orders
		                     INNER JOIN
                                  users 
                             ON  
                                  users.User_ID=orders.User_Id 
                             INNER JOIN 
                                  items
                             ON 
                                  items.Item_ID= orders.Item_Id");
        
		//execute the statment
		$stmt->execute(array());
		//assign to variable
		$orders=$stmt->fetchAll();


		?>
		<h1 class="text-center">Manage Orders</h1>
		<div class="container">
			<div class="table-responsive">
				<table class="main-table text-center table table-borderd">
				<tr>
					<td>Order_ID</td>
					<td>User_ID</td>
					<td>Item_ID</td>
					<td>UserName</td>
					<td>UserGender</td>
					<td>UserPhone</td>
					<td>Flat_Address</td>
					<td>Control</td>
				</tr>
				<?php
				
				
				foreach ($orders as $order) {
					echo"<tr>";
					echo"<td>".$order['Order_ID']."</td>";
					echo"<td>".$order['User_ID']."</td>";
					echo"<td>" .$order['Item_Id']."</td>";
					echo"<td>" .$order['UserName']."</td>";
					echo"<td>";
						if ($order['Gender']==0) {
							echo "male";
						}elseif ($order['Gender']==1) {
							echo "female";
						}
					echo"</td>";
					echo"<td>" .$order['PhoneNumber']."</td>";
					
					echo"<td>" .$order['Address']."</td>";
					echo"<td>
                
                    
					<a href='orders.php?do=delete&orderid=".$order['Order_ID']."'class='btn btn-danger'>
					<i class='fa fa-close'></i>Delete</a>";
					if($order['Renting'] == 0){

					echo"<a
						 href='orders.php?do=confirm&itemid=".$order['Item_ID']."'
						  class='btn btn-info activate'><i class='fa fa-check'>confirm</i></a>";
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
		echo "<h1 class='text-center'>Delete Order</h1>";
		echo "<div class='container'>";
		//check if Get request item ID is numeric&& get integer value of it
		$orderid=isset($_GET['orderid'])&&is_numeric($_GET['orderid'])?intval($_GET['orderid']):0;
		//select all data depend on this ID
		$check=checkItem('Order_ID','orders',$orderid);
		//if there is such ID show the form
		if($check>0){
			$stmt1=$con->prepare("DELETE FROM orders WHERE Order_ID=:zid");
			$stmt1->bindparam(":zid",$orderid);
			$stmt1->execute();
		//Echo success message
			$theMsg='<div class="alert alert-success">'.$stmt1->rowCount().'record Deleted'.'</div>';
			redirectHome($theMsg,'back');	
		}else{
			$theMsg="<div class='alert alert-danger'>this ID isnot Exist </div>";
			redirectHome($theMsg,'');
		}
		echo "</div>";
		}elseif ($do=='confirm') {
		echo "<h1 class='text-center'> Confirm Order</h1>";
		echo "<div class='container'>";
		//check if Get Request Item ID is numeric&&Get integer value of it
			$itemid=isset($_GET['itemid'])&&is_numeric($_GET['itemid'])?intval($_GET['itemid']):0;
		//SELECT all data depend on this ID
		$check=checkItem('Item_ID','items',$itemid);
		//if there such ID show the form
		if ($check>0) {
				$stmt=$con->prepare("UPDATE items SET Rating=1 WHERE Item_ID=?");
				$stmt->execute(array($itemid));
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
}else{
	header('location:index.php');
}

ob_end_flush();
?>