<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<?php
	
	 session_start();
	if(isset($_SESSION["User"])){
		$user=$_SESSION['User'];
		echo "<h3 align='right'>Xin chào bạn $user <a href='logout.php'> Logout </a></h3> ";

	}else{
		header("Location:login.php");
		
	}
	
	
?>
<body>
	<table width="500" border="1">
  <tbody>
    <tr>
      <td><a href="category.php">Category</a></td>
    
    </tr>
    <tr>
      <td><a href="AddnewProduct.php">Product</a></td>
     
    </tr>
    <tr>
      
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>

</body>
</html>