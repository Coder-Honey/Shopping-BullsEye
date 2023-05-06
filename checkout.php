<?php require('top.php');
if(!isset($_SESSION['cart']) || count($_SESSION['cart'])==0){
    ?>
    <script>
        window.location.href='index.php';
    </script>
    <?php
}

$sub_total = 0;
$delivery = 50;
$cart_total = 0;
$errMsg="";

if(isset($_POST['submit'])){
    $house_no = get_safe_value($con,$_POST['house_no']);
    $address = get_safe_value($con,$_POST['address']);
    $city = get_safe_value($con,$_POST['city']);
    $pincode = get_safe_value($con,$_POST['pincode']);
    $payment_type = get_safe_value($con,$_POST['payment_type']);
    $user_id = $_SESSION['USER_ID'];
    foreach($_SESSION['cart'] as $key=>$val){
        $productArr=get_product($con,'','','',$key);
        $price=$productArr[0]['price'];
        $qty=$val['qty'];
        $sub_total = $sub_total+($price*$qty);
        $cart_total = $sub_total + $delivery;
    }
    $total_price = $cart_total;
    $payment_status='pending';
    if($payment_type=='cod'){
        $payment_type = 'success';
    }
    $order_status = '1';
    $added_on = date('Y-m-d h:i:s');

    $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);

    if(isset($_SESSION['COUPON_ID'])){
		$coupon_id=$_SESSION['COUPON_ID'];
		$coupon_code=$_SESSION['COUPON_CODE'];
		$coupon_value=$_SESSION['COUPON_VALUE'];
		$total_price=$_SESSION['FINAL_PRICE'];
		unset($_SESSION['COUPON_ID']);
		unset($_SESSION['COUPON_CODE']);
		unset($_SESSION['COUPON_VALUE']);
        //unset($_SESSION['FINAL_PRICE']);
	}else{
		$coupon_id='';
		$coupon_code='';
		$coupon_value='';	
	}

    mysqli_query($con,"insert into order_master (user_id,house_no,address,city,pincode,payment_type,total_price,payment_status,order_status,coupon_id,coupon_code,coupon_value,added_on) values('$user_id','$house_no','$address','$city','$pincode','$payment_type','$total_price','$payment_status','$order_status','$coupon_id','$coupon_code','$coupon_value','$added_on')");

    $order_id = mysqli_insert_id($con);
    foreach($_SESSION['cart'] as $key=>$val){
        $productArr=get_product($con,'','','',$key);
        $price=$productArr[0]['price'];
        $qty=$val['qty'];

        mysqli_query($con,"insert into order_detail (order_id,product_id,qty,price) values('$order_id','$key','$qty','$price')");       
    }
    
    if($payment_type=='instamojo'){
            
        $userArr=mysqli_fetch_assoc(mysqli_query($con,"select * from users where id='$user_id'"));
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key: test_5ca3941ede740be6203d20acdb8","X-Auth-Token: test_c526bdb36b2f72767e02e8fedf1")
        );
        
        $payload = Array(
            'purpose' => 'Buy Product',
            'amount' => $total_price,
            'phone' => $userArr['mobile'],
            'buyer_name' => $userArr['name'],
            'redirect_url' => 'http://localhost/bullseye_ecom/payment_complete.php',
            'send_email' => false,
            'send_sms' => false,
            'email' => $userArr['email'],
            'allow_repeated_payments' => false
        );
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        curl_close($ch); 
        
        $response=json_decode($response);
        if(isset($response->payment_request->id)){
            unset($_SESSION['cart']);
            $_SESSION['TID']=$response->payment_request->id;
            mysqli_query($con,"update order_master set txnid='".$response->payment_request->id."' where id='".$order_id."'");
            ?>
            <script>
            window.location.href='<?php echo $response->payment_request->longurl?>';
            </script>
            <?php
        }else{
            if(isset($response->message)){
                $errMsg.="<div class='instamojo_error'>";
                foreach($response->message as $key=>$val){
                    $errMsg.=strtoupper($key).' : '.$val[0].'<br/>';				
                }
                $errMsg.="</div>";
            }else{
                echo "Something went wrong";
            }
        }
    }else{	
        //sentInvoice($con,$order_id);
        ?>
        <script>
            window.location.href='thank_you.php';
        </script>
        <?php
    }
}

?>	
    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/bg6.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">checkout</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="checkout-wrap ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                    <?php echo $errMsg?>
                        <div class="checkout__inner">
                            <div class="accordion-list">
                                <div class="accordion">                                    
                                    <?php 
                                        $accordion_class = 'accordion__title';
                                        if(!isset($_SESSION['USER_LOGIN'])) {
                                        $accordion_class = 'accordion__hide'; 
                                    ?>
                                    <div class="accordion__title">
                                        Checkout Method
                                    </div>
                                    <div class="accordion__body">
                                        <div class="accordion__body__form">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="checkout-method__login">
                                                        <form id="login-form" method="post">
                                                            <h5 class="checkout-method__title">Login</h5>
                                                            <div class="single-input">
                                                                <input type="text" name="login_email" id="login_email" placeholder="Your Email*" style="width:100%">
                                                                <span class="field_error" id="login_email_error"></span>
                                                            </div>                                                            
                                                            <div class="single-input">
                                                                <input type="password" name="login_password" id="login_password" placeholder="Your Password*" style="width:100%">
                                                                <span class="field_error" id="login_password_error"></span>
                                                            </div>                                                            
                                                            <p class="require">* Required fields</p>
                                                            <div class="dark-btn">
                                                                <button type="button" class="fv-btn" onclick="user_login()">Login</button>
                                                            </div>
                                                        </form>
                                                        <div class="form-output login_msg">
									                        <p class="form-messege field_error"></p>
								                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="checkout-method__login">
                                                        <form id="register-form" method="post">
                                                            <h5 class="checkout-method__title">Register</h5>
                                                            <div class="single-input">
                                                                <input type="text" name="name" id="name" placeholder="Your Name*" style="width:100%">
                                                                <span class="field_error" id="name_error"></span>
                                                            </div>                                                            
															<div class="single-input">
                                                                <input type="text" name="email" id="email" placeholder="Your Email*" style="width:100%">
                                                                <span class="field_error" id="email_error"></span>
                                                            </div>                                                            															
                                                            <div class="single-input">
                                                                <input type="text" name="mobile" id="mobile" placeholder="Your Mobile*" style="width:100%">
                                                                <span class="field_error" id="mobile_error"></span>
                                                            </div>                                                            
                                                            <div class="single-input">
                                                                <input type="password" name="password" id="password" placeholder="Your Password*" style="width:100%">
                                                                <span class="field_error" id="password_error"></span>
                                                            </div>                                                            
                                                            <div class="dark-btn">
                                                                <button type="button" class="fv-btn" onclick="user_register()">Register</button>
                                                            </div>
                                                        </form>
                                                        <div class="form-output register_msg">
									                        <p class="form-messege field_error"></p>
								                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div class="<?php echo $accordion_class ?>">
                                        Address Information
                                    </div>
                                    <form method="post">
                                        <div class="accordion__body">
                                            <div class="bilinfo">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="single-input">
                                                            <input type="text" name="house_no" placeholder="Flat, House no., Building" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="single-input">
                                                            <input type="text" name="address" placeholder="Area, Street, Village" required>
                                                        </div>
                                                    </div>                                                    
                                                    <div class="col-md-6">
                                                        <div class="single-input">
                                                            <input type="text" name="city" placeholder="City/State" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="single-input">
                                                            <input type="text" name="pincode" placeholder="Post code/ zip" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="<?php echo $accordion_class ?>">
                                            payment information
                                        </div>
                                        <div class="accordion__body">
                                            <div class="paymentinfo">
                                                <div class="single-method">
                                                    <input type="radio" name="payment_type" value="COD" required/> COD
                                                    &nbsp;&nbsp;<input type="radio" name="payment_type" value="instamojo" required/> INSTAMOJO
                                                </div>
                                            </div>
                                        </div>
                                        <input type="submit" name="submit" class="fv-btn"/>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="order-details">
                            <h5 class="order-details__title">Your Order</h5>
                            <div class="order-details__item">
                                <?php
                                    $sub_total = 0;
                                    $delivery = 50;
                                    $cart_total = 0;
									if(isset($_SESSION['cart'])){
									foreach($_SESSION['cart'] as $key=>$val){
									$productArr=get_product($con,'','','',$key);
									$pname=$productArr[0]['name'];
									$mrp=$productArr[0]['mrp'];
									$price=$productArr[0]['price'];
									$image=$productArr[0]['image'];
									$qty=$val['qty'];
                                    $sub_total = $sub_total+($price*$qty);
                                    $cart_total = $sub_total + $delivery;
								?>
                                <div class="single-item">
                                    <div class="single-item__thumb" style="width: 126px;">
                                        <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$image?>" />
                                    </div>
                                    <div class="single-item__content">
                                        <a href="#"><?php echo $pname ?></a>
                                        <br>
                                        Qty:&nbsp;<input type="number" id="<?php echo $key?>qty" value="<?php echo $qty?>" style="width:50px; margin-right:4px;"/>
										<a href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','update')">update</a>
                                        <span class="price">Total price: ₹<?php echo $price*$qty ?></span>
                                    </div>
                                    <div class="single-item__remove" style="margin-top: -38px;">
                                        <a href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','remove')"><i class="icon-trash icons"></i></a>
                                    </div>
                                </div>
                                <?php } } ?>
                            </div>
                            <div class="order-details__count">
                                <div class="order-details__count__single">
                                    <h5>sub total</h5>
                                    <span class="price">₹<?php echo $sub_total ?></span>
                                </div>
                                <div class="order-details__count__single">
                                    <h5>Delivery</h5>
                                    <span class="price">₹<?php echo $delivery ?></span>
                                </div>
                            </div>
                            <div class="ordre-details__total" id="coupon_box">
                                <h5>Coupon Value</h5>
                                <span class="price" id="coupon_price"></span>
                            </div>
                            <div class="ordre-details__total">
                                <h5>Order total</h5>
                                <span class="price" id="order_total_price">₹<?php echo $cart_total ?></span>
                            </div>
                            <div class="ordre-details__total bilinfo">
                                <input type="textbox" id="coupon_str" class="coupon_style mr5"/> <input type="button" name="submit" class="fv-btn coupon_style" value="Apply Coupon" onclick="set_coupon()"/>
                            </div>
                            <div id="coupon_result"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- cart-main-area end -->
        <script>
			function set_coupon(){
				var coupon_str=jQuery('#coupon_str').val();
				if(coupon_str!=''){
					jQuery('#coupon_result').html('');
					jQuery.ajax({
						url:'set_coupon.php',
						type:'post',
						data:'coupon_str='+coupon_str,
						success:function(result){
							var data=jQuery.parseJSON(result);
							if(data.is_error=='yes'){
								jQuery('#coupon_box').hide();
								jQuery('#coupon_result').html(data.dd);
								jQuery('#order_total_price').html(data.result);
							}
							if(data.is_error=='no'){
								jQuery('#coupon_box').show();
								jQuery('#coupon_price').html(data.dd);
								jQuery('#order_total_price').html(data.result);
							}
						}
					});
				}
			}
		</script>		
<?php 
if(isset($_SESSION['COUPON_ID'])){
	unset($_SESSION['COUPON_ID']);
	unset($_SESSION['COUPON_CODE']);
	unset($_SESSION['COUPON_VALUE']);
}
require('footer.php')?>        