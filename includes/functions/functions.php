<?php
/*
method getTitle() echo pageTitle if the page has title
Has variable $pageTitle and echo default if the page hasnot title
*/
function getTitle(){
	global $pageTitle;
	if (isset($pageTitle)) {
		echo $pageTitle;
		}else {
			echo "default";
		}
}
/*
	**check item function v1.0
	**check the item exist in database[function accept parameters]
	**$select=the item to select[example:user,item]
	**$from=the table to select from[example:users,items]
	**$value=the value of select[example:fatma,flat]
*/
	function checkItem($select,$from,$value){
		global $con;
		$stmt=$con->prepare("SELECT $select FROM $from WHERE $select=?");
		$stmt->execute(array($value));
		$count=$stmt->rowCount();
		return $count;
	}
/*Get All function v2.0
**function get all records from any database table
*/
	function getAllFrom($field,$table,$where=null,$and=null,$orderfield,$ordering="DESC"){
		global $con;
		$getAll=$con->prepare("SELECT $field FROM $table $where $and ORDER BY $orderfield $ordering");
		$getAll->execute();
		$all=$getAll->fetchAll();
		return $all;
	}
?>