<?php
	session_start();
	
	$pageTitle="Contact";
	include 'init.php';
  if (isset($_SESSION['user'])) {
            $getUser=$con->prepare("SELECT * FROM users WHERE Username=?");
            $getUser->execute(array($sessionUser));
            $info=$getUser->fetch();
	?>

    <?php
     if($_SERVER['REQUEST_METHOD']=='POST'){
          
            $message   =filter_var($_POST['message'],FILTER_SANITIZE_STRING);
            $user=$info['User_ID'];
            
            
          
         if(! empty($message)){
             $stmt = $con->prepare("INSERT INTO
   contact (Message,User_Id)
             VALUES(:zmessage,:zuser)");
             
             $stmt->execute(array(
             
             'zmessage' => $message,
                'zuser'=> $user 
                 
             ));
             if($stmt){
                 
                 echo '<div class="alert alert-success">Your Message is sent succesfully and we contact with you soon </div>';
             }
             
         }   
        }  
        
        ?>   
   <?php

  }else{
          header('location:login.php');
    exit();
        }
        include $tp1.'footer.php';    
  ?>