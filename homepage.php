<?php
		//connect to database
		require_once "connect.php";
	?>
	<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mind Phone</title>
	<link href="css/style.css" rel="stylesheet"/>
</head>

<?php
	// Đây là query lấy tất cả category trong database 
	$qrpro ="SELECT * FROM pro";
	
	$proResult= $conn->query($qrpro);
?>
	<?php
	// đây là query lấy product dựa trên category
	if(isset($_GET['CatID'])){
		$catID =$_GET['CatID'];
		$qrproduct ="SELECT * FROM product where CategoryID=$catID";
		$productResult= $conn->query($qrproduct);
	}
	
 
?>

	
<body background="Image/smooth-vector-iphone-idownloadblog-wallpaper-notforyou666-mockup-1536x864-1.png">
	
<div id="head">
	<table width="100%" border="0">	
		<tr>
			<td width="24%" >
				<img src="Image/logo.png" height=77px width=200px/>
			</td>
			<td width="37%" align="center" >
				<input id="search" type="text" placeholder="Type here"   />
	    		<input id="submit" type="submit" value="Search"  />
			</td>
			<td width="16%" align="center">
				<h><div class="p"><a href="cart.php">Cart</a></div></h>
			</td>
			<td width="23%" align="center">
				<h ><a href="login.php">AddLogin</a> | <a href="#">UserLogin</a> </h>
			</td>
		</tr>
	 	
</table>
</div>			
		
		<ul>
				<div id="side">
				<?php while($catRow =mysqli_fetch_array($proResult)) {?>
				<ol><a href="homepage.php?CatID=<?php echo $catRow['CategoryID'];?>"><?php echo $catRow['CateName']?> </a></ol>
				<?php }// end while loop ?>
				</div>
		</ul>	
			<div id="content">
				<table width="700" height="219" border="0">
					<tr>
						<td>
						<?php
							$truyvan ="SELECT * FROM product where proID='1'";

							$result =$conn->query($truyvan);

							while($row =mysqli_fetch_array($result)){
								echo'<br>';
								echo 'product Name: '.$row['ProName'].'<br>';
								echo 'Price: '.$row['Price'].'<br>';
								echo 'Description: '.$row['Deription'].'<br>';
								echo 'Image: ' .$row['Img'];
						}
						?>
						</td>
						<td>
							<?php
							$truyvan ="SELECT * FROM product where proID='2'";

							$result =$conn->query($truyvan);

							while($row =mysqli_fetch_array($result)){
								echo'<br>';
								echo 'product Name: '.$row['ProName'].'<br>';
								echo 'Price: '.$row['Price'].'<br>';
								echo 'Description: '.$row['Deription'].'<br>';
								echo 'Image: ' .$row['Img'];
						}
						?>
						</td>
						<td>
							<?php
							$truyvan ="SELECT * FROM product where proID='3'";

							$result =$conn->query($truyvan);

							while($row =mysqli_fetch_array($result)){
								echo'<br>';
								echo 'product Name: '.$row['ProName'].'<br>';
								echo 'Price: '.$row['Price'].'<br>';
								echo 'Description: '.$row['Deription'].'<br>';
								echo 'Image: ' .$row['Img'];
						}
						?>
						</td>
					</tr>
				</table>
						<?php if (isset($_GET['CatID'])) {?>
				<table width="642" height="119" border="1">
							<?php while($proRow = mysqli_fetch_array($productResult)) { ?>
							<tr>
							  <td width="200">Thông tin Sản phẩm:</td>
							  <td width="150"><?php echo $proRow['ProName']; ?><br>
								Giá: <?php echo $proRow['Price']; ?>;<Br>
								Số lượng: <?php echo $proRow['quantity']; ?>
							</td>
								<td width="270">
								  <a href=chitiet.php?proid=<?php echo $proRow['ProID'] ?> >
										<img src="<?php echo $proRow['Img'];?>" width="100px" height="100px" />
									</a>
								</td>
								<td>
									<td><a href="addcart.php?proID=<?php echo $proRow['ProID'];?>">Add to cart</a></td>
								</td>	
								
							</tr>
								
										<?php } // end while ?>
							</table>
					<?php } // end if?>
			</div>
	
	
<div id="footer">
	<table border="1" Align="center">
		<tr><td>
			<b><?php include"footer.php"?></b>
		</td></tr>
	</table>
</div>

</body>
	
</html>