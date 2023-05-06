<?php
require('top.inc.php');
$order_id = get_safe_value($con,$_GET['id']);
if(isset($_POST['update_order_status'])){
    $update_order_status = $_POST['update_order_status'];
    mysqli_query($con,"update order_master set order_status='$update_order_status' where id='$order_id'");
}

$coupon_details=mysqli_fetch_assoc(mysqli_query($con,"select coupon_value from order_master where id='$order_id'"));
$coupon_value=$coupon_details['coupon_value'];
if($coupon_value==''){
	$coupon_value=0;	
}
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Order Detail </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
				   <table class="table">
                    <thead>
                            <tr>
                                <th class="product-thumbnail">Product Name</th>
                                <th class="product-thumbnail">Product Image</th>
                                <th class="product-name"><span class="nobr">Qty</span></th>
                                <th class="product-price"><span class="nobr">Price</span></th>
                                <th class="product-stock-stauts"><span class="nobr">Total Price</span></th>                                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $res = mysqli_query($con,"select distinct(order_detail.id),
                                order_detail.*,product.name,product.image,
                                order_master.house_no,order_master.address,order_master.city,order_master.pincode
                                from order_detail,product,order_master
                                where order_detail.order_id='$order_id' and order_detail.product_id = product.id GROUP by order_detail.id");
                                $total_price = 0;
                                $delivery = 50;
                                while($row = mysqli_fetch_assoc($res)){
                                    $house_no = $row['house_no'];
                                    $address = $row['address'];
                                    $city = $row['city'];
                                    $pincode = $row['pincode'];                                                
                                    $total_price = $total_price + ($row['qty']*$row['price']);
                            ?>
                            <tr>                                                
                                <td class="product-name"><?php echo $row['name']?></td>
                                <td class="product-name"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']?>"></td>
                                <td class="product-name"><?php echo $row['qty']?></td>
                                <td class="product-name"><?php echo $row['price']?></td>
                                <td class="product-name"><?php echo $row['qty']*$row['price']?></td>
                            </tr>      
                            <?php } 
								if($coupon_value!=''){
							?>
							<tr>
								<td colspan="3"></td>
								<td class="product-name">Coupon Value</td>
								<td class="product-name"><?php echo $coupon_value?></td>                                                
                            </tr>
							<?php } ?>
                            <tr>
								<td colspan="3"></td>
								<td class="product-name">Delivery Charges</td>
								<td class="product-name"><?php echo $delivery?></td>                                                
                            </tr>
							<tr>
								<td colspan="3"></td>
								<td class="product-name">Total Price</td>
								<td class="product-name">
								<?php 
									echo $total_price-$coupon_value+$delivery;
								?></td>                                                
                            </tr>                                  
                        </tbody>                                        
                    </table>
                    <div id="address_details">
                        &nbsp;&nbsp;&nbsp;<strong>Address</strong>
                        <?php echo $house_no?>, <?php echo $address?>, <?php echo $city?>, <?php echo $pincode?><br/><br/>
                        &nbsp;&nbsp;&nbsp;<strong>Order Status</strong>
                        <?php 
                            $order_status_arr = mysqli_fetch_assoc(mysqli_query($con,"select order_status.name from order_status,order_master
                            where order_master.id='$order_id' and order_master.order_status = order_status.id"));
                            echo $order_status_arr['name'];
                        ?>

                        <div>
                            <form method="post">
                                <select class="form-control" name="update_order_status">
									<option>Select Order Status</option>
									<?php
										$res=mysqli_query($con,"select * from order_status");
										while($row=mysqli_fetch_assoc($res)){
											if($row['id']==$categories_id){
												echo "<option selected value=".$row['id'].">".$row['name']."</option>";
											}else{
												echo "<option value=".$row['id'].">".$row['name']."</option>";
											}											
										}
									?>
								</select>
                                <input type="submit" class="form-control"/>
                            </form>
                        </div>
				    </div>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
</div>
<?php
require('footer.inc.php');
?>