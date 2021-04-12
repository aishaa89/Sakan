 <?php
/*
================================================
==manage members page 
==you can add , edit , delete members from here
================================================
*/
session_start();
error_reporting(0);
$pageTitle = 'Members';
    if (isset($_SESSION['userName'])){ //user
        
        include 'init.php' ;
        
        $do = isset($_GET['do'])? $_GET['do'] : 'Manage';
               
        //start manage page 
         
        if($do =='Manage'){ //manage members page
            
            $query ='';
            
           if (isset($_GET['page']) && $_GET['page'] == 'pending') {
                
$query = 'AND RegStatus = 0'; }
                
    //    }elseif($do =='Edit'){ 
            
            //edit page
            
             //select All users except admin

           $stmt=$con->prepare("SELECT * From users WHERE GroupID != 1 $query" );

            $stmt->execute(); 

               //Assign to variables

              $rows=$stmt->fetchAll();

        	?>

		      <h1 class="text-center">Manage member</h1>
		                    

		                    <div class="container">
		                   <dive class="table-responsive">
		                    <table class="main-table manage-members  text-center table table-bordered">
		                    <tr>
		                          <td>#ID</td>
		                           <td>Username</td>
		                            <td>Email</td>
		                            <td>PhoneNumber</td>
		                             <td>Full Name</td>
		                             <td>Gender</td>
		                              <td>Registerd Date</td>
		                              <td>Verification_Image</td>
		                               <td>Control</td>
		                    </tr>
		                   <?php

		                   foreach ($rows as $row) {

		                   	echo "<tr>";
		                   	echo "<td>".$row['User_ID']."</td>";
		                     echo "<td>".$row['UserName']."</td>";
		                     echo "<td>".$row['Email']."</td>";
		                     echo "<td>".$row['PhoneNumber']."</td>";
		                     	echo "<td>".$row['FullName']."</td>";
		                     echo"<td>";
						if ($row['Gender']==0) {
							echo "male";
						}elseif ($row['Gender']==1) {
							echo "female";
						}
					echo"</td>";	

		                    echo "<td>" .$row['Date']. "</td>";
		                    echo"<td>";
						if (empty($row['Image'])) {
						 	echo "No image";
						 }else {
						 echo "<img src='../uploads/verification_images/".$row['Image']."'alt='verifcation_Image' />";
					} 
					echo "</td>";



		                    	echo "<td>
		                             <a href='members.php?do=Edit&userid=".$row['User_ID']."' class='btn btn-success'><i class='fa fa-edit'></i>Edit</a>
		                      <a href='members.php?do=Delete&userid=".$row['User_ID']."'  class='btn btn-danger confirm'><i class='fa fa-close'></i>Delete</a>";
		                    	
		                       if($row['RegStatus'] == 0) {
		                         echo "<a href='members.php?do=Activate&userid=".$row['User_ID']."'  class='btn btn-info activate'><i class='fa fa-close'></i>Activate</a>";
		                       }
		                       
		                       echo "</td>";

		                   	echo"</tr>";
		                   }

		                   ?>
		                   
		                </table>
		             </dive>
		            <a href="members.php?do=Add" class="btn btn-primary"> <i class="fa fa-plus"></i>New member </a>;  
		                        
		            
		                        
		                 </div>

		       <?php
		        
		        } elseif ($do=='Add') { //Add member page ?> 

		        	              <h1 class="text-center">Add new member</h1>
		                    <div class="container">
		                     <form class="form-horizontal" action="?do=Insert" method="POST" enctype="multipart/form-data">
		                    
		                         <!--start username field -->
		                      <div class="form-group form-group-lg ">
		                       <label class="col-sm-2 control-label">Username</label>
		                        <div class="col-sm-10 col-md-8">
		                           <input type="text" name="username" class="form-control" required="required"  placeholder="Enter user name" autocompelete="off" 
		                        />
		                        </div>
		                     </div>
		                           <!--end user field -->
		                          <!--start password field -->
		                      <div class="form-group form-group-lg">
		                       <label class="col-sm-2 control-label">Password</label>
		                        <div class="col-sm-10 col-md-8">
		                         
		                            <input type="password" name="password" class="password form-control" required="required" autocomplete="new-password" placeholder=" password must be complex" />
		                            <i class="show-pass fa fa-eye fa-2x" ></i>
		                       
		                        </div>
		                     </div> 
		                      <!----> 
		                           <!--end password field -->
		                          <!--start email field -->
		                      <div class="form-group form-group-lg">
		                       <label class="col-sm-2 control-label">Email</label>
		                        <div class="col-sm-10 col-md-8">
		                           <input type="email" name="email" required="required" placeholder="Enter your email" class="form-control" />
		                        </div>
		                     </div>
		                           <!--end email  field -->
		                           
		                           <!--start fullname field -->
		                      <div class="form-group form-group-lg">
		                       <label class="col-sm-2 control-label">Full Name</label>
		                        <div class="col-sm-10 col-md-8">
		                           <input type="text" name="full" required="required" class="form-control" placeholder="Enter your fullName"  />
		                        </div>
		                     </div>
		                           <!--end fullname field -->
		                           <!--start gender field -->
		                      <div class="form-group form-group-lg">
		                       <label class="col-sm-2 control-label">Gender</label>
		                        <div class="col-sm-10 col-md-8">
		                           <input type="radio" name="gender" value="0" required="required"  />
		                           <input type="radio" name="gender" value="1" required="required"  />
		                        </div>
		                     </div>
		                           <!--end gender  field -->
		                       <!-- start image field -->	
								<div class="form-group form-group-lg">
									<label class="col-sm-2 control-label">Images</label>
									<div class="col-sm-10 col-md-6">
									<input type="file"
										required="required"
										name="image">
									</div>	
								</div>
							 
						<!-- end image field -->    
		                           <!--start button save-->
		                         <div class="form-group form-group-lg">
		                        <div class="col-sm-offset-2 col-sm-8">
		                           <input type="submit" value="Add member" class="btn btn-primary btn-lg"/>
		                        </div>
		                     </div>
		                           <!--end button save-->
		                  </form>
		                </div>




		          
		            
		       <?php

					        }elseif($do =='Insert'){


					        	//Insert member page


					      

					      if($_SERVER['REQUEST_METHOD']=='POST'){

					      	 echo "<h1 class='text-center'>Insert Member</h1>";
					      echo "<div class='container'>";

					      //Get variables from form
					       $imageName=$_FILES['image']['name'];
							$imageTmp=$_FILES['image']['tmp_name'];
							$imageType=$_FILES['image']['type'];
							$imageSize=$_FILES['image']['size'];
							//list of Allowed file typed to upload
								$imageAllowedExtention=array("jpeg","jpg","png","gif");
							//Get image EXtention
								$imageExtention=strtolower(end(explode('.',$imageName)));
					      
					      	$user    = $_POST['username'];
					      	$pass    =$_POST['password'] ;
					      	$email   = $_POST['email'];
					      	$name    = $_POST['full'];
					      	$gender=$_POST['gender'];
					        $hashPass=sha1($_POST['password']);


					      	//Validate The form



					      	$formErrors=array();
					             
					     


				      	if(empty($user)){
				      		$formErrors[]='  Username cant Be <strong> empty </strong> ';
				      	}

				      	if(empty($email)){
				      		$formErrors[]=' Email cant Be <strong> empty </strong> ';
				      	}

				        	if(empty($pass)){
				      		$formErrors[]=' Password cant Be <strong> empty </strong> ';
				      	}


				      	if(empty($name)){
				      		$formErrors[]='  Full Name cant Be <strong> empty </strong>';
				      	}
				      	if (!empty($imageName) && !in_array($imageExtention,$imageAllowedExtention)) {
							$formErrors[]='This Extention is not <strong>Allowed</strong>';
							}
						if (empty($imageName)) {
							$formErrors[]='Image is <strong>required</strong>';		
								}
						if ($imageSize > 6291456) {
							$formErrors[]='Image cant Be larger than <strong>6MB</strong>';				
							}
				         foreach ($formErrors as $error) {
				         	echo '<div class="alert alert-danger">'.$error . '</div>';
				         }
				      
				        //chexk if there is no Error Validate

				        if(empty($formErrors)){
		            //check if user exist in database

		             
		               $check=checkItem("UserName","users","$user"); 

		               if($check ==1){
		               $theMessage= '<div class="alert alert-danger">sorry this user is exist </div>';
		                RedirectHome($theMessage,'back');

		               }else{
		               		$image=rand(0, 100000).'_'.$imageName;
				move_uploaded_file($imageTmp,"../uploads/verification_images//".$image);
					          //Insert Info user into database 

					     $stmt = $con->prepare("INSERT INTO users
					      (UserName ,Password ,Email, FullName ,Gender,GroupID ,RegStatus , Date,Image )

					       VALUES(:zuser,:zpass,:zmail,:zname,:zgender,0 ,1,now(),:zimage)");
					      $stmt -> execute (array(	
					            'zuser'=> $user,
					            'zpass'=> $hashPass,
					            'zmail'=> $email,
					            'zname'=> $name,
					            'zgender'=>$gender,
					            'zimage'=> $image


					      	 ) ); 


					      //echo success message
					     $theMessage= '<div class="alert alert-success">' . $stmt ->rowcount() . 'Record Inserted </div>';
		                   RedirectHome($theMessage,'back'); 
		    }
		        }

		        
		    



					      }else{
					      	echo '<div class="container">';
					      	$theMessage='<div class="alert alert-danger">sorry you cant prowse the page directly </div>';
					      	RedirectHome($theMessage,'back');
					      	echo'</div>';
					      }

					       echo"</div>";




						        } elseif ($do == 'Edit'){ //edit page 



										//check if get request userid is numeric & get the integer value of it     
											$userid = isset($_GET['userid']) && is_numeric($_GET['userid'])? intval($_GET['userid']):0;
								            //select all data depend on this id
								             $stmt = $con->prepare("SELECT * FROM users WHERE User_ID=? LIMIT 1");
						            //execute query
						             $stmt->execute(array($userid));
						            //fetch the data
						             $row = $stmt->fetch();
						             //count how many times user make logins ( the row count)
						             $count = $stmt->rowCount();
						             //if there is such id show the form
						           if($stmt->rowcount() > 0) {?> 

                                       <h1 class="text-center">Edit Member</h1>
						                    <div class="container">
						                     <form class="form-horizontal" action="?do=Update" method="POST">
						                     <input type='hidden' name='userid' value="<?php echo $userid ?>" />
						                         <!--start username field -->
						                      <div class="form-group form-group-lg ">
						                       <label class="col-sm-2 control-label">Username</label>
						                        <div class="col-sm-10 col-md-8">
						                       <input type="text" name="username" class="form-control"  required="required" value="<?php echo $row['UserName'] ?>" autocompelete="off" 
						                             />
						                        </div>
						                     </div>
						                           <!--end user field -->
						                          <!--start password field -->
						                      <div class="form-group form-group-lg">
						                       <label class="col-sm-2 control-label">Password</label>
						                        <div class="col-sm-10 col-md-8">
						                           <input type="hidden" name="oldpassword"  value=" <?php echo $row['Password']  ?> "/>
						                 <input type="password" name="newpassword" class="form-control" autocomplete="new-password" placeholder="leave Blank if you dont want to change"/>
						                        </div>
						                     </div>
						                           <!--end password field -->
						                          <!--start email field -->
						                      <div class="form-group form-group-lg">
						                       <label class="col-sm-2 control-label">Email</label>
						                        <div class="col-sm-10 col-md-8">
						                           <input type="email" name="email" class="form-control" required="required" value="<?php echo $row['Email']  ?>" />
						                        </div>
						                     </div>
						                           <!--end email  field -->
						                           <!--start fullname field -->
						                      <div class="form-group form-group-lg">
						                       <label class="col-sm-2 control-label">Full Name</label>
						                        <div class="col-sm-10 col-md-8">
						                           <input type="text" name="full" class="form-control" required="required" value="<?php echo $row['FullName']  ?>" />
						                        </div>
						                     </div>
						                           <!--end fullname field -->
    
						                           <!--start button save-->
						                         <div class="form-group form-group-lg">
						                        <div class="col-sm-offset-2 col-sm-8">
						                           <input type="submit" value="save" class="btn btn-primary btn-lg"/>
						                        </div>
						                     </div>
						                           <!--end button save-->
						                  </form>
						                </div>
						      <?php 
						            //if ther is no such id show  this error message   
						          }else {
						          	echo'<div class="container">';
						               $theMessage= '<div class="alert alert-danger">there is no such ID </div>' ;
						               RedirectHome( $theMessage,'back');
						               echo '</div>';
				           }







				           //Update page
				      } elseif ($do =='Update') {



							      echo "<h1 class='text-center'>Update Member</h1>";
							      echo "<div class='container'>";
							     
							      

							      if($_SERVER['REQUEST_METHOD']=='POST'){

							      

							      //Get variables from form

							      	$id      = $_POST['userid'];
							      	$user    = $_POST['username'];
							      	$email   = $_POST['email'];
							      	$name    = $_POST['full'];

			      //Password Trick
								      	$pass = '';
								      	if(empty($_POST['newpassword'])){

								          $pass = $_POST['oldpassword'];
								      	}else{

								          $pass =sha1($_POST['newpassword']) ;

								      	}



								      	//Validate The form



								      	$formErrors=array();
								             
								     


								      	if(empty($user)){
								      		$formErrors[]='  Username cant Be <strong> empty </strong> ';
								      	}

								      	if(empty($email)){
								      		$formErrors[]=' Email cant Be <strong> empty </strong> ';
								      	}

								        
								      	if(empty($name)){
								      		$formErrors[]='  Full Name cant Be <strong> empty </strong>';
								      	}
								         foreach ($formErrors as $error) {
								         	echo '<div class="alert alert-danger">'.$error . '</div>';
								         }
								      
								      
								        //chexk if there is no Error Validate

								        if(empty($formErrors)){


								          //Update database with this info

								     $stmt = $con -> prepare("UPDATE users SET UserName = ? , Email = ? ,Password =?    , FullName = ? WHERE User_ID = ?");
								      $stmt -> execute (array(	$user , $email, $pass ,$name ,$id ) ); 


								      //echo success message
								      
								      $theMessage=  '<div class="alert alert-success">' . $stmt ->rowcount() . 'Record Updated </div>';
								      RedirectHome($theMessage,'back');

								        }

								        

								      }else{
								      	 $theMessage= '<div class="alert alert-danger"> sorry you cant prowse the page directly </div>';
								      	  RedirectHome($theMessage,'');
								      }

								       echo"</div>";

					       

					       //Delete members page





					      }elseif($do =='Delete'){ //Delete member page


								      	 echo "<h1 class='text-center'>Delete Member</h1>";
								      echo "<div class='container'>";
								     

									      $userid = isset($_GET['userid']) && is_numeric($_GET['userid'])? intval($_GET['userid']):0;
									            //select all data depend on this id
									         

			                                        $check=checkItem("User_ID","users"," $userid"); 


									           
									           if($check > 0) {

									         $stmt = $con->prepare("DELETE FROM users WHERE User_ID= :zuser");
									            //execute query
									             $stmt->bindParam (':zuser',$userid);
									              
									              $stmt->execute();



									             $theMessage= '<div class="alert alert-success">' . $stmt ->rowcount() . 'Record Deleted </div>';
									 
								                     RedirectHome($theMessage,'back');


									           }else{
									           $theMessage='<div class="alert alert-danger"> this id isnt exist </div>';
								                  RedirectHome($theMessage,'');

									           }

								                 echo '</div>';

					      }elseif($do =='Activate'){ //activate member page


								      	 echo "<h1 class='text-center'>Activate Member</h1>";
								      echo "<div class='container'>";
								     

									      $userid = isset($_GET['userid']) && is_numeric($_GET['userid'])? intval($_GET['userid']):0;
									            //select all data depend on this id
									         

			                                        $check=checkItem('User_ID','users', $userid); 


									           
									           if($check > 0) {

									         $stmt = $con->prepare("UPDATE users SET RegStatus = 1 WHERE User_ID = ?");
									            //execute query
                                                   
									              $stmt->execute(array($userid));
                                                   
								             $theMessage= '<div class="alert alert-success">' . $stmt->rowcount() . 'Record Updated </div>';
									 
								                     redirectHome($theMessage,'back');


									           }else{
									           $theMessage='<div class="alert alert-danger"> this id isnt exist </div>';
								                  redirectHome($theMessage,'');

									           }

								                 echo '</div>';

        }    include $tpl .'footer.php';
					           
					      } 
					    else{ 
					        
					       header('Location: index.php');
					        
					        exit();
					    }
					    

