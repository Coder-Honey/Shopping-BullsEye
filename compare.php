<?php 
require('top.php');
if(!isset($_SESSION['USER_LOGIN'])){
	?>
	<script>
	window.location.href='index.php';
	</script>
	<?php
}
$uid=$_SESSION['USER_ID'];

$res=mysqli_query($con,"select product.name,product.image,product.price,product.mrp,product.id as pid,wishlist.id from product,wishlist where wishlist.product_id=product.id and wishlist.user_id='$uid'");
?>

 <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/bg6.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">Compare</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="cart-main-area ptb--80 bg__white">
            <div class="container">
                <div class="columns2">
                    <ul class="price">
                        <li class="header">Product 1 </li>
                        <li><img src="images/bg/bg6.jpg" style="width:200px; height:120px;"/></li>
                        <li style="font-weight:bold; font-size: 24px;">Grey Ball and Bat</li>
                        <li class="grey" style="float:left;">Price: $400/-</li>
                        <li>Reviews: 25</li>                    
                        <li style="font-weight:bold;">Technical Information<p>Technical InformationTechnical InformationTechnical InformationTechnical InformationTechnical Information</p></li>
                        <li ><a href="#" class="button">Add to Cart</a></li>
                        <li class="remove"><a href="wishlist.php?wishlist_id=11"><i class="icon-trash icons"></i></a></li>
                    </ul>
                </div>

                <div class="columns2">
                    <ul class="price">
                        <li class="header" style="background-color:#088178">Product 2</li>
                        <li><img src="images/bg/bg6.jpg" style="width:200px; height:120px;"/></li>
                        <li style="font-weight:bold; font-size: 24px;">Grey Ball and Bat</li>
                        <li class="grey" style="float:left;">Price: $400/-</li>
                        <li>Reviews: 25</li>                    
                        <li style="font-weight:bold;">Technical Information<p>Technical InformationTechnical InformationTechnical InformationTechnical InformationTechnical Information</p></li>
                        <li ><a href="#" class="button">Add to Cart</a></li>
                        <li class="remove"><a href="wishlist.php?wishlist_id=11"><i class="icon-trash icons"></i></a></li>
                    </ul>
                </div>

                <div class="columns2">
                    <ul class="price">
                        <li class="header">Product 3</li>
                        <li><img src="images/bg/bg6.jpg" style="width:200px; height:120px;"/></li>
                        <li style="font-weight:bold; font-size: 24px;">Grey Ball and Bat</li>
                        <li class="grey" style="float:left;">Price: $400/-</li>
                        <li>Reviews: 25</li>                    
                        <li style="font-weight:bold;">Technical Information<p>Technical InformationTechnical InformationTechnical InformationTechnical InformationTechnical Information</p></li>
                        <li ><a href="#" class="button">Add to Cart</a></li>
                        <li class="remove"><a href="wishlist.php?wishlist_id=11"><i class="icon-trash icons"></i></a></li>
                    </ul>
                </div>
                
            </div>
        </div>
        
				
<?php require('footer.php')?>        