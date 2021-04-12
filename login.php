<?php
	session_start();
	error_reporting(0);
    $pageTitle='login';
    /*if (isset($_SESSION['user'])) {
    	header('location:index.php');
    	# code...
    }*/
	include 'init.php';
	//check if user coming from http post request
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		if (isset($_POST['login'])) {
			
		
			$user=$_POST['username'];
			$pass=$_POST['password'];
			$hashedpass=sha1($_POST['password']);
			//echo $username.$password.$hashedpass;
			//check if the user exist in database
			$stmt=$con->prepare(
			"SELECT
			User_ID,UserName, Password,GroupID
			FROM 
			  	users
			WHERE
			    UserName=?
			AND
			    Password=?");
			$stmt->execute(array($user,$hashedpass));
			$row=$stmt->fetch();
			$count=$stmt->rowCount();
			//if count>0 this means the database contain record about this user 
			if($count>0){
				if ($row['GroupID']==0) {
					$_SESSION['user']=$user;//name
					//$_SESSION['id'] = $row['UserID'] ;//id
					header('location:index.php');
				}/*else {
					$_SESSION['userName'] = $user;
					$_SESSION['ID'] = $row['UserID'] ;
					header('Location: admin/dashboard.php');
				}*/
				
			}else{header('Location: admin/index.php');}
		}else{
			 $imageName=$_FILES['image']['name'];
			$imageTmp=$_FILES['image']['tmp_name'];
			$imageType=$_FILES['image']['type'];
			$imageSize=$_FILES['image']['size'];
			//list of Allowed file typed to upload
				$imageAllowedExtention=array("jpeg","jpg","png","gif");
			//Get image EXtention
				$imageExtention=strtolower(end(explode('.',$imageName)));


			$username=$_POST['username'];
			$password=$_POST['password'];
			$password2=$_POST['password2'];
			$fullname=$_POST['fullname'];
			$phonenumber=$_POST['phonenumber'];
			$email=$_POST['email'];
			$gender=$_POST['gender'];
			

			//validate form
			$formErrors=array();

			if (isset($username)) {
				$filterduser=filter_var($username,FILTER_SANITIZE_STRING);
				if (strlen($username)<2) {
					$formErrors[]="UserName must be larger than 2 characters";
				}
			}	
			if(isset($password)&&isset($password2)){
				if (empty($password)) {
					$formErrors[]="sorry password can not be empty";
				}
				$pass1=sha1($password);
				$pass2=sha1($password2);
				if ($pass1 !== $pass2) {
					$formErrors[]='sorry password is not match';
				}
			}
			if (isset($fullname)) {
				$filterd_fullname=filter_var($fullname,FILTER_SANITIZE_STRING);
				if (strlen($fullname)<2) {
					$formErrors[]="FullName must be larger than 2 characters";
				}
			}	
			if (isset($phonenumber)) {
				$filterd_phone_number=filter_var($phonenumber,FILTER_SANITIZE_NUMBER_INT);
			}
			if (isset($email)) {
				$filterdemail=filter_var($email,FILTER_SANITIZE_EMAIL);
				if (filter_var($filterdemail, FILTER_VALIDATE_EMAIL)!= true) {
					$formErrors[]='email is not valid';
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
			}
			
			$check=checkItem("UserName","users",$username);
			if ($check==1) {
					$formErrors='sorry the user exists';
				}else {
					$image=rand(0, 100000).'_'.$imageName;
				move_uploaded_file($imageTmp,"uploads/verification_images//".$image);	
				 //insert user info in database
					$stmt1=$con->prepare("INSERT INTO 
						users(UserName,Password,FullName,PhoneNumber,Email,Gender,RegStatus,Date,Image) VALUES(:zuser,:zpass,:zfullname,:zphone,:zemail,:zgender,0,now(),:zimage)");
					$stmt1->execute(array(
						'zuser'=>$username,
						'zpass'=>sha1($password),
						'zfullname'=>$fullname,
						'zphone'=>$phonenumber,
						'zemail'=>$email,
						'zgender'=>$gender,
						'zimage'=>$image
						));
					$successMsg='congraturation you are now registerd user';
				}	
			}
		}
	
	?>











<div class="container login-page ">
	<h1 class="text-center">
	<span class="selected" data-class="login">Login </span> | <span data-class="signup">SignUp</span>
	</h1>
	<!--start login form -->
	<form class="login" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
		<div class="input-container">
			<input
			class="form-control" 
			type="text" 
			name="username" 
			autocomplete="off" 
			placeholder="UserName"
			 />
		</div>
		<input
		class="form-control" 
		type="password"
		name="password"
		autocomplete="new-password"
		placeholder="Password"
		/>
		<input
		class="form-control btn btn-primary btn-block" 
		type="submit"
		name="login" 
		value="login" />
	</form>
	<!--end login form -->

	<!--start signup form -->
	<form class="signup" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
		<input
		minlength="2"
		class="form-control" 
		type="text" 
		name="username" 
		autocomplete="off" 
		placeholder="Type UserName"
		required="required" />
		<input
		minlength="4"
		class="form-control" 
		type="password"
		name="password"
		autocomplete="new-password"
		placeholder="Type complex Password"
		required="required" />
		<input
		class="form-control" 
		type="password"
		name="password2"
		autocomplete="new-password"
		placeholder="confirmed Password"
		required="required" />
		 <input
		minlength="2"
		class="form-control" 
		type="text" 
		name="fullname" 
		autocomplete="off" 
		placeholder="Type FullName"
		required="required" />
		<input
		pattern=".{11,}"
		title="phonenumber must be 11 characters"
		class="form-control" 
		type="text"
		name="phonenumber"
		placeholder="Type Phone number"
		required="required" />
		<input
		class="form-control" 
		type="email"
		name="email"
		placeholder=" Type avalid email"
		required="required" />
		 <label class="form-control control-label"> <strong>Gender</strong> </label>
				
				<input
				class="form-control" 
				type="radio"
					required="required"
					name="gender"
					value="0">
					<input
				class="form-control" 
				type="radio"
					required="required"
					name="gender"
					value="1">
		 
				<label class="form-control control-label"> (student Add faculty card) while 
				(flat_Owner Add Electricity fatoora) </label>
				
				<input
				class="form-control" 
				type="file"
					required="required"
					name="image">	
	
		 	
		<input
		class="form-control btn btn-success btn-block" 
		type="submit"
		name="signup" 
		value="signup" />
	</form>
	<div class="the-errors text-center">
	<?php
		if(!empty($formErrors)){
			foreach ($formErrors as $error) {
				echo '<div class="msg error">'.$error.'</div>';
			}
		}
		if (isset($successMsg)) {
			echo '<div class="msg success">'.$successMsg.'</div>';
		}
	?>		
	</div>
</div>

<?php
	include $tp1.'footer.php';
	?>