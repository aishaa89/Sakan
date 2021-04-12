<!--Start My Navbar-->
<nav class="navbar  navbar-inverse ">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
       <!--<a class="navbar-brand" href="#"><?php/* echo lang('HOME_ADMIN')*/ ?></a>-->
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="app-nav">
      <ul class="nav navbar-nav">
         <li><a href="dashboard.php"><?php echo lang('HOME_ADMIN'); ?></a></li>
         <li><a href="members.php"><?php echo lang('MEMBERS'); ?></a></li>
        <li><a href="items.php"><?php echo lang('ITEMS'); ?></a></li>
        
        <li><a href="posts.php"><?php echo lang('POSTS'); ?></a></li>
        <li><a href="orders.php"><?php echo lang('ORDERS'); ?></a></li>
        <li><a href="opinions.php"><?php echo lang('OPINIONS'); ?></a></li>
        <li><a href="faqs.php"><?php echo lang('FAQS'); ?></a></li>
        <li><a href="contact.php"><?php echo lang('CONTACTS'); ?></a></li>
        
        
        </ul>
        <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php
          if (isset($_SESSION['userName'])) {
     echo $_SESSION['userName'];} ?> 
     <span class="caret"></span></a>
          <ul class="dropdown-menu">
          
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
        </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
    
    
    
    
    
    
    
</nav>
    
<!--End My Navbar-->












