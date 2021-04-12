<?php
	session_start();
	$flatStyle='';
	$pageTitle='Search Result';
	include 'init.php';
	?><?php
		if (count($_POST)>0) {
		
		$district=$_POST['district'];
		$min_price=$_POST['min_price'];
		$max_price=$_POST['max_price'];
		
		}
		
		echo"<h1 class='text-center'>Show Flats</h1>";
		$getAll=$con->prepare("SELECT *
		FROM items 
		WHERE District_id='$district'
		AND Price BETWEEN '$min_price' and '$max_price'
		");
		$getAll->execute();
		$allitems=$getAll->fetchAll();
		
?>
	<div class="container">
    <div class="row">
    <?php
    $i=0;
    foreach ($allitems as $item) {
    	$stmt=$con->prepare("SELECT Image
               			 FROM images
               			 WHERE Item_id={$item['Item_ID']}
               			 
               			  ");
               			$stmt->execute(array());
               			$image=$stmt->fetchAll();
    
   echo '<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">';
       echo '<div class="flat1">';
          echo '<div class="slider">';
          echo"<div id='carousel-example-generic' class='carousel slide' data-ride='carousel'>";
          echo '<ol class="carousel-indicators">';

	# code...
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
   

  echo'</div>';

 // <!-- Controls -->
  echo "<a class='left carousel-control' href='#carousel-example-generic' data-slide='prev'>";
   echo '<span class="glyphicon glyphicon-chevron-left"></span>';
 echo '</a>';
  echo"<a class='right carousel-control' href='#carousel-example-generic' data-slide='next'>";
    echo'<span class="glyphicon glyphicon-chevron-right"></span>';
  echo'</a>';
echo'</div>';
echo'</div>';
    echo'<div class="p">';

      echo' <div class="column1">';
	        echo "<p><strong  style='color:green;'> العنوان:</strong></p>";

	       echo " <p><strong>
	        {$item['Address']} <br/>
	       						
	         الوصف:{$item['Description']}<br/>
	    	</strong></p>";
  		echo '</div>';
 		echo '<div class="column2">';
	       echo "<p><strong> السعر:{$item['Price']}<br/>

	       تاريخ اضافة الشقة:{$item['Add_Date']}<br/>
	        
	        
	     </strong></p>";
	     echo "<p><strong>";
	     if ($item['Renting']==0) {
							echo "Not Rented";
						}elseif ($item['Renting']==1) {
							echo "Rented And May be not completed";
						}
			echo"</strong></p>";

	     echo"<a href='order.php?itemid=".$item['Item_ID']."'  class='btn btn-warning'>Order Now</a>"; 

	    echo '</div>';
          
       echo'</div>';
         
   echo '</div>';
  echo '</div>';}
  ?>
   </div>
	</div>
	<?php
	include $tp1.'footer.php';?>