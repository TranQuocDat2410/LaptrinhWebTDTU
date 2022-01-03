<?php


require('Connection.php');


if(isset($_GET['id']))
{
     $sql = "DELETE FROM `room` WHERE `room`.`id` = ?";
     $stm = $dbCon->prepare($sql);
     $stm->execute(array($_GET['id']));
}


?>