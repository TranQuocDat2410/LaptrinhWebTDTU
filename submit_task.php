<?php
    $id = 17;
    $desc="Lần thứ 2";
    $attch = "test.txt";
    $sender = "Thu Thảo";

    $tz = 'Asia/Bangkok';
    $timestamp = time();
    $dt = new DateTime("now", new DateTimeZone($tz)); 
    $dt->setTimestamp($timestamp); 
    $time = $dt->format("Y-m-d G:i:s");

    require "connection.php";
    $sql = "INSERT INTO `task_history` (`id`,`description`, `attach`, `time`, `sender`) VALUES (?,?,?,?,?)";
    $stm = $dbCon->prepare($sql);
    $stm->execute(array($id,$desc,$attch,$time,$sender));
    print_r($stm->rowCount());
?>