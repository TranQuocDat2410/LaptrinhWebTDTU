<?php


require('Connection.php');


if(isset($_GET['id']))
{
     $sql = "DELETE FROM `phongban` WHERE `phongban`.`idphong` = ?";
     $stm = $dbCon->prepare($sql);
     $stm->execute(array($_GET['id']));
}


?>