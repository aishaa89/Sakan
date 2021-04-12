<?php
ob_start();
session_start();
$commentStyle='';
$pageTitle='FlatDetails';
include 'init.php';


$itemid=isset($_GET['itemid'])&&is_numeric($_GET['itemid'])?intval($_GET['itemid']):0;

$stmt1=$con->prepare("SELECT items.*,users.UserName
		FROM items 
		INNER JOIN
		 users
		 ON
		 items.Member_ID=users.User_ID
         WHERE Item_ID=?");
//execute quary
	$stmt1->execute(array($itemid));
 
//fetch the data
	$item=$stmt1->fetch();  
  ?> 
<h1 class="text-center"><?php echo $item['Address']?></h1>
<?php 
$stmt=$con->prepare("SELECT Image
                     FROM images
                     WHERE Item_id={$item['Item_ID']}
                     
                      ");
                    $stmt->execute(array());
                    $image=$stmt->fetchAll();

?>


<div class="container">
<div class="data">

  
    <div class="col-md-3">
        
           <div class="slider">
  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
  <?php
  $i=0;
  if (isset($image)) {
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
 if(isset($image)){
  $a=0;
 foreach ($image as $img) {
  
  if ($a==0) {
    echo '<div class="item active">';
    echo "<img src='admin/uploads/images/".$img['Image']."'alt='...' >";
   echo'</div>';
   $a++;
    # code...
  }else{
   echo '<div class="item">';
    echo "<img src='admin/uploads/images/".$img['Image']."'alt='...' >";
   echo'</div>';
   $a++;
  }

}
  
      }
   
    ?>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
</div>
                   
    </div >
    </div>
     <div class="col-md-9 item-info">
         
     <h2><?php echo $item['Address']?></h2>
    <p><?php echo $item['Description']?></p>
         <ul class="list-unstyled">
              <li>
          <i class="fa fa-money fa-fw"></i>
          <span>Added Date:</span><?php echo $item['Add_Date']?></li>
      <li>
          <i class="fa fa-money fa-fw"></i>
          <span>price:L.E</span><?php echo $item['Price']?></li>
             <li>
                 <i class="fa fa-user fa-fw"></i>
         <span>AddedBy:</span><?php echo $item['UserName']?></li>
         </ul>
   
    </div>
    </div>
    </div>


    
   

<?php
    if (isset($_SESSION['user'])) {
    $getUser=$con->prepare("SELECT * FROM users WHERE Username=?");
    $getUser->execute(array($sessionUser));
    $info=$getUser->fetch();
  ?>
  <div class="container">
  <div class="addcomment">

  
<div class="col-md-offset-2" >
  
  
    <form  method="POST">
    
    <textarea  placeholder="add comment" type="text" name="comment">
        </textarea>
    <input class="btn btn-primary" type="submit" value="Add commment">
    </form>
     </div> 
    </div>

     </div>

    <?php
     if($_SERVER['REQUEST_METHOD']=='POST'){
            $comment   =filter_var($_POST['comment'],FILTER_SANITIZE_STRING);
            $Item=$item['Item_ID'];
            $user=$info['User_ID'];
            
          
         if(! empty($comment)){
             $stmt = $con->prepare("INSERT INTO
   item_comments (Comment,Item_Id,User_Id,Comment_Date)
             VALUES(:zcomment,:zitem,:zuser,now())");
             
             $stmt->execute(array(
             
             'zcomment' => $comment,
                'zitem'=> $Item ,
                 'zuser'=>$user
             
             ));
             if($stmt){
                 
                 echo '<div class="alert alert-success">Comment Added </div>';
             }
             
         }   
            
        }
        
             $stmt=$con->prepare("SELECT item_comments.*,users.UserName
                FROM item_comments 
                INNER JOIN
                 users
                 ON
                 item_comments.User_Id=users.User_ID 
                WHERE
                Item_ID = ?
                ORDER BY
                 ItemComment_ID DESC " );
               $stmt->execute(array($item['Item_ID'])); 
                 $comments=$stmt->fetchAll();
    
     foreach($comments as $comment){ ?>

                         <div class="container">
                            <div class="comment-box">
                             <div class="row">
                            <div class="col-md-3 ">
                                 <img class="img-responsive img-thumbnail img-circle center-block" src="images/users icons/user (1).jpg">
                           
                          <?php echo $comment['UserName']?></div>
                            <div class="col-md-9"><p class="lead"><?php echo $comment['Comment']?></p></div>
                  </div>
                  </div>
             </div>         
  <?php
}
   }
   else{
    header('location:login.php');
    exit();
  }

  include $tp1.'footer.php';?>