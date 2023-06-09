<?php
    require('connection.inc.php');
    require('functions.inc.php');
    require('add_to_cart.inc.php');
    $cat_res=mysqli_query($con,"select * from categories where status=1 order by categories asc");
    $cat_arr=array();
    while($row=mysqli_fetch_assoc($cat_res)){
        $cat_arr[]=$row;	
    }

    $subcat_res=mysqli_query($con,"select * from sub_categories where status=1 order by sub_categories asc");
    $subcat_arr=array();
    while($row=mysqli_fetch_assoc($subcat_res)){
        $subcat_arr[]=$row;	
    }

    $ccat_res=mysqli_query($con,"select * from course_category where status=1 order by course_category asc");
    $ccat_arr=array();
    while($row=mysqli_fetch_assoc($ccat_res)){
        $ccat_arr[]=$row;	
    }

    $obj=new add_to_cart();
    $totalProduct=$obj->totalProduct();

    $tag_res=mysqli_query($con,"SELECT * FROM Product where product.best_seller=1;");    
    $tag_arr=array();
    while($row=mysqli_fetch_assoc($tag_res)){
        $tag_arr[]=$row;	
    }

    $sub_res=mysqli_query($con,"select * from sub_categories where status=1 order by sub_categories asc");    
    $sub_arr=array();
    while($row=mysqli_fetch_assoc($sub_res)){
        $sub_arr[]=$row;	
    }

    if(isset($_SESSION['USER_LOGIN'])){
        $uid=$_SESSION['USER_ID'];
        
        if(isset($_GET['wishlist_id'])){
            $wid=get_safe_value($con,$_GET['wishlist_id']);
            mysqli_query($con,"delete from wishlist where id='$wid' and user_id='$uid'");
        }
    
        $wishlist_count=mysqli_num_rows(mysqli_query($con,"select product.name,product.image,wishlist.id from product,wishlist where wishlist.product_id=product.id and wishlist.user_id='$uid'"));
        
    }

    $script_name=$_SERVER['SCRIPT_NAME'];
    $script_name_arr=explode('/',$script_name);
    $mypage=$script_name_arr[count($script_name_arr)-1];

    $meta_title="Bull's Eye";
    $meta_desc="Bull's Eye";
    $meta_keyword="Bull's Eye";
    $meta_url=SITE_PATH;
    $meta_image="";
    if($mypage=='product.php'){
        $product_id=get_safe_value($con,$_GET['id']);
        $product_meta=mysqli_fetch_assoc(mysqli_query($con,"select * from product where id='$product_id'"));
        $meta_title=$product_meta['name'];
        $meta_desc=$product_meta['meta_desc'];
        $meta_keyword=$product_meta['meta_keyword'];
        $meta_url=SITE_PATH."product.php?id=".$product_id;
        $meta_image=PRODUCT_IMAGE_SITE_PATH.$product_meta['image'];
    }if($mypage=='contact.php'){
        $meta_title='Contact Us';
    }
    if($mypage=='about.php'){
        $meta_title='About';
    }
    if($mypage=='categories.php'){
        $meta_title='Shop - Product';
    }
    if($mypage=='courses.php'){
        $meta_title='Learn - Course';
    }
    if($mypage=='login.php'){
        $meta_title='Login - Register';
    }
    if($mypage=='cart.php'){
        $meta_title='My Cart';
    }
    if($mypage=='wishlist.php'){
        $meta_title='My Wishlist';
    }
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $meta_title?></title>
    <meta name="description" content="<?php echo $meta_desc?>">
	<meta name="keywords" content="<?php echo $meta_keyword?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<meta property="og:title" content="<?php echo $meta_title?>"/>
	<meta property="og:image" content="<?php echo $meta_image?>"/>
	<meta property="og:url" content="<?php echo $meta_url?>"/>
	<meta property="og:site_name" content="<?php echo SITE_PATH?>"/>
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/core.css">
    <link rel="stylesheet" href="css/shortcode/shortcodes.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="icon" type="image/x-icon" href="images/favicon.png" height="800px" width="800px">

    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->  

    <!-- Body main wrapper start -->
    <div class="wrapper">
        <!-- Start Header Style -->
        <header id="htc__header" class="htc__header__area header--one">
            <!-- Start Mainmenu Area -->
            <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
                <div class="container">
                    <div class="row">
                        <div class="menumenu__container clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5"> 
                                <div class="logo">
                                     <a href="index.html"><img src="images/logo/logo.png" alt="logo images"></a>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-6 col-sm-5 col-xs-3">
                                <nav class="main__menu__nav hidden-xs hidden-sm">
                                    <ul class="main__menu">
                                        <li class="drop"><a href="index.php">Home</a></li>
                                        <li class="drop"><a>shop</a>
                                            <ul class="dropdown mega_dropdown">
                                                <!-- Start Single Mega MEnu -->
                                                <li><a class="mega__title">Top 5 Best Seller</a>
                                                    <ul class="mega__item">
                                                    <?php
                                                    foreach($tag_arr as $tlist) {
                                                        ?>                                                
                                                        <li><a href="product.php?id=<?php echo $tlist['id']?>"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$tlist['image']?>"/><?php echo $tlist['name']?></a></li>                                    
                                                <?php
                                                    }
                                                ?>
                                                    </ul>
                                                </li>
                                                <!-- End Single Mega MEnu -->

                                                <!-- Start Single Mega MEnu -->
                                                <li><a class="mega__title">Full Kit</a>
                                                    <ul class="mega__item">
                                                    <?php
                                                    foreach($sub_arr as $slist) {
                                                        ?>                                                
                                                        <li><a href="subcategories.php?id=<?php echo $slist['id']?>"><?php echo $slist['sub_categories']?></a></li>                                    
                                                <?php
                                                    }
                                                ?>
                                                    </ul>
                                                </li>
                                                <!-- End Single Mega MEnu -->


                                                <!-- Start Single Mega MEnu -->
                                                <li><a class="mega__title">Category</a>
                                                    <ul class="mega__item">
                                                <?php
                                                    foreach($cat_arr as $list) {
                                                        ?>                                                
                                                        <li><a href="categories.php?id=<?php echo $list['id']?>"><?php echo $list['categories']?></a></li>                                    
                                                <?php
                                                    }
                                                ?>
                                                  </ul>
                                                </li>    
                                                <!-- End Single Mega MEnu -->                                            
                                            </ul>
                                        </li>
                                        <li><a href="courses.php">course</a></li>
                                        <li><a href="about.php">about</a></li>
                                        <li><a href="contact.php">contact</a></li>
                                    </ul>
                                </nav>

                                <div class="mobile-menu clearfix visible-xs visible-sm">
                                    <nav id="mobile_dropdown">
                                        <ul>
                                            <li><a href="index.php">Home</a></li>
                                            <li><a href="#">shop</a>
                                                <ul class="mega__item">
                                                <?php
                                                    foreach($cat_arr as $list) {
                                                        ?>                                                
                                                        <li><a href="categories.php?id=<?php echo $list['id']?>"><?php echo $list['categories']?></a></li>                                    
                                                <?php
                                                    }
                                                ?>
                                                </ul>
                                            </li>
                                            <li><a href="contact.html">learn</a></li>
                                            <li><a href="contact.html">contact</a></li>
                                        </ul>
                                    </nav>
                                </div>  
                            </div>
                            <div class="col-md-3 col-lg-4 col-sm-4 col-xs-4">
                                <div class="header__right">   
                                    <div class="header__account">
                                        <?php if(isset($_SESSION['USER_LOGIN'])){
                                        ?>
                                            <ul class="navbar-nav mr-auto">
												  <li class="nav-item dropdown">
													<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													  Hi <?php echo $_SESSION['USER_NAME']?>
													</a>
													<div class="dropdown-menu" aria-labelledby="navbarDropdown">
													  <a class="dropdown-item" href="myorder.php">Order</a>
													  <a class="dropdown-item" href="profile.php">Profile</a>                                                      
													  <a class="dropdown-item" href="logout.php">Logout</a>
													</div>
												  </li>
												  
												</ul>
                                        <?php
                                        }else {
                                            echo '<a href="login.php"><i class="icon-user icons account_icon"></i></a>';
                                        }
                                        ?>                                        
                                    </div>

                                    <div class="header__search search search__open">
                                        <a href="#"><i class="icon-magnifier icons"></i></a>
                                    </div>
                                    
                                    <div class="htc__shopping__cart">
                                        <?php
                                            if(isset($_SESSION['USER_ID'])){
                                        ?>
                                        <a href="wishlist.php" style="margin-right: 10px;"><i class="icon-heart icons"></i></a>
                                        <a href="wishlist.php"><span class="htc__wishlist"><?php echo $wishlist_count?></span></a>

                                        <a href="compare.php" style="margin-right: 10px;"><i class="icon-shuffle icons"></i></a>
                                        <a href="compare.php"><span class="htc__compare">0</span></a>
                                        <?php } ?>

                                        <a href="cart.php" style="margin-right: 10px;"><i class="icon-handbag icons"></i></a>
                                        <a href="cart.php"><span class="htc__qua"><?php echo $totalProduct?></span></a>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-menu-area"></div>
                </div>
            </div>
            <!-- End Mainmenu Area -->
        </header>
        <!-- End Header Area -->

        <div class="body__overlay"></div>
        <!-- Start Offset Wrapper -->
        <div class="offset__wrapper">
            <!-- Start Search Popap -->
            <div class="search__area">
                <div class="container" >
                    <div class="row" >
                        <div class="col-md-12" >
                            <div class="search__inner">
                                <form action="search.php" method="get">
                                    <input placeholder="Search here... " type="text" name="str">
                                    <button type="submit"></button>
                                </form>
                                <div class="search__close__btn">
                                    <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Search Popap -->
        </div>