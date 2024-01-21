 <?php
    include './model/pdo.php';
    include "../model/danhmuc.php";

    include "view/header.php";
    if (isset($_GET['act']) && $_GET['act'] != "") {
        $act = $_GET['act'];
       

    } else {
        include "view/home.php";
    }
    //hihi
    ?>