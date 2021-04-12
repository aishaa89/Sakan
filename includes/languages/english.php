<?php
function lang($phrase){
	static $lang=array
	(
		'Message' =>'welcome' ,
		'Admin'=>'Administrator' );
		return $lang[$phrase] ;
}
?>