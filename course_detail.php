<?php 
    require('top.php');
    $course_id=$_GET['id'];
?>
<div class="body__overlay"></div>
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
                                  <a class="breadcrumb-item" href="courses.php">All Courses</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <?php
                                    //$course_id=$_GET['id'];
                                    //echo $course_id;
                                    if($course_id>0){
                                        $cou_res="Select * from course where course.id='$course_id'";
                                        $res = mysqli_query($con,$cou_res);
                                        //echo $res;
                                        $cou_arr=array();
                                        while($row6=mysqli_fetch_assoc($res)){
                                            $cou_arr[]=$row6;
                                            //echo $row6['name'];
                                  ?>
                                  <span class="breadcrumb-item active"><?php echo $row6['name']; ?></span>
                                  <?php } } ?>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->

    <section id="course-inner">
        <?php
            if($course_id>0){
                $cou_res="Select * from course where course.id='$course_id'";
                $res = mysqli_query($con,$cou_res);
                //echo $res;
                $cou_arr=array();
                while($row6=mysqli_fetch_assoc($res)){
                    $cou_arr[]=$row6;
        ?>
        <div class="overview">            
            <a href="<?php echo $row6['video_link']?>"><img class="course-img" src="<?php echo COURSE_IMAGE_SITE_PATH.$row6['image']?>" alt=""></a>
            <div class="course-head">
                <div class="c-name">
                    <h2><strong><?php echo $row6['name']?></strong></h2></br></br>
                    <p><?php echo $row6['short_desc']?></p>
                </div>
                <span>Free</span>
            </div>
            <h3><strong>Instructor</strong></h3>
            <div class="tutor">                
                <div class="tutor-det">
                <img src="images/others/Male-placeholder.jpeg" style="width:50px; height:50px;">
                    <div class="tutor-name">
                        <?php
                            $int_id = $row6['instru_id'];
                            $inst_res=mysqli_query($con,"Select * from instructor where instructor.id='$int_id'");
                            $inst_arr=array();
                            while($row=mysqli_fetch_assoc($inst_res)){
                                $inst_arr[]=$row;
                        ?>
                        <h5><strong><?php echo $row['iname']?></strong></h5>
                        <?php  
                            $int_type = $row['ctype'];                    
                            $tag_res=mysqli_query($con,"select * from course_category where id='$int_type'");    
                            while($row2=mysqli_fetch_assoc($tag_res)){
                        ?>
                        <p><?php echo $row2['course_category']?> Instructor</p>
                         
                    </div>                 
                </div>
                <div class="enroll-btn">
                    <a class="green" href="#">Contact Us</a>
                </div>
            </div>
            <hr>
            <h3><strong>Course Overview</strong></h3>
            <p><?php echo $row6['description']?></p>

            <h3><strong>Required Full Kit</strong></h3>
            <section id="free-downloads" class="section-p1">
                
                <b><p style="font-weight: bold; font-size: 20px;">Just Purchase your Complete your <?php echo $row2['course_category']?> Kit</p></b>
                       
                <div class="fe-box">
                    <a class="fr__btn" href="subcategories.php?id=<?php echo $row6['id']?>" style="margin-top: 0px;">Complete Your Kit</a>
                </div>
                <?php } } ?>
            </section>
        </div>

        <div class="enroll">
            <h3><strong>This course includes:</strong></h3>
            <p><i class="far fa-video"></i><?php echo $row6['hours']?> hours video</p>
            <p><i class="far fa-cloud-download"></i>Downloadable resources</p>
            <p><i class="far fa-infinity"></i>Full lifetime access</p>
            <p><i class="far fa-mobile-alt"></i>Access on mobile and TV</p>
            <p><i class="far fa-trophy-alt"></i>Certificate of completion</p>
        </div>
        <?php } } ?>
    </section>    

<?php require('footer.php'); ?>