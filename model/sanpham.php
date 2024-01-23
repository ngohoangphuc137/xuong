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