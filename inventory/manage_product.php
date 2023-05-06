<?php
require('top.inc.php');
$categories_id='';
$subcategories_id='';
$name='';
$mrp='';
$price='';
$qty='';
$image='';
$short_desc	='';
$description	='';
$meta_title	='';
$meta_desc	='';
$meta_keyword='';
$best_seller='';

$msg='';
$image_required='required';
if(isset($_GET['id']) && $_GET['id']!=''){
	$image_required='';
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from product where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$categories_id=$row['categories_id'];
		@$subcategories_id=$row['subcategories_id'];
		$name=$row['name'];
		$mrp=$row['mrp'];
		$price=$row['price'];
		$qty=$row['qty'];
		$short_desc=$row['short_desc'];
		$description=$row['description'];
		$meta_title=$row['meta_title'];
		$meta_desc=$row['meta_desc'];
		$meta_keyword=$row['meta_keyword'];
		$best_seller=$row['best_seller'];
	}else{
		header('location:product.php');
		die();
	}
}

if(isset($_POST['submit'])){
	@$id=get_safe_value($con,$_GET['id']);
	$categories_id=get_safe_value($con,$_POST['categories_id']);
	$subcategories_id=get_safe_value($con,$_POST['subcategories_id']);
	$name=get_safe_value($con,$_POST['name']);
	$mrp=get_safe_value($con,$_POST['mrp']);
	$price=get_safe_value($con,$_POST['price']);
	$qty=get_safe_value($con,$_POST['qty']);
	$short_desc=get_safe_value($con,$_POST['short_desc']);
	$description=get_safe_value($con,$_POST['description']);
	$meta_title=get_safe_value($con,$_POST['meta_title']);
	$meta_desc=get_safe_value($con,$_POST['meta_desc']);
	@$meta_keyword=get_safe_value($con,$_POST['meta_keyword']);
	$best_seller=get_safe_value($con,$_POST['best_seller']);
	
	$res=mysqli_query($con,"select * from product where name='$name'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
			
			}else{
				$msg="Product already exist";
			}
		}else{
			$msg="Product already exist";
		}
	}
	
	
	if(@$_GET['id']==0){
		if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
			$msg="Please select only png,jpg and jpeg image formate";
		}
	}else{
		if($_FILES['image']['type']!=''){
				if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
				$msg="Please select only png,jpg and jpeg image formate";
			}
		}
	}
	
	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			if($_FILES['image']['name']!=''){
				$image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
				move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
				$update_sql="update product set categories_id='$categories_id',subcategories_id='$subcategories_id',name='$name',mrp='$mrp',price='$price',qty='$qty',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword',image='$image',best_seller='$best_seller' where id='$id'";
			}else{
				$update_sql="update product set categories_id='$categories_id',subcategories_id='$subcategories_id'name='$name',mrp='$mrp',price='$price',qty='$qty',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword',best_seller='$best_seller' where id='$id'";
			}
			mysqli_query($con,$update_sql);
		}else{
			$image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
			mysqli_query($con,"insert into product(categories_id,subcategories_id,name,mrp,price,qty,short_desc,description,meta_title,meta_desc,meta_keyword,status,image,best_seller) values('$categories_id','$subcategories_id','$name','$mrp','$price','$qty','$short_desc','$description','$meta_title','$meta_desc','$meta_keyword',1,'$image','$best_seller')");
		}
		//header('location:product.php');
		?>
		<script>
			window.location.href='product.php';
		</script>
		<?php
		die();
	}
}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Product</strong><small> Form</small></div>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
								<div class="form-group">
									<div class="row">
									  <div class="col-lg-6">
										<label for="categories" class=" form-control-label">Categories</label>
										<select class="form-control" name="categories_id">
											<option>Select Category</option>
											<?php
												$res=mysqli_query($con,"select id,categories from categories order by categories asc");
												while($row=mysqli_fetch_assoc($res)){
													if($row['id']==$categories_id){
														echo "<option selected value=".$row['id'].">".$row['categories']."</option>";
													}else{
														echo "<option value=".$row['id'].">".$row['categories']."</option>";
													}
													
												}
											?>
										</select>
									  </div>
									   <div class="col-lg-6">
										<label for="sub_categories" class="form-control-label">Sub Categories</label>										
										<select class="form-control" name="subcategories_id">
											<option>Select Category</option>
											<?php
												$res=mysqli_query($con,"select id,sub_categories from sub_categories order by sub_categories asc");
												while($row=mysqli_fetch_assoc($res)){
													if($row['id']==$subcategories_id){
														echo "<option selected value=".$row['id'].">".$row['sub_categories']."</option>";
													}else{
														echo "<option value=".$row['id'].">".$row['sub_categories']."</option>";
													}
													
												}
											?>
										</select>
									  </div>
									</div>
								</div>								

								<div class="form-group">
									<div class='row'>
										<div class="col-lg-9">
											<label for="categories" class=" form-control-label">Product Name</label>
											<input type="text" name="name" placeholder="Enter product name" class="form-control" required value="<?php echo $name?>">
										</div>
										<div class="col-lg-3">
											<label for="categories" class=" form-control-label">Best Seller</label>
											<select class="form-control" name="best_seller" required>
												<option value="">Select</option>
												<?php
													if($best_seller == 1){
														echo '<option value="1" selected>Yes</option>
														<option value="0">No</option>';
													}elseif($best_seller == 1){
														echo '<option value="1">Yes</option>
														<option value="0" selected>No</option>';
													}else{
														echo '<option value="1">Yes</option>
														<option value="0">No</option>';
													}
												?>
											</select>
										  </div>
									</div>
								</div>

								<div class="form-group">
									<div class='row'>
										<div class="col-lg-4">
											<label for="categories" class=" form-control-label">MRP</label>
											<input type="text" name="mrp" placeholder="Enter product mrp" class="form-control" required value="<?php echo $mrp?>">
										</div>
										<div class="col-lg-4">
											<label for="categories" class=" form-control-label">Price</label>
											<input type="text" name="price" placeholder="Enter product price" class="form-control" required value="<?php echo $price?>">
										</div>
										<div class="col-lg-4">
											<label for="categories" class=" form-control-label">Qty</label>
											<input type="text" name="qty" placeholder="Enter qty" class="form-control" required value="<?php echo $qty?>">
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Image</label>
									<input type="file" name="image" class="form-control" <?php echo  $image_required?>>
								</div>

								<div class="form-group">
									<div class='row'>
										<div class="col-lg-6">
											<label for="categories" class="form-control-label">Short Description</label>
											<textarea name="short_desc" placeholder="Enter product short description" class="form-control" required><?php echo $short_desc?></textarea>
										</div>
										<div class="col-lg-6">
											<label for="categories" class="form-control-label">Description</label>
											<textarea name="description" placeholder="Enter product description" class="form-control" required><?php echo $description?></textarea>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-lg-6">
											<label for="categories" class=" form-control-label">Meta Title</label>												
											<input type="text" name="meta_title" placeholder="Enter product meta title" class="form-control" required value="<?php echo $meta_title?>">
										</div>

										<div class="col-lg-6">
											<label for="categories" class=" form-control-label">Meta Description</label>												
											<input type="text" name="meta_desc" placeholder="Enter product meta description" class="form-control" required value="<?php echo $meta_desc?>">
										</div>
									</div>
								</div>		

								<div class="form-group">
									<div class='row'>
										<div class="col-lg-6">
											<label for="categories" class=" form-control-label">Meta Description</label>
											<textarea name="meta_desc" placeholder="Enter product meta description" class="form-control"><?php echo $meta_desc?></textarea>
										</div>
										<div class="col-lg-6">
											<label for="categories" class=" form-control-label">Technical Information</label>
											<textarea name="meta_desc" placeholder="Enter product meta description" class="form-control"><?php echo $meta_desc?></textarea>
										</div>
									</div>
								</div>		
								
							   <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button>
							   <div class="field_error"><?php echo $msg?></div>
							</div>
						</form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         
<?php
require('footer.inc.php');
?>