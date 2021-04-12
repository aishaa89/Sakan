<?php
session_start();
error_reporting(0);
	$advertiseStyle='';
	$pageTitle='Advertise';
	include 'init.php';
	if (isset($_SESSION['user'])) {
		$getUser=$con->prepare("SELECT * FROM users WHERE Username=?");
		$getUser->execute(array($sessionUser));
		$info=$getUser->fetch();
	
	?>
	<!-- main -->
<h1>Advertisement Form</h1>
<div class="main-agileinfo">

	<div class="videologin">
		<h2 class="sub-head">Add your advertise Here</h2>
		<form  method="POST" enctype="multipart/form-data">


			<div class="icon1">
				
				<input type="text" placeholder="Price" name="price"
					required="required"/>
			</div>
			<div class="icon1">
				
				<input type="text" placeholder="Address" name="address"
					required="required"/>
                <div style="margin-left:400px;" class="btn-group">
			    	<div class="col-lg-4 col-sm-12 col-md-12"   class="bt"> District
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
           
			</div>
            <div class="icon1">
				
				<textarea type="text" placeholder="Description" name="description" required="required"></textarea>
			</div>
			
			 <div class="btn-group">
			    	
                   <!-- <div class="col-lg-4 col-sm-12 col-md-12" class="fil">

                 Add soret El-fatoora  :  <input id='input1' type="file">
                </div>-->
                <div class="col-lg-4 col-sm-12 col-md-12"  >
		Add Flat Images: <input id='input1' type="file"
					required="required"
					name="image[]" multiple>
           
			</div>
                </div>
           
       
			<div class="clear"></div>
	
			<div  class="col-lg-6 col-sm-6 col-md-6" >
			<!--<button class="button" type="button"> OK </button>-->
			<input  class="button" type="submit" value="Add Advertise">
           
			</div>
            
        
            	<!--<div class="col-lg-6 col-sm-6 col-md-6" >
			<button class="button" type="button"> Cancle </button>
           
			</div>-->
           

			
		</form>	
	</div>	
	<div class="clear"></div>
</div>
<?php

			// GET variables
				
				$address=$_POST['address'];
				$price=$_POST['price'];
				$district=$_POST['district'];
				$member=$info['User_ID'];
				$description=$_POST['description'];
				
			//validate form
			$formErrors=array();
			
			if (empty($address)) {
				$formErrors[]='The address cant be <strong>Empty</strong>';
			}	
			if(empty($price)){
				$formErrors[]='the price cant be <strong> Empty</strong>';
			}
			if(empty($district)){
				$formErrors[]='you must choose the <strong> district</strong>';
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
				$imageExtention=strtolower(end(explode('.', $imageName)));
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
			 	echo '<div class="alert alert-danger">'.$ImageError .'</div>';
			 	//redirectHome($theMsg,'');
			 	echo "</div>";
			}
			//check if there’s no error proceed the insert operaion
			if (empty($formImageErrors)) {
				$image=rand(0, 100000).'_'.$imageName;
				move_uploaded_file($imageTmp,"admin/uploads/images//".$image);
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
			 	echo '<div class="alert alert-danger">'.$error .'</div>';
			 	//redirectHome($theMsg,'');
			 	echo "</div>";
			}
		
			 }
			 if (empty($formErrors)&& empty($formImageErrors)) {
			 	// echo success message
			 echo"<div class='alert alert-success'>".$stmt->rowCount().'Record inserted'."</div>";
			//redirectHome($theMsg,'back');
			 }
			 ?>	
	<?php
	}else{
		header('location:login.php');
		exit();
	}
	include $tp1.'footer.php';?>