<?php
ob_start(); 
session_start();
error_reporting(0);
$pageTitle="items";
if (isset($_SESSION['userName'])) {
	include 'init.php';
	$do=isset($_GET['do'])? $_GET['do'] : 'manage';
	if ($do=='manage') {
		 $query ='';
            
           if (isset($_GET['page']) && $_GET['page'] == 'pending') {
                
			$query = ' WHERE Approve= 0'; }

			
		/*$stmt=$con->prepare("SELECT images.*,items.*,users.UserName
		 FROM images
		 
		 INNER JOIN
		 items
		 ON
		 images.Item_id=items.Item_ID
		 INNER JOIN
		 users
		 ON
		 items.Member_ID=users.User_ID
		  ");
		//execute the statment
		$stmt->execute(array());
		//assign to variable
		$items=$stmt->fetchAll();
		echo "<pre>";
		print_r($items);
		echo "</pre>";*/
		$stmt=$con->prepare("SELECT items.*,users.*
		FROM items 
		INNER JOIN
		 users
		 ON
		 items.Member_ID=users.User_ID
		  ");
		//execute the statment
		$stmt->execute(array());
		//assign to variable
		$items=$stmt->fetchAll();
		/*echo "<pre>";
		print_r($items);
		echo "</pre>";*/
		?>
		<h1 class="text-center">Manage Items</h1>
		<div class="container">
			<div class="table-responsive">
				<table class="main-table manage-items text-center table table-borderd">
				<tr>
					<td>Item_ID</td>
					<td>Address</td>
					<td>Description</td>
					<td>Price</td>
					<td>Renting</td>
					<td>Add_Date</td>
					<td>Image</td>
					<td>OwnerName </td>
					<td>flatOwner_Phone </td>

					<td>Control</td>
				</tr>
				<?php
				
				foreach ($items as $item) {
					$stmt=$con->prepare("SELECT Image FROM
						 images 
						 WHERE Item_id ={$item['Item_ID']}
						 ");
						//execute the statment
						$stmt->execute(array());
						//assign to variable
						$images=$stmt->fetchAll();
						/*echo "<pre>";
						print_r($images);
						echo "</pre>";*/
					echo"<tr>";
					echo"<td>".$item['Item_ID']."</td>";
					echo"<td>".$item['Address']."</td>";
					echo"<td>" .$item['Description']."</td>";
					echo"<td>".$item['Price']."</td>";
					echo"<td>";
						if ($item['Renting']==0) {
							echo "Not Rented";
						}elseif ($item['Renting']==1) {
							echo "Rented And May be not completed";
						}
					echo"</td>";
					echo"<td>".  $item['Add_Date']."</td>";
					echo"<td>";
						if (empty($images)) {
						 	echo "No image";
						 }else {?>
						 <div style=" width: 200px;height: 200px;margin:auto">
						 	<!--start carousel-->
							<div id="mySlide" class="carousel slide" data-ride="carousel">
						  <!-- Indicators -->
						  <ol class="carousel-indicators hidden-xs">
						    <?php
  $i=0;
  if (isset($images)) {
  # code...

  if ($i==0) {
    echo "<li data-target='#carousel-example-generic' data-slide-to=".$i." class='active'></li>";
    $i++;
    # code...
  }else{
   echo "<li data-target='#carousel-example-generic' data-slide-to=".$i."></li>";
   $i++;
  }
}

 echo '</ol>';

  //<!-- Wrapper for slides -->
 echo '<div class="carousel-inner">';
 if(isset($images)){
  $a=0;
 foreach ($images as $img) {
  
  if ($a==0) {
    echo '<div class="item active">';
    echo "<img src='uploads/images/".$img['Image']."'alt='...' Style='width:95%'>";
   echo'</div>';
   $a++;
    # code...
  }else{
   echo '<div class="item">';
    echo "<img src='uploads/images/".$img['Image']."'alt='...'Style='width:95%' >";
   echo'</div>';
   $a++;
  }

}
  
      }
   
    ?>
  </div>

            			<a class="left carousel-control" href="#mySlide" role="button" data-slide="prev">
						    <span class="glyphicon glyphicon-chevron-left"></span>
						  </a>
						  <a class="right carousel-control" href="#mySlide" role="button" data-slide="next">
						    <span class="glyphicon glyphicon-chevron-right"></span>
						  </a>
						  </div>
						 </div>	
						<?php
					} 
					echo "</td>";
					echo"<td>". $item['UserName']."</td>";
					echo"<td>". $item['PhoneNumber']."</td>";
					echo"<td>

					<a href='items.php?do=edit&itemid=".$item['Item_ID']."' class='btn btn-success'><i class='fa fa-edit'></i>Edit</a>
					<a href='items.php?do=delete&itemid=".$item['Item_ID']."'class='btn btn-danger'>
					<i class='fa fa-close'></i>Delete</a>";
					
					
					if($item['Approve']==0){
						echo"<a
						 href='items.php?do=approve&itemid=".$item['Item_ID']."'
						  class='btn btn-info activate'><i class='fa fa-check'>Approve</i></a>";

					}
					echo"</td>";
					echo "</tr>";
				}
				?>
				</table>
			</div>
				<a href="items.php?do=add" class="btn btn-primary"><i class="fa fa-plus"></i>New Item</a>
		</div>
		
	<?php
	}elseif ($do=='add') {?>
		<h1 class='text-center'>Add Item </h1>
		<div class="container">
		<form class="form-horizontal" action="?do=insert" method="POST" enctype="multipart/form-data">
	<!-- start address field -->	
			<div class="form-group form-group-lg">
				<label class="col-sm-2 control-label">Address</label>
				<div class="col-sm-10 col-md-6">
				<input type="text"
					name="address"
					required="required"
					placeholder="address of the flat"
					>
				</div>	
			</div>
		 
	<!-- end address field -->
		
	<!-- start price field -->	
			<div class="form-group form-group-lg">
				<label class="col-sm-2 control-label">Price</label>
				<div class="col-sm-10 col-md-6">
				<input type="text"
					name="price"
					required="required"
					placeholder="price of the flat"
					>
				</div>	
			</div>
		 
	<!-- end price field -->
	<!-- start district field -->	
			<div class="form-group form-group-lg">
				<label class="col-sm-2 control-label">district</label>
				<div class="col-sm-10 col-md-6">
					<select name="district">
						
						<?php
							$stmt=$con->prepare("SELECT * FROM districts");
							$stmt->execute();
							$districts=$stmt->fetchAll();
							foreach ($districts as $district) {
								echo '<option value="'.$district[district_ID].'">'.$district['District']."</option>";
							}

						 ?>
					</select>
				</div>	
			</div>
		<!-- end district field -->
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
	<!--start description field-->
			<div class="form-group form-group-lg">
			<label class="col-sm-2 control-label">Description</label>
				<div class="col-sm-10 col-md-6">
				<textarea  name="description" rows="5" cols="30" style="width:450px; height:96px;" required="required">
				</textarea>

				</div>	
			</div>
		 
	<!-- end description field -->
	<!-- start image field -->	
			<div class="form-group form-group-lg">
				<label class="col-sm-2 control-label">Images</label>
				<div class="col-sm-10 col-md-6">
				<input type="file"
					required="required"
					name="image[]" multiple>
				</div>	
			</div>
		 
	<!-- end image field -->
	<!--start submit field-->
			<div class="form-group form-group-lg">
				<div class="col-sm-offset-2 col-sm-2">
					<input type="submit" value="Add Item" class="btn btn-primary btn-sm">
				</div>
				
			</div>
		</form>
	<!--end submit field-->
		</div>
	<?php
}elseif ($do=='insert') {?>
			<h1 class="text-center">Insert Item</h1>
			<div class="container">
			<?php
			// GET variables
				
				$address=$_POST['address'];
				$price=$_POST['price'];
				$district=$_POST['district'];
				$member=$_POST['member'];
				$description=$_POST['description'];
			//validate form
			$formErrors=array();
			
			if (empty($address)) {
				$formErrors[]='The address cant be <strong>Empty</strong>';
			}	
			if(empty($price)){
				$formErrors[]='the price cant be <strong> Empty</strong>';
			}
			if(empty($member)){
				$formErrors[]='you must choose the <strong> member</strong>';
			}
			if (empty($description)) {
				$formErrors[]='The description cant be <strong>Empty</strong>';
			}

			//check if there’s no error proceed the insert operaion
			if (empty($formErrors)) {
				
			// insert item info in database
			 $stmt=$con->prepare("INSERT INTO
			 		items(Address,Price,Member_ID,District_id,Description,Add_Date)
			 		VALUES(:zaddress,:zprice,:zmember,:zdistrict,:zdescription,now())");
			 	$stmt->execute(array(
			 	'zaddress'=>$address,
			 	'zprice'=>$price,
			 	'zdistrict'=>$district,
			 	'zmember'=>$member,
			 	'zdescription'=>$description
			 	));
			 $itemImage=$con->lastInsertId();

			 $formImageErrors=array();

			 for ($i=0; $i <count($_FILES['image']['name']) ; $i++) { 
			 $imageName=$_FILES['image']['name'][$i];
			$imageTmp=$_FILES['image']['tmp_name'][$i];
			$imageType=$_FILES['image']['type'][$i];
			$imageSize=$_FILES['image']['size'][$i];
			//list of Allowed file typed to upload
				$imageAllowedExtention=array("jpeg","jpg","png","gif");
			//Get image EXtention
				$imageExtention=strtolower(end(explode('.',$imageName)));
				if (!empty($imageName) && !in_array($imageExtention,$imageAllowedExtention)) {
				$formImageErrors[]='This Extention is not <strong>Allowed</strong>';
				}
			if (empty($imageName)) {
				$formImageErrors[]='Image is <strong>required</strong>';		
					}
			if ($imageSize > 6291456) {
				$formImageErrors[]='Image cant Be larger than <strong>6MB</strong>';				
							}				
			//loop into errors array and echo it
			foreach ($formImageErrors as $ImageError) {
				echo "<div class='container'>";
			 	$theMsg='<div class="alert alert-danger">'.$ImageError .'</div>';
			 	redirectHome($theMsg,'');
			 	echo "</div>";
			}
			//check if there’s no error proceed the insert operaion
			if (empty($formImageErrors)) {
				$image=rand(0, 100000).'_'.$imageName;
				move_uploaded_file($imageTmp,"uploads/images//".$image);
			// insert item info in database
			 $stmt=$con->prepare("INSERT INTO
			 		images(Image,Item_id)
			 		VALUES(:zimage,:zitem_id)");
			 	$stmt->execute(array(
			 	'zimage'=>$image,
			 	'zitem_id'=>$itemImage

			 	)); 	
			 	}
			 	}	
					
			 }else{
			 	
			 	//loop into errors array and echo it
			foreach ($formErrors as $error) {
				echo "<div class='container'>";
			 	$theMsg='<div class="alert alert-danger">'.$error .'</div>';
			 	redirectHome($theMsg,'');
			 	echo "</div>";
			}
		
			 }
			 if (empty($formErrors)&& empty($formImageErrors)) {
			 	// echo success message
			 $theMsg="<div class='alert alert-success'>".$stmt->rowCount().'Record inserted'."</div>";
			redirectHome($theMsg,'back');
			 }
				
		echo"</div>";
		
}elseif ($do=='edit') {
//check if get request  item is numeric &get its integer value
	$itemid=isset($_GET['itemid'])&&is_numeric($_GET['itemid'])?intval($_GET['itemid']):0;
//select ALL depend on this ID
	$stmt1=$con->prepare("SELECT * FROM items WHERE Item_ID=?");
//execute quary
	$stmt1->execute(array($itemid));
//fetch the data
	$item=$stmt1->fetch();
//the row count 
$count=$stmt1->rowCount();
if($count >0){ ?>
	<h1 class="text-center">Edit Item</h1>
	<div class="container">
		<form class="form-horizontal" action="?do=update" method="POST">
		<input type="hidden" name="itemid" value="<?php echo $itemid;?>">
		<!--start address field -->
		<div class="form-group form-group-lg">
			<label class="col-sm-2 contol-label">Address</label>
			<div class="col-sm-10 col-md-6">
				<input type="text"
				name="address"
				class="form-control"
				required="required"
				value="<?php echo $item['Address'];?>" />
			</div>
		</div>
		<!--end address field -->
		<!--start price field -->
		<div class="form-group form-group-lg">
			<label class="col-sm-2 contol-label">Price</label>
			<div class="col-sm-10 col-md-6">
				<input type="text"
				name="price"
				class="form-control"
				value="<?php echo $item['Price'];?>" />
			</div>
		</div>
		<!--end price field -->
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
						if ($item['Member_ID']==$user['User_ID']) {
							echo 'selected';
						}
						echo">".$user['UserName']."</option>";
					}
				?>
					
				</select>
			</div>
		</div>
		<!--end member field -->
		<!--start description field -->
		<div class="form-group form-group-lg">
			<label class="col-sm-2 contol-label">Description</label>
			<div class="col-sm-10 col-md-6">
				<textarea  name="description" rows="5" cols="30" style="width:450px; height:96px;"/>
				<?php echo $item['Description'];?>
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
	
		
}elseif ($do=='update') {
		echo "<h1 class='text-center'>Update Item</h1>";
		echo "<div class='container'>";
		if ($_SERVER['REQUEST_METHOD']=='POST') {
		//GET variables from  the form
			$id=$_POST['itemid'];	
			$address=$_POST['address'];
			$price=$_POST['price'];
			$member=$_POST['member'];
			$description=$_POST['description'];
		//validate the form
			$formErrors=array();
			if (empty($address)) {
				$formErrors[]='the address can not be<strong>EMPTY</strong>';
			}
			if (empty($price)) {
				$formErrors[]='the price can not be<strong>EMPTY</strong>';
			}
			if (empty($member)) {
				$formErrors[]='you must choose the<strong>Member</strong>';
			}
			if (empty($description)) {
				$formErrors[]='the description can not be<strong>EMPTY</strong>';
			}
		// loop into Errors array and echo it
			foreach ($formErrors as $error) {
				echo '<div class="alert alert-danger">'.$error.'</div>';
				}
		//check if there is no Error proceed update operation
			if (empty($formErrors)) {
				$stmt=$con->prepare("UPDATE items SET
					Address=?,
					Price=?,
					Member_ID=?,
					Description=?
					WHERE
					Item_ID=?");
				$stmt->execute(array($address,$price,$member,$description,$id));
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
		echo "<h1 class='text-center'>Delete Item</h1>";
		echo "<div class='container'>";
		//check if Get request item ID is numeric&& get integer value of it
		$itemid=isset($_GET['itemid'])&&is_numeric($_GET['itemid'])?intval($_GET['itemid']):0;
		//select all data depend on this ID
		$check=checkItem('Item_ID','items',$itemid);
		//if there is such ID show the form
		if($check>0){
			$stmt=$con->prepare("DELETE FROM items WHERE Item_ID=:zid");
			$stmt->bindparam(":zid",$itemid);
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
		echo "<h1 class='text-center'>Approve Item</h1>";
		echo "<div class='container'>";
		//check if Get Request Item ID is numeric&&Get integer value of it
			$itemid=isset($_GET['itemid'])&&is_numeric($_GET['itemid'])?intval($_GET['itemid']):0;
		//SELECT all data depend on this ID
		$check=checkItem('Item_ID','items',$itemid);
		//if there such ID show the form
		if ($check>0) {
				$stmt=$con->prepare("UPDATE items SET Approve=1 WHERE Item_ID=?");
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
}
else{
	header('location:index.php');
}
ob_end_flush();
?>