<?php

ob_start(); //output buffering start
    session_start();

    if (isset($_SESSION['userName'])) //Username
    { 
        
        $pageTitle='Dashboard' ;
        
        include 'init.php' ;
        
        // start dashboard page
        // $stmt2 = $con->prepare("SELECT COUNT(User_ID) FROM users");
        
        // $stmt3 = $con->prepare("SELECT COUNT(Item_ID) FROM users");
        
   // $numUsers = 6; ///num of latest users
   //  $latestUsers = getLatest("*","users","User_ID",  $numUsers ); //latest users arrray
   //   $numItems =6; //num of latest items
  //$latestItems = getLatest("*","items","Item_ID",  $numItems ); //latest items arrray
        ?>


<div class="home-stats">
 <div class="container text-center">
    <h1>Statistics</h1>
    <div class="row">
        
       <div class="col-md-3" >
           <div class="stat st-members">
               <i class="fa fa-users"></i>
               <div class="info">
                   Total Member
                    <span>
             <?php echo countItems('User_ID','users') ?> 
                    </span>
               </div>
              
           </div>
       </div>
          
        <div class="col-md-3">
         <div class="stat st-items">
              
                   <i class="fa fa-home"></i>
               <div class="info">
             Total Items
             <span>
              <?php echo countItems('Item_ID','items') ?>    
            </span>
        </div>
                  
             </div>
       </div>
        
        <div class="col-md-3 ">
         <div class="stat st-comments">
             <i class="fa fa-comments"></i>
               <div class="info">
             Total Posts
             <span>  
                 <?php echo countItems('Post_ID','posts') ?>
             </span>
        </div>
       </div>
        </div>
        
        <div class="col-md-3 ">
            <div class="stat st-pending">
             <i class="fa fa-comments"></i>
               <div class="info">
                    Total Opinions
                    <span>
             <?php echo countItems('Opinion_ID','opinions') ?> 
                    </span>
               </div>
       </div>
         
        </div>
    
    </div>

  </div>
    </div>

<div class="home-stats">
 <div class="container text-center">
    <h1>Pending Items</h1>
  <div class="row">
  

       <div class="col-md-3">
           <div class="stat st-members">
               <i class="fa fa-user-plus"></i>
               <div class="info">
                   Pending Member
                     <span>
                 <?php echo checkItem("RegStatus","users",0)?>
                 </span>

               </div>
              
           </div>
       </div>
          
        <div class="col-md-3">
         <div class="stat st-items">
              
                   <i class="fa fa-home"></i>
               <div class="info">
             Pending Items
              <span>
                 <?php echo checkItem("Approve","items",0)?>
                 </span>
        </div>
                  
             </div>
       </div>
        
        <div class="col-md-3 ">
         <div class="stat st-comments">
             <i class="fa fa-comments"></i>
               <div class="info">
             Pending Posts
             <span> 
                 <?php echo checkItem("Status","posts",0)?>
                 </span>
        </div>
       </div>
        </div>
        
        <div class="col-md-3 ">
            <div class="stat st-pending">
             <i class="fa fa-comments"></i>
               <div class="info">
                    Pending Opinions
                   
                  <span>
                     
                     <?php echo checkItem("Share","opinions",0)?>
                     
                   </span> 
                    
               </div>
       </div>
         
</div>
    
    </div>

  </div>
    </div>


       <?php
         // end dashboard page
        include $tpl .'footer.php';
           
      } 
    else{ 
        
       header('Location: index.php');
        
        exit();
    }
    
ob_end_flush();

?>





























