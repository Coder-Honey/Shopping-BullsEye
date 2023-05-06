<?php
require('top.inc.php');

if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($con,$_GET['type']);
	if($type=='status'){
		$operation=get_safe_value($con,$_GET['operation']);
		$id=get_safe_value($con,$_GET['id']);
		if($operation=='active'){
			$status='1';
		}else{
			$status='0';
		}
		$update_status_sql="update course set status='$status' where id='$id'";
		mysqli_query($con,$update_status_sql);
	}
	
	if($type=='delete'){
		$id=get_safe_value($con,$_GET['id']);
		$delete_sql="delete from course where id='$id'";
		mysqli_query($con,$delete_sql);
	}
}

//$sql="select course,instructor.*,course_category.course_category from course,course_category,instructor where course.ccourse_id=course_category.id,course.instru_id=instructor.id order by course.id desc";
$sql = "Select * from course,course_category where course.ccourse_id=course_category.id order by course.id asc";
$res=mysqli_query($con,$sql);
?> 
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Courses </h4>
				   <h4 class="box-link"><a href="manage_course.php">Add Courses</a> </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th>ID</th>
							   <th>Category</th>
							   <th>Name</th>
							   <th>Instructor</th>
							   <th>Image</th>
							   <th>Hours</th>
							   <th>Last Update</th>
							   <th></th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;
							while($row=mysqli_fetch_assoc($res)){?>
							<tr>
							   <td class="serial"><?php echo $i?></td>
							   <td><?php echo $row['id']?></td>
							   <td><?php echo $row['course_category']?></td>
							   <td><?php echo $row['name']?></td>
							   <td>
									<?php 
										$isid = $row['instru_id'];
										$tag_res=mysqli_query($con,"select * from instructor where id=4");    
										while($row2=mysqli_fetch_assoc($tag_res)){
									    	echo $row2['iname'];
										} 
									?>
								</td>
							   <td><img src="<?php echo COURSE_IMAGE_SITE_PATH.$row['image']?>"/></td>
							   <td><?php echo $row['hours']?></td>
							   <td><?php echo $row['added_on']?></td>
							   <td>
								<?php
								if($row['status']==1){
									echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$row['id']."'>Active</a></span>&nbsp;";
								}else{
									echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['id']."'>Deactive</a></span>&nbsp;";
								}
								echo "<span class='badge badge-edit'><a href='manage_course.php?id=".$row['id']."'>Edit</a></span>&nbsp;";
								
								echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['id']."'>Delete</a></span>";
								
								?>
							   </td>
							</tr>
							<?php } ?>
						 </tbody>
					  </table>
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