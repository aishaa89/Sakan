<?php 

$do ='';
    /*
      categories => [ manage,edit,update,add,insert,delete,stats ]
    */
if (isset($_GET['do'])){
    $do = $_GET['do'];
}else{
    $do = 'Manage';
}
//if the page is main page
if ($do == 'Manage') {
    
   echo 'welcome you are in manage category page ';
   echo '<a href ="?do=Add">Add New Category +</a>';
    
} elseif ($do == 'Add') {
    
    echo 'welcome you are in add category page' ;
    
} elseif ($do == 'Insert') {
    
    echo 'welcome you are in insert category page' ;
    
} elseif ($do == 'Delete') {
    
    echo 'welcome you are in delete category page' ;
        
} else {
    
    echo 'error! there is not page with this name';
}




































