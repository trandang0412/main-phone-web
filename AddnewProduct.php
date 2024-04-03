<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
	<link href="css/style.css" rel="stylesheet"/>
</head>
			<?php
			// session_start();
			//if(isset($_SESSION["id"])){
			//$user=$_SESSION['id'];
			//echo "Xin chào bạn $user ";

			//}else{
			//	header("Location:login.php");	
			//}

			?>
	
	<?php
		//connect to database
		require_once"connect.php";
	?>
	
	<?php
	// Đây là query lấy tất cả category trong database 
	$qrproduct ="SELECT * FROM product";
	$productResult= $conn->query($qrproduct);
	?>
	
	

<?php
	// Đây là query lấy tất cả category trong database 
	$qrpro ="SELECT * FROM pro";
	
	$proResult= $conn->query($qrpro);
?>
		
<?php
		// check lay thong tin de edit du lieu
	if(isset($_GET['EditID'])){
		$editProID =$_GET['EditID'];
		
		// Đọc DL từ database lên;
			$selectEditPro ="SELECT * FROM product WHERE ProID=$editProID";
			$editResult =$conn->query($selectEditPro);
			if(!$editResult){
				die($conn->error);
			}
	
	}
?>
<?php
		// lay thông tin để xóa dữ liệu
	
	if(isset($_GET['DelID'])){
		
		$delid = $_GET['DelID'];
		
		$deletePro ="DELETE FROM product WHERE ProID=$delid";
		$deletePro =$conn->query($deletePro);
			if(!$deletePro){
				die($conn->error);
			}
	}
?>
<?php
	
	//if ( isset( $_POST['submit'] ) ) {  // 1 trong 2 cách cái nào cũng được
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			
				// check upload photo
				$path="";
				if($_FILES){

					$filename =$_FILES["Img"]["tmp_name"];
					$path ="Image/productimages/".$_FILES["Img"]["name"];
					move_uploaded_file($filename,$path);
					
				}
			
			
				$catID =$_POST['slCat'];
				$proName =$_POST['txtProName'];
				$proPrice =$_POST['txtPrice'];
				$proDes =$_POST['txtDescrip'];
				$proQuan = $_POST['txtquantity'];
				$Img=$path;
			
			if(isset($_POST['txtProductID'])){
				$proID = $_POST['txtProductID'];
				if($proID!=0){// edit product id
			
					$updatePro= "UPDATE product SET ProName='$proName', Price=$proPrice,quantity=$proQuan,Deription='$proDes',Img='$Img' WHERE ProID=$proID";

					$updateSucc =$conn->query($updatePro);


					if(!$updateSucc){
						echo '<br> Insert/edit error! '.$updatePro;
					}
				}
				
			}else{// ko edit ma insert
			
				$insertProduct ="INSERT INTO product( ProName, Price, quantity, Deription, Img, CategoryID) VALUES ('$proName',$proPrice,$proQuan,'$proDes','$Img',$catID)";
			
				$insertSucc =$conn->query($insertProduct);

				//echo $insertCus;
				//
				if(!$insertSucc){
					echo '<br> Insert/edit error! '.$insertProduct;
				}
			}
			
			
			
		}
	
		// Đọc DL từ database lên;
			$selectPro ="SELECT * FROM product";
			$result =$conn->query($selectPro);
			if(!$result){
				die($conn->error);
			}
			
	
?>
	
	
<?php if(!isset($_GET['EditID'])){ ?>
<!-- Start Add new Product Form!-->	
	
<body background="Image/smooth-vector-iphone-idownloadblog-wallpaper-notforyou666-mockup-1536x864-1.png">
	<b><a href="homepage.php">Back to main page</a></b>
	<form action="AddnewProduct.php" method="post" enctype="multipart/form-data" name="frmProduct">
			<table align="center" height="400px" width="1239" border="0">
				<tr >
					<h4><td colspan="2" align="center"><div class="p">INSERT NEW PRODUCT </div></td></h4>
				</tr>
				<tr>
					<td width="266"><b>CateName</b></td>
					<td width="963">
						<select name="slCat">
						<?php while($catRow =mysqli_fetch_array($proResult)) {?>
						<option value="<?php echo $catRow['CategoryID']; ?>"><?php echo $catRow['CateName']; ?></option>  

						<?php }//end while ?>

						</select></td>
				</tr>
				<tr>
					<td>ProductID</td>
					<td><input type="text" name="txtProductID" disabled="true"/></td>
				</tr>
				<tr>
					<td><b>	ProName</b></td>
					<td><input type="text" name="txtProName"/></td>
				</tr>
				<tr>
					<td><b>Quantity</b></td>
					<td><input type="text"name="txtquantity"></td>
				</tr>
				<tr>
					<td><b>Price</b></td>
					<td><input type="number" name="txtPrice"></td>
				</tr>
				<tr>
					<td><b>Description</b></td>
					<td><textarea cols="30" rows="10" name="txtDescrip"></textarea></td>
				</tr>
				<tr>
					<td><b>Image</b></td>
					<td><input type="file" name="Img"></td>
				</tr>
				<tr>
					<td	><input type="reset" value="Reset"></td>
					<td align="center"><input type="submit" value="Save"></td>
				</tr>
			</table>
	</form>
	<?php } ?>
	
<?php if(isset($_GET['EditID'])){ ?>
	<form action="AddnewProduct.php" method="post" enctype="multipart/form-data" name="frmCusEdit">
<?php	while($rowedit=mysqli_fetch_assoc($editResult)){ ?>
	<!-- Start Add new Edit Form!-->
<body background="Image/smooth-vector-iphone-idownloadblog-wallpaper-notforyou666-mockup-1536x864-1.png"	>
	<table width="500" border="0" align="center" >

    <tr>
      <td colspan="2" align="center">EDIT CURRENT PRODUCT</td>
    </tr>
    <tr>
      <td>Category</td>
      <td>
		<select name="slCat">
			<?php while($catRow =mysqli_fetch_array($proResult)) {?>
			<option value="<?php echo $catRow['CategoryID']; ?>"><?php echo $catRow['CateName']; ?></option>  
			
			<?php }//end while ?>
		</select>
	</td>
    </tr>
    <tr>
      <td width="171">Product ID</td>
      <td width="313"><input type="text" name="txtProductID" value="<?php echo $rowedit['ProID']; ?>" size="30" /></td>
    </tr>
    <tr>`
      <td>Product Name</td>
      <td><input type="text" name="txtProductName" value="<?php echo $rowedit['ProName']; ?>" size="30" /></td>
    </tr>
    <tr>
      <td>Price</td>
      <td><input type="text" name="txtPrice" value="<?php echo $rowedit['Price']; ?>" size="10" /></td>
    </tr>
    <tr>
      <td>Quantity</td>
      <td><input type="text" name="txtQuantity" value="<?php echo $rowedit['quantity']; ?>"  size="10" /></td>
    </tr>
    <tr>
      <td>Image</td>
      <td><input type="file" name="productImg"  />
		<img src="<?php echo $rowedit['Img']; ?>" width="100" height="100" />
		  <input type="hidden" name="hdimgPath" value="<?php echo $rowedit['Img']; ?>" />
	</td>
    </tr>
    <tr>
      <td>Description</td>
      <td><textarea name="txtMota" cols="50" rows="10"><?php echo $rowedit['Deription']; ?> </textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" value="Save edit"  name="submit"/>&nbsp;&nbsp;&nbsp;<input type="reset" value="Reset form" /></td>
    </tr>
</table>
</body>
	
	<?php
		 }//end while ?>
		</form>						 
	<?php }//end if ?>
	
	
	<table width="100%" border="1">
  <tbody>
    <tr>
      <td width="11%">Produtct ID</td>
      <td width="18%">Product Name</td>
      <td width="12%">Price</td>
      <td width="12%">Quantity</td>
      <td width="10%">picture</td>
      <td width="15%">Description</td>
      <td width="12%">Category</td>
		<td width="10%">Modify</td>
    </tr>
    <?php while($proRow = mysqli_fetch_array($result)) { ?>
	  <tr>
     
		<td><?php echo $proRow['ProID'];?></td>
		<td><?php echo $proRow['ProName'];?></td>
		<td><?php echo $proRow['Price'];?></td>
		<td><?php echo $proRow['quantity'];?></td>
		<td><?php echo $proRow['Deription'];?></td>
		<td><img src="<?php echo $proRow['Img'];?>" width="100" height="100" /></td>
		<td><?php echo $proRow['CategoryID'];?></td>
		<td ><a href="AddnewProduct.php?EditID=<?php echo $proRow['ProID']?>">Edit</a> | <a href="AddnewProduct.php?DelID=<?php echo $proRow['ProID']?>">Delete</a></td>
    </tr>
	  <?php }// end while?>
  </tbody>
</body>
</html>