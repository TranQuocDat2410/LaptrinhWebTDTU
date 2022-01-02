<?php
require 'connection.php';
if(isset($_GET['id'])&&isset($_GET['radio'])){
    $sql = "UPDATE `nghiphep` SET `Status` = ? WHERE `nghiphep`.`ID_Form` = ?;";
    $stm = $dbCon->prepare($sql);
    $stm->execute(array($_GET['radio'],$_GET['id']));
}

?>