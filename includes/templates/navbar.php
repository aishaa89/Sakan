<!--Start My Navbar-->
<nav class="navbar navbar-default navbar-inverse navbar-fixed-top">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        <a class="navbar-brand hvr-bounce-in" href="#">Sakan <span>azhari</span></a>
        <!--          

       -->
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li  class="active"><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="faq.php">FAQ</a></li>
          <li ><a href="flats.php">Flats</a></li>
          
           <li ><a href="advertise.php">Add Advertisement</a></li>
           <li><a href="map.php">MAP</a></li>
    
        <li ><a href="posts.php">Discution Port</a></li>
          <li ><?php
          if (isset($_SESSION['user'])) {
     echo "<a>".$_SESSION['user']."</a>";
      # code...
    }else{
      echo "<a href='login.php'>Login</a>";
    }
          ?></li>
          
          <li><a href="logout.php">Logout</a></li>
        </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
    
<!--End My Navbar-->