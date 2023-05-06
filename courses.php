<?php require('top.php'); ?>
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
                                  <span class="breadcrumb-item active">All Courses</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <section class="htc__product__grid bg__white ptb--60">
            <div class="container">
                <div class="row"> 
                <div class="col-lg-3 smt-40 xmt-40 order-lg-1 order-2">
                    <section class="htc__blog__area bg__white ptb--40">
                        <div class="container">
                            <div class="ht__blog__wrap blog--page row">
                                <!-- Start Single Blog -->
                                <?php
                                    $cou_res=mysqli_query($con,"Select * from course where course.status=1");
                                    $cou_arr=array();
                                    while($row3=mysqli_fetch_assoc($cou_res)){
                                        $cou_arr[]=$row3;
                                ?>
                                <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                    <div class="blog">
                                        <div class="blog__thumb">
                                            <a>                                                
                                                <img src="<?php echo COURSE_IMAGE_SITE_PATH.$row3['image']?>" style="height:160px;">
                                            </a>
                                        </div>
                                        <div class="blog__details">
                                        <h2><a href="course_detail.php"><?php echo $row3['name']?></a></h2>
                                            <div class="bl__date">
                                                <span><strong>Last Updated:</strong> <?php echo $row3['added_on']?></span>
                                            </div>

                                            <?php
                                                $ctid=$row3['ccourse_id'];
                                                $cot_res=mysqli_query($con,"select * from course_category where id='$ctid'");
                                                $cot_arr=array();
                                                while($row5=mysqli_fetch_assoc($cot_res)){
                                                    $cot_arr[]=$row5;
                                            ?>
                                            <span><strong>Category:</strong> <?php echo $row5['course_category']?></span><br/>
                                            <?php } ?>

                                            <?php
                                                $itid=$row3['instru_id'];
                                                $it_res=mysqli_query($con,"select * from instructor where id='$itid'");
                                                $it_arr=array();
                                                while($row6=mysqli_fetch_assoc($it_res)){
                                                    $it_arr[]=$row6;
                                            ?>
                                            <span><strong>Instructor:</strong> <?php echo $row6['iname']?></span><br/>
                                            <?php } ?>
                                            
                                            <div class="blog__btn">
                                                <a class="fr__btn" href="course_detail.php?id=<?php echo $row3['id']?>">Learn</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                <!-- End Single Blog -->
                            </div>
                        </div>
                    </section>    
                </div>
            </div>
        </section>

        <section class="instructor">
            <h2 class="section-title">Our Expert Instructor</h2>
            
            <div class="instructor-grid">
            <?php
                $inst_res=mysqli_query($con,"Select * from instructor where instructor.status=1");
                $inst_arr=array();
                while($row=mysqli_fetch_assoc($inst_res)){
                    $inst_arr[]=$row;	
            ?>
                <div class="instructor-card">
                    <div class="instructor-img-box">
                    <img src="images/others/Male-placeholder.jpeg">

                    <div class="social-link">
                        <a href="#" class="facebook">
                            <i class="icon-social-facebook icons" style="background-color:#088178; color:white; border-radius:100px; font-size:20px;"></i>
                        </a>

                        <a href="#" class="instagram">
                            <i class="icon-social-instagram icons" style="background-color:#088178; color:white; border-radius:100px; font-size:20px;"></i>
                        </a>

                        <a href="#" class="twitter">
                            <i class="icon-social-twitter icons" style="background-color:#088178; color:white; border-radius:100px; font-size:20px;"></i>
                        </a>
                    </div>
                </div>
                <h4 class="instructor-name"><?php echo $row['iname']?></h4>
                <?php 
                    $isid = $row['ctype'];
                    $tag_res=mysqli_query($con,"select * from course_category where id='$isid'");    
                    while($row2=mysqli_fetch_assoc($tag_res)){
                    ?>
                        <p class="instructor-title"><?php echo $row2['course_category']?> Instructor</p>
                    <?php
                    } 
				?>
                              
            </div>
            <?php } ?>
                </div>
        </section>

<?php require('footer.php'); ?>