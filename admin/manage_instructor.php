<?php
require('top.inc.php');
$name='';
$type='';
$msg='';
if(isset($_GET['id']) && $_GET['id']!=''){
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from instructor where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$name=$row['iname'];
		$type=$row['ctype'];
	}else{
		header('location:instructor.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$name=get_safe_value($con,$_POST['name']);
	$type=get_safe_value($con,$_POST['type']);
	$res=mysqli_query($con,"select * from instructor where iname='$name'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
			
			}else{
				$msg="Instructor already exist";
			}
		}else{
			$msg="Instructor already exist";
		}
	}
	
	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			mysqli_query($con,"update instructor set iname='$name',ctype='$type' where id='$id'");
		}else{
			mysqli_query($con,"insert into instructor(iname,ctype,status) values('$name','$type','1')");
		}
		header('location:instructor.php');
		?>
		<script>
			window.location.href='instructor.php';
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
                        <div class="card-header"><strong>Instructor</strong><small> Form</small></div>
                        <form method="post">
							<div class="card-body card-block">
							   	<div class="form-group">
									<label for="instructor" class=" form-control-label">Instructor</label>
									<input type="text" name="name" placeholder="Enter instructor name" class="form-control" required value="<?php echo $name?>">
								</div>

								<div class="form-group">
									<label for="categories" class=" form-control-label">Instructor Type</label>
									<select class="form-control" name="type">
										<option>Select Instructor Type</option>
										<?php
										$res=mysqli_query($con,"select id,course_category from course_category order by course_category asc");
										while($row=mysqli_fetch_assoc($res)){
											if($row['id']==$type){
												echo "<option selected value=".$row['id'].">".$row['course_category']."</option>";
											}else{
												echo "<option value=".$row['id'].">".$row['course_category']."</option>";
											}
											
										}
										?>
									</select>
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