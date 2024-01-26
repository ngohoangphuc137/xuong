<?php
include '../model/pdo.php';
include '../model/danhmuc.php';
include '../model/sanpham.php';
include '../model/Post.php';
include '../global.php';
include "header.php";
if (isset($_GET['act']) && $_GET['act'] != "") {
    $act = $_GET['act'];
    switch ($act) {
        //bắt đầu danh mục (chinh)
        case 'adddm':
            if (isset($_POST['themmoidanhmuc']) && $_POST['themmoidanhmuc']) {
                $tenloai = $_POST['tenloai'];
                insert_danhmuc($tenloai);
            }
            include './danhmuc/add.php';
            break;
        case 'listdm':
            $listdm = loadall_danhmuc();
            include './danhmuc/list.php';
            break;
        case 'xoadm':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                delete_danhmuc($_GET['id']);
            }
            $listdm = loadall_danhmuc();
            include './danhmuc/list.php';
            break;
        case 'suadm':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                $dm = loadone_danhmuc($_GET['id']);
            }
            include "./danhmuc/update.php";
            break;
        case 'updatedm':
            if (isset($_POST['capnhat']) && ($_POST['capnhat'])) {
                $tenloai = $_POST['tenloai'];
                $id = $_POST['id'];
                update_danhmuc($id, $tenloai);
            }
            $listdm = loadall_danhmuc();
            include "./danhmuc/list.php";
            break;
        //xong danh mục (chinh)  

        //bắt đầu sản phẩm (chinh)  
        case 'addsp':
            if (isset($_POST['themmoi']) && $_POST['themmoi']) {
                $tensp = $_POST['tensp'];
                $giasp = $_POST['giasp'];
                $mota = $_POST['mota'];
                $iddm = $_POST['iddm'];

                // Nếu không có lỗi, tiến hành upload ảnh và thêm sản phẩm

                $hinh = $_FILES['hinh'];

                // Kiểm tra xem có lỗi không
                if ($hinh['error'] !== UPLOAD_ERR_OK) {
                    echo '<script>alert("Lỗi khi upload ảnh sản phẩm");</script>';
                } else {
                    // Đường dẫn thư mục upload
                    $targetDir = "../upload/";

                    // Tạo đường dẫn đầy đủ cho tệp ảnh
                    $targetFile = $targetDir . basename($hinh['name']);
                    // Di chuyển tệp ảnh vào thư mục đích
                    if (move_uploaded_file($hinh['tmp_name'], $targetFile)) {
                        $image_url = $targetFile;

                        // Gọi hàm insertProduct để thêm sản phẩm vào cơ sở dữ liệu
                        $check = insert_sanpham($tensp, $giasp, $image_url, $mota, $iddm);

                        if (!$check) {
                            echo '<script>alert("Thêm sản phẩm thành công");</script>';
                        } else {
                            echo '<script>alert("Lỗi khi thêm sản phẩm vào cơ sở dữ liệu");</script>';
                        }
                    } else {
                        echo '<script>alert("Lỗi khi di chuyển ảnh sản phẩm vào thư mục đích");</script>';
                    }
                }
            }
            $listdm = loadall_danhmuc();
            include './sanpham/add.php';
            break;
        case 'listsp':
            $listsp = loadall_sanpham();
            include './sanpham/expost.php';
            include './sanpham/list.php';
            break;
        case 'xoasp':
            if (isset($_GET['idsp']) && ($_GET['idsp'] > 0)) {
                delete_sanpham($_GET['idsp']);
            }
            $listsp = loadall_sanpham();
            include './sanpham/list.php';
            break;
        case 'suasp':
            if (isset($_GET['idsp']) && ($_GET['idsp'] > 0)) {
                $sanpham = loadone_sanpham($_GET['idsp']);
            }
            $listdm = loadall_danhmuc();
            include "./sanpham/update.php";
            break;
        case 'updatesp':
            if (isset($_POST['capnhat']) && $_POST['capnhat']) {
                $id = $_POST['id'];
                $tensp = $_POST['tensp'];
                $giasp = $_POST['giasp'];
                $mota = $_POST['mota'];
                $iddm = $_POST['iddm'];

                // Nếu không có lỗi, tiến hành upload ảnh và thêm sản phẩm

                $hinh = $_FILES['hinh'];

                // Kiểm tra xem có lỗi không
                if ($hinh['error'] !== UPLOAD_ERR_OK) {
                    echo '<script>alert("Lỗi khi upload ảnh sản phẩm");</script>';
                } else {
                    // Đường dẫn thư mục upload
                    $targetDir = "../upload/";

                    // Tạo đường dẫn đầy đủ cho tệp ảnh
                    $targetFile = $targetDir . basename($hinh['name']);
                    // Di chuyển tệp ảnh vào thư mục đích
                    if (move_uploaded_file($hinh['tmp_name'], $targetFile)) {
                        $image_url = $targetFile;

                        // Gọi hàm insertProduct để thêm sản phẩm vào cơ sở dữ liệu
                        $check = update_sanpham($id, $tensp, $giasp, $image_url, $mota, $iddm);

                        if (!$check) {
                            echo '<script>alert("Thêm sản phẩm thành công");</script>';
                        } else {
                            echo '<script>alert("Lỗi khi thêm sản phẩm vào cơ sở dữ liệu");</script>';
                        }
                    } else {
                        echo '<script>alert("Lỗi khi di chuyển ảnh sản phẩm vào thư mục đích");</script>';
                    }
                }
            }
            $listdm = loadall_danhmuc();
            $listsp = loadall_sanpham();
            include "./sanpham/list.php";
            break;
        //xong sản phẩm (chinh)  
            
        //code của phúc
        case "listPost":
            $listPost = listPost();

            if (isset($_GET['delPost'])) {
                $deleImag = insterPostID($_GET['delPost']);
            }
            if (isset($_GET['delPost'])) {
                if ($deleImag['image'] !== "") {
                    unlink('img/' . $deleImag['image']);
                }
                deletePost($_GET['delPost']);
                header("location:index.php?act=listPost");
            }

            include "./Post/listPost.php";
            break;
        case "morePost":
            if (isset($_POST['btnMorePost'])) {
                $name = $_POST['name'];
                $date = $_POST['date'];

                $ImageUpload = $_FILES['ImageUpload']['name'];
                $ImageUpload_tmp = $_FILES['ImageUpload']['tmp_name'];

                $mota = $_POST['mota'];
                if (!empty($name) && !empty($date)) {
                    insertPost($ImageUpload, $mota, $date, $name);
                    move_uploaded_file($ImageUpload_tmp, "img/" . $ImageUpload);
                    header('location:index.php?act=listPost');
                }
            }
            include "./Post/morePost.php";
            break;
        case 'updataPost':
            if (isset($_GET['idUpdata'])) {
                $insterPostID = insterPostID($_GET['idUpdata']);
            }
            if (isset($_POST['btnUpdataPost'])) {
                $date = $_POST['date'];

                $ImageUpload = $_FILES['ImageUpload']['name'];
                if ($ImageUpload == "") {
                    $ImageUpload = $insterPostID['image'];
                } else {
                    if ($insterPostID['image'] !== "") {
                        unlink("img/" . $insterPostID['image']);
                    }
                    $ImageUpload = $_FILES['ImageUpload']['name'];
                }
                $ImageUpload_tmp = $_FILES['ImageUpload']['tmp_name'];

                $mota = $_POST['mota'];
                updataPost($ImageUpload, $mota, $date, $_GET['idUpdata']);
                move_uploaded_file($ImageUpload_tmp, "img/" . $ImageUpload);
                header('location:index.php?act=listPost');
            }
            include "./Post/updataPost.php";
            break;
        default:
            include "home.php";
            break;
    }

} else {
    include "home.php";
}
include "footer.php";
?>