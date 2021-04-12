<?php
    session_start();
    $noNavbar = '';
    $pageTitle='Login' ;

    if (isset($_SESSION['userName'])) {
        header('Location: dashboard.php');    //redirect to dashboard page
   }
    include 'init.php';       

    //check if user coming from http post request 
   
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $username   = $_POST['userName'];
        $password   = $_POST['pass'];
        //$hashedpass = shal($password);
        
     //check if user exsit in database
       
    $stmt = $con->prepare("SELECT 
                                User_ID, UserName, Password 
                            FROM 
                                users 
                            WHERE 
                                 UserName=? 
                            AND 
                                 Password=?  
                            AND  
                                 GroupID = 1
                            LIMIT 1");
       
    $stmt->execute(array($username,$password));
    $row = $stmt->fetch();
        //count how many times user make logins
    $count = $stmt->rowCount();
       //if count >0 this mean the database contain record about this username
        if($count>0){
            $_SESSION['userName'] = $username ; //register session name 
            $_SESSION['ID'] = $row['User_ID'] ;//register session ID
            //secho"welcome".$username;
            header('Location: dashboard.php');  // redirect to dashboard page
            exit();
            
        }
   } 

?>

 <form class="login"  method="post">
     <h4 class="text-center">Admin Login</h4>
    <input class="form-control input-lg" type="text" name="userName" placeholder="Username" autocomplete="off" />
     <input class="form-control input-lg" type="password" name="pass" placeholder="Password" autocomplete="new-password" />
     <input class="btn btn-lg btn-primary btn-block" type="submit" value="login" />
    
 </form>



<?php
    include $tpl . 'footer.php';
?>
