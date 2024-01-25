<?php

function insert_sanpham($tensp,$giasp,$hinh,$mota,$iddm){
    $sql = "INSERT INTO `products`(`name_product`, `price`, `image`, `detail`, `iddm`) 
    VALUES ('$tensp','$giasp','$hinh','$mota','$iddm')";
    pdo_execute($sql);
}

function loadall_sanpham(){
    $sql = "SELECT * FROM `products` order by id desc";
    $listsanpham =  pdo_query($sql);
    return $listsanpham;
}
function delete_sanpham($id){
    $sql = "DELETE FROM products where id='{$id}'";
    pdo_execute($sql);
}
function loadone_sanpham($id){
    $sql = "SELECT * from products where id=".$id;
    $sp = pdo_query_one($sql);
    return $sp;
}
function update_sanpham($id,$tensp, $giasp, $hinh, $mota, $iddm){
    $sql = "UPDATE `products` SET 
            `name_product`='{$tensp}', `price`='{$giasp}', `image`='{$hinh}', `detail`='{$mota}', `iddm`='{$iddm}' 
            WHERE id='{$id}'";
    pdo_execute($sql);
}
//xong

function load_all_product(){
    $sql="SELECT *from products where 1";
    $result=pdo_query($sql);
    return $result;

}
// lấy 1 sản phẩm
function load_one_product($id){
    $sql ="SELECT *from products where id='$id'";
    $result=pdo_query_one($sql);
    return $result;
}
?>