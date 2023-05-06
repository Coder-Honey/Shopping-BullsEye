<?php
require('top.inc.php');
$ccourse_id='';
$name='';
$instru_id='';
$image='';
$hours='';
$description='';
$short_desc='';
$video_link='';
$status='';
$added_on=date('Y-m-d h:i:s');

$msg='';
$image_required='required';
if(isset($_GET['id']) && $_GET['id']!=''){
	$image_required='';
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from course where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$ccourse_id=$row['ccourse_id'];
		$name=$row['name'];
		$instru_id=$row['instru_id'];
		$hours=$row['hours'];
		$description=$row['description'];
		$short_desc=$row['short_desc'];
		$video_link=$row['video_link'];
	}else{
		//header('location:course.php');
		?>
		<script>
			window.location.href='course.php';
		</script>
		<?php
		die();
	}
}

if(isset($_POST['submit'])){
	$id=get_safe_value($con,$_GET['id']);
	$ccourse_id= get_safe_value($con,$_POST['ccourse_id']);
	$name=get_safe_value($con,$_POST['name']);
	@$instru_id=get_safe_value($con,$_POST['instru_id']);
	$hours=get_safe_value($con,$_POST['hours']);
	$description=get_safe_value($con,$_POST['description']);
	$short_desc=get_safe_value($con,$_POST['short_desc']);
	$video_link=get_safe_value($con,$_POST['video_link']);
	
	$res=mysqli_query($con,"select * from course where name='$name'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
			
			}else{
				$msg="Course already exist";
			}
		}else{
			$msg="Course already exist";
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
				move_uploaded_file($_FILES['image']['tmp_name'],COURSE_IMAGE_SERVER_PATH.$image);
				$update_sql="update course set ccourse_id='$ccourse_id',name='$name',instru_id='$instru_id',image='$image',hours='$hours',description='$description',short_desc='$short_desc',video_link='$video_link' where id='$id'";
			}else{
				$update_sql="update course set ccourse_id='$ccourse_id',name='$name',instru_id='$instru_id',image='$image',hours='$hours',description='$description',short_desc='$short_desc',video_link='$video_link' where id='$id'";
			}
			mysqli_query($con,$update_sql);
		}else{
			$image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'],COURSE_IMAGE_SERVER_PATH.$image);
			mysqli_query($con,"insert into course(ccourse_id,name,instru_id,image,hours,description,short_desc,video_link,status,added_on) values('$ccourse_id','$name','$instru_id','$image','$hours','$description','$short_desc','$video_link',1,'$added_on')");
		}
		header('location:course.php');		
		die();
	}
}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Course</strong><small> Form</small></div>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="categories" class=" form-control-label">Course Categories</label>
									<select class="form-control" name="ccourse_id">
										<option>Select Category</option>
										<?php
										$res=mysqli_query($con,"select id,course_category from course_category order by course_category asc");
										while($row=mysqli_fetch_assoc($res)){
											if($row['id']==$ccourse_id){
												echo "<option selected value=".$row['id'].">".$row['course_category']."</option>";
											}else{
												echo "<option value=".$row['id'].">".$row['course_category']."</option>";
											}
											
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="categories" class=" form-control-label">Course Name</label>
									<input type="text" name="name" placeholder="Enter course name" class="form-control" required value="<?php echo $name?>">
								</div>	
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Instructor</label>
									<select class="form-control" name="ccourse_id">
										<option>Select Instructor</option>
										<?php
										$res1=mysqli_query($con,"select * from instructor order by name asc");
										while($row1=mysqli_fetch_assoc($res1)){
											if($row1['id']==$ccourse_id){
												echo "<option selected value=".$row1['id'].">".$row1['name']."</option>";
											}else{
												echo "<option value=".$row1['id'].">".$row1['name']."</option>";
											}
											
										}
										?>
									</select>
								</div>						
														
								<div class="form-group">
									<label for="categories" class=" form-control-label">Image</label>
									<input type="file" name="image" class="form-control" <?php echo  $image_required?>>
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Total Hours</label>
									<input type="text" name="hours" placeholder="Enter total hours" class="form-control" required value="<?php echo $hours?>">
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Description</label>
									<textarea name="description" placeholder="Enter course description" class="form-control" required><?php echo $description?></textarea>
								</div>

								<div class="form-group">
									<label for="categories" class=" form-control-label">Short Description</label>
									<textarea name="short_desc" placeholder="Enter short description" class="form-control" required><?php echo $short_desc?></textarea>
								</div>	

								<div class="form-group">
									<label for="categories" class=" form-control-label">Video Link</label>
									<input type="text" name="video_link" placeholder="Enter video link" class="form-control" required value="<?php echo $video_link?>">
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