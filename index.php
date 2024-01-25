<?php 

include_once 'model/pdo.php';
include_once 'model/sanpham.php';
include_once 'model/notification.php';

 include "view/header.php";
 $sanpham=load_all_product();
    if(isset($_GET['act'])&&($_GET['act']!="")){
        $act=$_GET['act'];
        switch($act){
            case 'ctsanpham':
                if(isset($_GET['id'])){
                    $id=$_GET['id'];
                  $ctsanpham= load_one_product($id);
                }
                   include_once 'view/product-page.php';
                break;
                case 'checkout':
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $ctsanpham = load_one_product($id);
        
                        if (isset($_POST['btn_insert'])) {
                            $product_id = $_POST['product_id']; 
                            $message = $_POST['message'];
                            $phone_number = $_POST['phone_number'];
                            $email = $_POST['email'];
                            $name_user = $_POST['name_user'];
                            $date_time = $_POST['date_time'];
                            insert_notification($product_id, $message, $email, $name_user, $phone_number, $date_time);
                        }
        
                        include 'view/checkout.php';
                    }
                    break;
        }
    }else{
        include "view/home.php";
    }
   
    include "view/footer.php";
?>

        
