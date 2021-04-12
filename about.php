<?php
	session_start();
	$pageTitle='about';
	include 'init.php';
	?>
	<!--Start about us intro-->
<section class="about-us text-center" >
    <div class="contaier">
        <h1>About Us</h1>
        <hr>
        <p class="lead">We Creat Your Degital Dream Just Think And Tell Us What You Need<br>
            Or Leave The Inspiration To Us , Just Watch And Just Believe In Our Proffesionals</p>
        <img class="img-thumbnail" src="images/set.jpg" alt="team">
    </div>
</section>
<!--End about us intro-->
<!--Start about Features-->
<section class="about-features text-center">
    <div class="container">
        <div class="row">
          <div class="col-sm-4">
              <i class="fa fa-code fa-3x"></i>
              <h3>we love code</h3>
        </div>
        <div class="col-sm-4">
              <i class="fa fa-child fa-3x"></i>
              <h3>we are happy</h3>
        </div>
        <div class="col-sm-4">
              <i class="fa fa-group fa-3x"></i>
              <h3>we are social</h3>
        </div>
        </div>
    </div>
</section>   
<!--End about Features-->
	<?php
	include $tp1.'footer.php';?>