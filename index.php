<?php
	session_start();
	$pageTitle='index';
	include 'init.php';
	$stmt= $con->prepare("SELECT * FROM items");
	$stmt->execute(array());
	$items= $stmt->fetchAll();
	?>
<section class="search-form text-center">
<div class="container">
	<form action="items.php" method="post">
			<div class="col-sm-12">
      <div class="dis">
      
				<div class="col-sm-3">
        
			<span style="color:white;">District </span>
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

				
        
				<div class="col-sm-3">
					<span style="color:white;">Minimum Price</span>
					<select name="min_price">
						
						<option value="2200">2200</option>
						<option value="2250">2250 </option>
						<option value="3000">3000 </option>
					</select>
          
				</div>
        
				<div class="col-sm-3">
				<span style="color:white;">Maximum Price</span>
					<select name="max_price">
						
						<option value="4250">4250</option>
						<option value="4350">4350</option>
						<option value="4400">4400 </option>
					</select>
				</div>	
                
				<div class="col-sm-3">

					<input type="submit" value="Search" class="btn btn-danger">
				</div>
        
	</div>			
			</div>
		</form>
	</div>

  </section>
<!--Start Section About -->
    <section class="about text-center" >
        <div class="container">
          
            <p class="lead">Hello! its our introduce to our page sakan azhary created with all love to help you </p> 
        </div>
          
</section> 
<!--End Section About -->
    <!--test bs-->
    <!--Start Section Price Table-->
     <div id="myslide" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myslide" data-slide-to="0" class="active"></li>
    <li data-target="#myslide" data-slide-to="1"></li>
    <li data-target="#myslide" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
          
        
        <section class="price_table text-center" >
        <div class="container">
            <h2 class="h1">Our Amazing Prices</h2>
               <div class="row">
               	<?php
               		foreach ($items as $item) {
               			$stmt=$con->prepare("SELECT Image
               			 FROM images
               			 WHERE Item_id={$item['Item_ID']}
               			 LIMIT 1
               			  ");
               			$stmt->execute(array());
               			$image=$stmt->fetchAll();
               			/*echo "<pre>";
               			print_r($image);
               			echo "</pre>";*/
               			echo '<div class="col-lg-4 col-sm-6 col-xs-12">';
                         echo  '<div class="price_box">';
                         	foreach ($image as $img) {
                         		echo "<img src='admin/uploads/images/".$img['Image']."'alt='...' style='width:358px;height:246px'>";
                         	}
                              /* echo "<img src='admin/uploads/images/".$image['Image']."'alt='...'>";*/
                              echo '<ul class="list-unstyled">';
                                 echo  "<li>".$item['Address'] ."</li>";
                                  echo "<li>" .$item['Description'] ."</li>";
                                  echo "<li><strong>";
                                    if ($item['Renting']==0) {
                                        echo "Not Rented";
                                      }elseif ($item['Renting']==1) {
                                        echo "Rented And May be not completed";
                                      }
                                 echo "</li></strong>";
                              echo '</ul>';
                               echo'<p class="center-block">'.$item['Price'].'</p>';
                               echo"<a href='flatDetails.php?itemid=".$item['Item_ID']."'  class='btn btn-success'>More Details</a>";   
                             echo"<a href='order.php?itemid=".$item['Item_ID']."'  class='btn btn-warning'>Order Now</a>"; 

                           echo'</div>';
                      echo '</div>';	
               		  	
               		  }  
                     
                      ?> 
                      
</section>
  </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#myslide" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myslide" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
 </div>    
<!--End Section Price Table-->
    <!--end test bs-->
 <?php
 $stmt1= $con->prepare("SELECT * FROM opinions");
  $stmt1->execute(array());
  $opinions= $stmt1->fetchAll();
 ?>   
  <section class="testimonials text-center">
        <div class="container">
            <h2 class="h1">What Our Clients Say</h2>

    <div id="carousel_testimonials" class="carousel slide" data-ride="carousel">
   <!-- Wrapper for slides--> 
  <div class="carousel-inner" role="listbox">
  <?php
  $i=0;
  if (isset($opinions)) {
    # code...
  
  foreach ($opinions as $opinion) {
    if($i==0){
   echo  '<div class="item active ">';
   echo "<p class='lead'>".$opinion['Opinion']."</p>";  
         echo"<span>".$opinion['UserName']."</span>";
   echo '</div>';
   $i++;
  }else{
    echo  '<div class="item">';
   echo "<p class='lead'>".$opinion['Opinion']."</p>";  
         echo"<span>".$opinion['UserName']."</span>";
   echo '</div>';
   $i++;
  }
  }
  }
  ?>

    </div>
    </div>
     <!-- End Testimonials Carousel-->
  </div>        

</section>     
<!--End Section Testimonials -->          

<!--Start Section Testimonials -->
   <!-- <section class="testimonials text-center">
        <div class="container">
            <h2 class="h1">What Our Clients Say</h2> 
   Start Testimonials Carousel
<div id="carousel_testimonials" class="carousel slide" data-ride="carousel">
  Indicators 
    

   Wrapper for slides 
  <div class="carousel-inner" role="listbox">
      
      <div class="item active">
    <p class="lead">Good Idea . 
         All My Best Wishes.
         </p>  
        <span>Mhmd Salah</span>
    </div>
      
      <div class="item">
    <p class="lead">الفكره عايزة داتا شقق اكبر</p>  
          <span>Sara Ali</span>
    </div>
      
      <div class="item">
    <p class="lead">اسعار الشقق معقولة </p>  
        <span>Osama Kamal</span>
    </div>
      
      <div class="item">
    <p class="lead">فكرة كويسه وفرت مجهود وفلوس </p>  
        <span>Asmaa Nasr</span>
    </div>
      
      
    </div>
        <ol class="carousel-indicators">
            <li data-target="#carousel_testimonials" data-slide-to="0" class="active">
               <img src="images/v1.jpg" alt="">
            </li>
            <li data-target="#carousel_testimonials" data-slide-to="1">
               <img src="images/v4.jpg" alt="">
            </li>
            <li data-target="#carousel_testimonials" data-slide-to="2">
               <img src="images/v3.jpg" alt="">
            </li>
            <li data-target="#carousel_testimonials" data-slide-to="3">
               <img src="images/v2.jpg" alt="">
            </li>
        </ol>
    </div>
      End Testimonials Carousel
  </div>        

</section>-->     
<!--End Section Testimonials -->

<!--Start Section Our Team-->
<section class="our_team text-center" >
            <div class="team">
                <div class="container">
                    <h2 class="h1">Meet Our Awesome Team</h2>
                        <div class="row">
                            <div class="col-lg-3 col-sm-4 col-xs-12">
                               <div class="person">
                                   <img class="img-circle" src="images/t3.png" alt="salma"/>
                                   <h3>Estshaad</h3>
                                   
                                  <a href="https://web.facebook.com/photo.php?fbid=2071183889797689&set=a.1374569982792420.1073741825.100007182931095&type=3&source=11&referrer_profile_id=100007182931095"> <i class="fa fa-facebook fa-2x"></i></a>
                                   
                                </div>
                             </div>
                             <div class="col-lg-2 col-sm-4 col-xs-12">
                               <div class="person">
                                   <img class="img-circle" src="images/t1.png" alt="salma" />
                                   <h3>Ganna</h3>
                                   
                                      <a href="https://web.facebook.com/photo.php?fbid=139827533022720&set=a.139612486377558.1073741826.100009864224022&type=3&source=11&referrer_profile_id=100009864224022"> <i class="fa fa-facebook fa-2x"></i></a>
                                   
                                </div>
                             </div>
                            <div class="col-lg-2 col-sm-4 col-xs-12">
                               <div class="person">
                                   <img class="img-circle" src="images/t6.png" alt="ali"/>
                                   <h3>Aisha</h3>

                                      <a href="https://web.facebook.com/photo.php?fbid=1703542929897664&set=a.1379300262321934.1073741825.100007259193284&type=3&source=11&referrer_profile_id=100007259193284"> <i class="fa fa-facebook fa-2x"></i></a>
                                </div>
                             </div>
                            <div class="col-lg-2 col-sm-4 col-xs-12">
                               <div class="person">
                                   <img class="img-circle" src="images/t4.png" alt="omar"/>
                                   <h3>Fatma</h3>
                                   
                                 
                                   <a href="https://web.facebook.com/photo.php?fbid=139827533022720&set=a.139612486377558.1073741826.100009864224022&type=3&source=11&referrer_profile_id=100009864224022"> <i class="fa fa-facebook fa-2x"></i></a>
                                    
                                </div>
                             </div>
                            <div class="col-lg-3 col-sm-4 col-xs-12">
                               <div class="person">
                                   <img class="img-circle" src="images/t5.png" alt="amal"/>
                                   <h3>Zynab</h3>
                                   
                                        <a href="https://web.facebook.com/photo.php?fbid=139827533022720&set=a.139612486377558.1073741826.100009864224022&type=3&source=11&referrer_profile_id=100009864224022"> <i class="fa fa-facebook fa-2x"></i></a>
                                </div>
                             </div>
                        </div>
                </div> 
            </div>  
</section>    
<!--End Section Our Team-->
    <!--Start Section add opinion-->
<h1 class='text-center'>your opinion </h1>
    <div class="container">

  <form class="form-horizontal"  method="POST" >

  
    
    
   <!--start  opinion field-->
      <div class="form-group form-group-lg">
      <label class="col-sm-2 control-label">Opinion</label>
        <div class="col-sm-10 col-md-6">
        <textarea  name="opinion" rows="5" cols="30" style="width:450px; height:96px;" required="required">
        </textarea>

        </div>  
      </div>
     
  <!-- end opinion field -->
      <!-- start userName field -->  
      <div class="form-group form-group-lg">
        <label class="col-sm-2 control-label">UserName</label>
        <div class="col-sm-10 col-md-6">
        <input type="text"
          name="username"
          
          placeholder="userName"
          >
        </div>  
      </div>
     
  <!-- end userName field --> 
    <!--start submit field-->
      <div class="form-group form-group-lg">
        <div class="col-sm-offset-2 col-sm-2">
          <input type="submit" value="Add opinion" class="btn btn-primary btn-sm">
        </div>
        
      </div>
    </form>
  <!--end submit field-->
    </div>
      
    

    <?php
     if($_SERVER['REQUEST_METHOD']=='POST'){
            $opinion   =filter_var($_POST['opinion'],FILTER_SANITIZE_STRING);
            $user=$_POST['username'];
            
            
          
         if(! empty($opinion)){
             $stmt = $con->prepare("INSERT INTO
   opinions (Opinion,Share,UserName)
             VALUES(:zopinion,0,:zuser)");
             
             $stmt->execute(array(
             
             'zopinion' => $opinion,
                'zuser'=> $user 
                 
             ));
             if($stmt){
                 
                 echo '<div class="alert alert-success">Your Opinion Added </div>';
             }
             
         }   
            
        }
        ?>
    <!--End Section add opinion-->
    <!--Start Section statistics-->
<section class="statistics text-center" >
    <div class="data">
        <div class="container">
          <h2 class="h1">Our Main statistics</h2>
            <div class="row">
                <div class="col-lg-4 col-sm-6 col-xs-12">
                    <div class="stats">
                        <i class="fa fa-users fa-5x"></i>
                        <p><?php echo checkItem("RegStatus","users",1)?></p>
                        <span>Satisfied Users</span>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-xs-12">
                    <div class="stats">
                        <i class="fa fa-comments fa-5x"></i> 
                        <p><?php echo checkItem("Status","posts",1)?></p>
                        <span>Activate Posts</span>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-xs-12">
                    <div class="stats">
                        <i class="fa fa-suitcase fa-5x"></i>
                        <p><?php echo checkItem("Approve","items",1)?></p>
                         <span>Activate Flats</span>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>    
<!--End Section our stastics-->
<!--Staart Section Contact us-->
       <section class="contact-us text-center" >
        <div class="fields"> 
            <div class="container">
                <div class="row">
                <i class="fa fa-headphones fa-5x"></i>
                <h2 class="h1">Tell Us What You Fell</h2>
                <p class="lead">Feel Free To Contact Us Any Time</p>
                 
                <!--start contact form -->
                  <form role="form" method="post" action="contact.php" >
                      
                      <div class="col-md-6 " >
                         <div class="form-group">
                             <textarea class="form-control input-lg" placeholder="your Message" name="message"></textarea>
                         </div>
                           <input type="submit" value="Contact US" class="btn btn-danger btn-lg btn-block"> 
                      </div>
                   </form>
                <!--end contact form -->
                </div>    
             </div>
         </div>    
    </section>
    <!--End Section Contact us--> 
<?php
	include $tp1.'footer.php';
  ?>