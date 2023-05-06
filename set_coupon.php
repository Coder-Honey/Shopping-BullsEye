<?php
require('connection.inc.php');
require('functions.inc.php');
$coupon_str=get_safe_value($con,$_POST['coupon_str']);
$res=mysqli_query($con,"select * from coupon_master where coupon_code='$coupon_str' and status='1'");
$count=mysqli_num_rows($res);
$jsonArr=array();
$cart_total=0;
$sub_total = 0;
$delivery = 50;
if(isset($_SESSION['COUPON_ID'])){
	unset($_SESSION['COUPON_ID']);
	unset($_SESSION['COUPON_CODE']);
	unset($_SESSION['COUPON_VALUE']);
}
foreach($_SESSION['cart'] as $key=>$val){    
	$productArr=get_product($con,'','','',$key);
	$price=$productArr[0]['price'];
	//$qty=$val['qty'];
	//$cart_total=$cart_total+($price*$qty);
	$qty=$val['qty'];
    $sub_total = $sub_total+($price*$qty);
    $cart_total = $sub_total + $delivery;
}
if($count>0){
	$coupon_details=mysqli_fetch_assoc($res);
	$coupon_value=$coupon_details['coupon_value'];
	$id=$coupon_details['id'];
	$coupon_type=$coupon_details['coupon_type'];
	$cart_min_value=$coupon_details['cart_min_value'];
	
	if($cart_min_value>$cart_total){
		$jsonArr=array('is_error'=>'yes','result'=>$cart_total,'dd'=>'Cart total value must be '.$cart_min_value);
	}else{
		if($coupon_type=='Rupee'){
			$final_price=$cart_total-$coupon_value;
			$_SESSION['FINAL_PRICE']=$final_price;
		}else{
			$final_price=$cart_total-(($cart_total*$coupon_value)/100);
			$_SESSION['FINAL_PRICE']=$final_price;
		}
		$dd=$cart_total-$final_price;
		$_SESSION['COUPON_ID']=$id;
		$_SESSION['FINAL_PRICE']=$final_price;
		$_SESSION['COUPON_VALUE']=$dd;
		$_SESSION['COUPON_CODE']=$coupon_str;
		$jsonArr=array('is_error'=>'no','result'=>$final_price,'dd'=>$dd);
	}
	
}else{
	$jsonArr=array('is_error'=>'yes','result'=>$cart_total,'dd'=>'Coupon code not found');
}
echo json_encode($jsonArr);
?>