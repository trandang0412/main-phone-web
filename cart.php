<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<?php
	require_once("connect.php");
	session_start();
	
	// kiem tra gio hang rong thi thong bao
	if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
		
		echo 'Giỏ hàng rỗng';
		echo"<br><a href='homepage.php'>Tiếp tục chọn hàng</a>";
	}else{
	
		// lấy các id của sản phẩm đưa vào mảng để lát làm cau select
	foreach($_SESSION['cart'] as $item=>$value){
		$arrayID[] =$item;
	}
	$str= join(",",$arrayID);
	echo $str;
	
	// xóa 1 sp trong giỏ hàng
	
	if(!empty($_GET['id'])){
		$id =$_GET['id'];
		unset($_SESSION['cart'][$id]);
		header("location:cart.php");
	}
	}
	
	// xóa toàn bộ giỏ hàng
	if(isset($_POST['cancel'])){
		unset($_SESSION['cart']);
		echo 'Giỏ hàng rỗng';
		echo"<br><a href='index.php'>Tiếp tục chọn hàng</a>";
		return;
	}
	if(isset($_POST['checkout'])){
		
		header("location:homepage.php");
		/*
		// kiểm tra biến session user đã login chưa?
		if(isset($_SESSION['User']) && isset($_SESSION['customerID'])){
			$custID =$_SESSION['customerID'];
			
		// thi làm việc insert dl vào 2 bảng order và orderdetail
		}else{// chuyển tới trang login
			
			header("location:login.php");
		}
		*/
	}
		
		
?>
	
	
<body>
	<form method="post">
	<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td width="15%">Thứ tự</td>
      <td width="20%">Tên sản phẩm</td>
      <td width="14%">Hình</td>
      <td width="11%">Giá</td>
      <td width="18%">Số lượng</td>
      <td width="22%">Thành tiền</td>
    </tr>
	  
	 <?php
	  // lay du lieu tu database de hien thi lên trên table
	  	$sql ="SELECT * FROM product where ProID in ({$str})";
	   echo $sql;
	  	
	  	$result =$conn->query($sql);
	  if(!$result){
				die($conn->error);
			}
	  	$dem =0;
	  	$total =0;
	  
	  	foreach($result as $item){
			$dem = $dem+1;
			$id=$item['ProID'];
			$name =$item['ProName'];
			$price =$item['Price'];
			$qty=$_SESSION['cart'][$id];
			$money =$price *$qty;
			$total =$total +$money;
			
			echo"<tr>";
			echo"<td>{$dem}</td>";
			echo"<td>{$name}</td>";
			echo"<td>{$price}</td>";
			echo"<td>{$qty}</td>";
			echo"<td>{$money} | <a href='cart.php?id={$id}'>Xóa</td>";
			echo"</tr>";
			
			
		}
	  
	  ?>
    
    <tr>
      
      <td colspan="5">Tổng tiền</td>
      <td><?php echo $total; ?></td>
    </tr>
  </tbody>
</table>
<a href="homepage.php">Tiếp tục mua hàng</a>
<input type="submit" name="cancel" value="Hủy giỏ hàng" />
<input type="submit" name="checkout" value="Check out" />
	</form>
</body>
</html>