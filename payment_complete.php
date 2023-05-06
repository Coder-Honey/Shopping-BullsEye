<?php
require('connection.inc.php');
require('functions.inc.php');
echo '<b>Transaction In Process, Please do not reload</b>';
if(isset($_GET['payment_status']) && isset($_GET['payment_status']) && isset($_GET['payment_request_id'])){
	$payment_id=$_GET['payment_id'];
	$payment_status=$_GET['payment_status'];
	$payment_request_id=$_GET['payment_request_id'];
	
	$res=mysqli_query($con,"select order_master.*,users.name from order_master,users where order_master.txnid='$payment_request_id' and order_master.user_id=users.id");
		if(mysqli_num_rows($res)>0){
			$row=mysqli_fetch_assoc($res);
			$order_id=$row['id'];
			$user_id=$row['user_id'];
			
			$_SESSION['USER_LOGIN']='yes';
			$_SESSION['USER_ID']=$user_id;
			$_SESSION['USER_NAME']=$row['name'];
			
			if($payment_status=='Credit'){
				$res=mysqli_query($con,"select * from order_master where txnid='$payment_request_id'");
				mysqli_query($con,"update order_master set payment_status='complete', mihpayid='$payment_id' where txnid='$payment_request_id'");
				//sentInvoice($con,$order_id);
				?>
				<script>
				window.location.href='thank_you.php';
				</script>
				<?php
			}else{
				mysqli_query($con,"update order_master set payment_status='fail', mihpayid='$payment_id' where txnid='$payment_request_id'");
				?>
				<script>
				window.location.href='payment_fail.php';
				</script>
				<?php
			}
		}
	}else{
		?>
		<script>
		window.location.href='index.php';
		</script>
		<?php
	}	

?>