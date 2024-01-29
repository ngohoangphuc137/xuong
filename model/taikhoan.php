<?php
function loadall_taikhoan(){
    $sql = "SELECT * FROM users order by id desc";
    $listtaikhoan =  pdo_query($sql);
    return $listtaikhoan;
}
function delete_taikhoan($id){
    $sql = "DELETE FROM users where id=".$id;
    pdo_execute($sql);
}
?>