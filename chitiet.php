<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
	<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<?php require_once("connect.php"); ?>

<?php
	if(isset($_GET["proid"])){
		$proid= $_GET["proid"];
		
		// Đọc DL từ database lên;
			$selectEditPro ="SELECT * FROM product WHERE ProID=$proid";
			$editResult =$conn->query($selectEditPro);
			if(!$editResult){
				die($conn->error);
			}
	}
	
?>
<body background="Image/smooth-vector-iphone-idownloadblog-wallpaper-notforyou666-mockup-1536x864-1.png">
<table width="50%" border="1" align="center">
  <tbody>
	  <?php while($proRow = mysqli_fetch_array($editResult)) { ?>
    <tr>
		<td width="27%">Product Name:</td>
      <td width="73%"><?php echo $proRow['ProName']; ?></td>
    </tr>
	  <tr>
		<td>Price:</td>
      <td><?php echo $proRow['Price']; ?></td>
    </tr>
	   <tr>
		 <td>Description:</td>
      <td><?php echo $proRow['Deription']; ?></td>
    </tr>
	  <?php }//end while?>
  </tbody>
	
	<b ><a href="homepage.php" >Back to main page</a></b>
</table>

</body>
</html>