<?php
function pr($arr){
	echo '<pre>';
	print_r($arr);
}

function prx($arr){
	echo '<pre>';
	print_r($arr);
	die();
}

function get_safe_value($con,$str){
	if($str!=''){
		$str=trim($str);
		return mysqli_real_escape_string($con,$str);
	}
}

function get_product($con,$limit='', $cat_id='', $sub_id='', $product_id='',$search_str='',$sort_order='',$is_best_seller=''){
	$sql = "select product.*,categories.categories from product,categories where product.status=1";
	if($cat_id!=''){
		$sql.=" and product.categories_id=$cat_id ";
	}
	if($sub_id!=''){
		$sql.=" and product.subcategories_id=$sub_id ";
	}
	if($product_id!=''){
		$sql.=" and product.id=$product_id ";
	}
	if($is_best_seller!=''){
		$sql.=" and product.best_seller=1 ";
	}
	$sql.=" and product.categories_id=categories.id ";
	if($search_str!=''){
		$sql.=" and (product.name like '%$search_str%' or product.meta_keyword like '%$search_str%')";
	}
	if($sort_order!='')
	{
		$sql.=$sort_order;
	}else {
		$sql.=" order by product.id desc";
	}	
	if($limit!=''){
		$sql.=" limit $limit";
	}
	$res = mysqli_query($con, $sql);
	$data = array();
	while($row = mysqli_fetch_assoc($res)){
		$data[] = $row;
	}
	return $data;
}

function wishlist_add($con,$uid,$pid){
	$added_on=date('Y-m-d h:i:s');
	mysqli_query($con,"insert into wishlist(user_id,product_id,added_on) values('$uid','$pid','$added_on')");
}

function productSoldQtyByProductId($con,$pid){
	$sql="select sum(order_detail.qty) as qty from order_detail,order_master where order_master.id=order_detail.order_id and 
	order_detail.product_id=$pid and order_master.order_status!=4 and ((order_master.payment_type='instamojo' 
	and order_master.payment_status='Success') or (order_master.payment_type='COD' and order_master.payment_status!=''))";
	$res=mysqli_query($con,$sql);
	$row=mysqli_fetch_assoc($res);
	return $row['qty'];
}

function productQty($con,$pid){
	$sql="select qty from product where id='$pid'";
	$res=mysqli_query($con,$sql);
	$row=mysqli_fetch_assoc($res);
	return $row['qty'];
}

?>