<?php
    function lang($phrase){
      static $lang = array(
        
          //navbar links
          'HOME_ADMIN' => 'Admin Area' ,
         'ITEMS'      => 'Items' ,
          'MEMBERS'    => 'Member' ,
          'POSTS' => 'Posts' ,
          'ORDERS'  => 'Orders',
          'CONTACTS'=>'contacts',
          'OPINIONS'=>'Opinions',
          'FAQS'=>'faqs'
      );
        
    return $lang[$phrase] ;
 }
