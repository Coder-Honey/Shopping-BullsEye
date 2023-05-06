<?php 
require('top.php'); 
$sub_id = mysqli_real_escape_string($con,$_GET['id']);

$price_high_selected = '';
$price_low_selected = '';
$new_selected = '';
$old_selected = '';
$sort_order = '';
if(isset($_GET['sort'])){
    $sort = mysqli_real_escape_string($con,$_GET['sort']);
    if($sort == "price_high") {
        $sort_order = " order by product.price desc";
        $price_high_selected = "selected";
    }
    if($sort == "price_low") {
        $sort_order = " order by product.price asc";
        $price_low_selected = "selected";
    }
    if($sort == "new") {
        $sort_order = " order by product.id desc";
        $new_selected = "selected";
    }
    if($sort == "old") {
        $sort_order = " order by product.id asc";
        $old_selected = "selected";
    }
}

if($sub_id > 0){
    $get_product = get_product($con,'','',$sub_id,'',$sort_order);
}else {
    ?>
    <script>
        window.location.href='index.php';
    </script>
    <?php
}
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
                                  <?php
                                    $sub_name = mysqli_query($con,"select sub_categories from sub_categories where sub_categories.id='$sub_id'");
                                    $subm_arr=array();
                                    while($row12=mysqli_fetch_assoc($sub_name)){
                                        $subm_arr[]=$row12;	
                                  ?>
                                  <span class="breadcrumb-item active"><?php echo $row12['sub_categories']?> Full Kit</span>
                                  <?php } ?>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Product Grid -->
        <section class="htc__product__grid bg__white ptb--100">
            <div class="container">
                <div class="row"> 
                <div class="col-lg-3 smt-40 xmt-40 order-lg-1 order-2">
                        <div class="htc__product__leftsidebar">
                            <!-- Start Category Area -->
                            <div class="htc__category" style="margin-top: 0px;">
                                <h4 class="title__line--4">categories</h4>
                                <ul class="ht__cat__list">
                                    <?php
                                        foreach($subcat_arr as $list) {
                                    ?>                                                
                                        <li><a href="subcategories.php?id=<?php echo $list['id']?>"><?php echo $list['sub_categories']?></a></li>                                    
                                    <?php
                                        }
                                    ?>
                                </ul>
                            </div>
                            <!-- End Category Area -->
                        </div>
                    </div>                   
                    <div class="col-lg-9 order-lg-2 order-1">                    
                        <div class="htc__product__rightidebar">
                        <?php if(count($get_product)>0) { ?>
                            <div class="htc__grid__top">
                                <div class="htc__select__option">
                                    <select class="ht__select" onchange="sort_product_drop('<?php echo$cat_id ?>','<?php echo SITE_PATH ?>')" 
                                    id="sort_product_id">
                                        <option value="">Default softing</option>
                                        <option value="price_low" <?php echo $price_low_selected ?>>Sort by price low to high</option>
                                        <option value="price_high" <?php echo $price_high_selected ?>>Sort by price high to low</option>
                                        <option value="new" <?php echo $new_selected ?>>Sort by new first</option>
                                        <option value="old" <?php echo $old_selected ?>>Sort by old first</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Start Product View -->                            
                            <div class="row">
                                <div class="shop__grid__view__wrap">
                                    <div role="tabpanel" id="grid-view" class="single-grid-view tab-pane fade in active clearfix">
                                    <?php                                      
                                        foreach($get_product as $list) {
                                    ?>
                                    <!-- Start Single Category -->
                                    <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                        <div class="category">
                                            <div class="ht__cat__thumb">
                                                <a href="product.php?id=<?php echo $list['id']?>">
                                                    <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$list['image']?>" alt="product images" style="height:200px;">
                                                </a>
                                            </div>
                                            <div class="fr__hover__info">
                                                <ul class="product__action">
                                                    <li><a href="javascript:void(0)" onclick="wishlist_manage('<?php echo $list['id']?>','add')"><i class="icon-heart icons"></i></a></li>
                                                    <li><a href="#"><i class="icon-shuffle icons"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="fr__product__inner">
                                                <h4><a href="product-details.html"><?php echo $list['name']?></a></h4>
                                                <ul class="fr__pro__prize">
                                                    <li class="old__prize" style="text-decoration: line-through;">₹<?php echo $list['mrp']?></li>
                                                    <li>₹<?php echo $list['price']?></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Single Category -->   
                                    <?php } ?>           
                                    </div>
                                </div>
                            </div>
                            <!-- End Product View -->
                            <br>
                            <?php } else {echo "Data not found";} ?>

                            
                        </div>                        
                    </div>                    
                </div>
            </div>
        </section>
        <!-- End Product Grid -->
<?php require('footer.php'); ?>