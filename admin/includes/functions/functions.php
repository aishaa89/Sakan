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
/*
**count num of members function v1.0
**function to count num of members rows
**$item = the item to count
**$table = the table to choose from
*/

function countItems($item,$table){
    global $con ;
     $stmt2 = $con->prepare("SELECT COUNT($item) FROM $table");
          $stmt2->execute(); 
         echo $stmt2->fetchColumn();
}

/*
**get latest records function
**function to get latest items from database(users,items,comments)
**
**
*/
function getLatest($select,$table,$order,$limit=5){
    global $con;
    $getStmt = $con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");
    $getStmt->execute(); 
    $row = $getStmt->fetchAll();
    return $rows;
}

	
/*
**Home Redirect function v2.0
**this function accept parameters
**$theMsg=Echo the message (success|error|warning)
**$url=the link you want redirect to
**$seconds=seconds before redirecting
*/
function redirectHome($theMsg,$url,$seconds=10){
	if ($url===null) {
		$url='index.php';
		$link='HomePage';
	}else{
		if(isset($_SERVER['HTTP_REFERER'])&&$_SERVER['HTTP_REFERER']!=='')
		{
			$url=$_SERVER['HTTP_REFERER'];
			$link='previous page';
		}else{
			$url='index.php';
			$link='HomePage';
		}
	}
	echo $theMsg;
	echo "<div class='alert alert-info'>.you will be Redirected to $link after $seconds.</div>";
	header("refresh:$seconds,url=$url");
	exit();
}	
?>