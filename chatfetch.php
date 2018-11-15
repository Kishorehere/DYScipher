<?php 
$k=0;
if(isset($_GET[id]))
$id = $_GET['id'];
$clickedby = $_SESSION['user'];
if(isset($secret))
{
	$message = $_GET['str'];
	$query = "insert into message.table values (?,?,?,?)"; ;
if($stmt = mysqli_prepare($conn, $query));
mysqli_stmt_bind_params($stmt, $_GET['id'], $clickedby,$message);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $str);
while(mysqli_stmt_fetch($stmt))
{
	$obj[$k++] = $str;

}
}






$k = 0;
$obj = array();
$obj2 = array();
$query = "select messages from message.table where from  = ? and to = ? ORDER BY date" ;
if($stmt = mysqli_prepare($conn, $query)){
mysqli_stmt_bind_params($stmt, $clickedby, $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $str);
while(mysqli_stmt_fetch($stmt))
{
	$obj[$k++] = $str;

}
}
$k = 0;
$query = "select messages from message.table where from  = ? and to = ? ORDER BY date DESC" ;
if($stmt = mysqli_prepare($conn, $query)){
mysqli_stmt_bind_params($stmt, $id, $clickedby);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $str);
while(mysqli_stmt_fetch($stmt))
{
	$obj2[$k++] = $str;

}
}
$megaobj = array(2);
$megaobj[0] = $obj1;
$megaobj[1] = $obj2;
echo json_encode($megaobj);

?>




