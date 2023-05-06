<?php
session_start();
$con=mysqli_connect("localhost:3306","root","","ecom");
define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/bullseye_ecom/');
define('SITE_PATH','http://localhost:80/bullseye_ecom/');

define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'/media/product/');
define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'/media/product/');

define('COURSE_IMAGE_SERVER_PATH',SERVER_PATH.'/media/course/');
define('COURSE_IMAGE_SITE_PATH',SITE_PATH.'/media/course/');
?>