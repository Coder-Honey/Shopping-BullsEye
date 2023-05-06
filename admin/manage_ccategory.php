<?php
require('top.inc.php');
$course_category='';
$msg='';
if(isset($_GET['id']) && $_GET['id']!=''){
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from course_category where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$course_category=$row['course_category'];
	}else{
		header('location:course_categories.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$course_category=get_safe_value($con,$_POST['course_category']);
	$res=mysqli_query($con,"select * from course_category where course_category='$course_category'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
			
			}else{
				$msg="Categories already exist";
			}
		}else{
			$msg="Categories already exist";
		}
	}
	
	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			mysqli_query($con,"update course_category set course_category='$course_category' where id='$id'");
		}else{
			mysqli_query($con,"insert into course_category(course_category,status) values('$course_category','1')");
		}
		header('location:course_categories.php');
		die();
	}
}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Categories</strong><small> Form</small></div>
                        <form method="post">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="course_category" class=" form-control-label">Categories</label>
									<input type="text" name="course_category" placeholder="Enter categories name" class="form-control" required value="<?php echo $course_category?>">
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