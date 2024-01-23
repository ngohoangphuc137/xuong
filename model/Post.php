<?php
function listPost()
{
    $sql = "SELECT * FROM `post`";
    return pdo_query($sql);
}
function insertPost($ImageUpload, $mota, $date, $name)
{
    $sql = "INSERT INTO `post`(`image`, `content`, `date`, `user_post`) VALUES 
    ('$ImageUpload','$mota','$date','$name')";
    return pdo_execute($sql);
}
function insterPostID($id)
{
    $sql = "SELECT * FROM `post` WHERE id=$id";
    return pdo_query_one($sql);
}
function updataPost($ImageUpload, $mota, $date, $name, $id)
{
    $sql = "UPDATE `post` SET `image`='$ImageUpload',`content`='$mota',
    `date`='$date',`user_post`='$name' WHERE `id`='$id'";
    return pdo_execute($sql);
}
function deletePost($id){
 $sql = "DELETE FROM `post` WHERE id=$id";
 return pdo_query_one($sql);
}
?>