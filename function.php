<?php
    // require_once 'connection.php';

    function  add_user($username, $name, $room, $address, $birthday, $salary, $email, $avatar, $phone, $gender){
        $passwordHashed = password_hash($username,PASSWORD_DEFAULT);
        require 'connection.php';
        // echo "thành công";
        $sql = " INSERT INTO `account` (`username`, `password`, `name`, `chucvu`, `phongban`, `diachi`, `birthday`, `activated`, `salary`, `email`, `avatar`, `phone`,`gender`) VALUES (?, ?, ?, ?, ?, ?, ?, b'0', ?, ?, ?,?,?); ";
        $stm = $dbCon->prepare($sql);
        try{
            $stm->execute(array($username,$passwordHashed,$name,"Nhân viên",$room,$address,$birthday,$salary,$email, $avatar, $phone, $gender));
            return $stm->rowCount();
        }
        catch(Exception $e){
            $error = "Username đã tồn tại";
            // echo($error);
            return $error;
        }
    }

    function add_room($name, $desc, $leader, $number){
        require 'connection.php';
        $sql = "INSERT INTO `room` (`name`, `description`, `leader`, `num_room`) VALUES (?,?,?,?)";
        $stm = $dbCon->prepare($sql);
        try {
            $stm->execute(array($name,$desc, $leader, $number));
            return $stm->rowCount();
        }
        catch (Exception $e){
            return $e;
        }
    }

    function changePrivilage($name, $type){
        require 'connection.php';
        $sql = "UPDATE `account` SET `chucvu` = ? WHERE `account`.`name` = ?";
        $stm = $dbCon->prepare($sql);
        $stm->execute(array($type,$name));
        return $stm->rowCount();
    }



    function changeLeaderRoom($room, $leader){
        require 'connection.php';
        $sql = "UPDATE `room` SET `leader` = ? WHERE `room`.`name` = ?";
        $stm = $dbCon->prepare($sql);
        try{
            $stm->execute(array($leader,$room));
            return $stm->rowCount();
        }
        catch(Exception $e){
            $error = "Lỗi";
            return $error;
        }
    }


    function changeAccountRoom($name,$room){
        require 'connection.php';
        $sql = "UPDATE `account` SET `phongban` = ? WHERE `account`.`name` = ?";
        $stm = $dbCon->prepare($sql);
        try{
            $stm->execute(array($room, $name));
            return $stm->rowCount();
        }
        catch(Exception $e) {
            return $e->getMessage();
        }
    }
    // echo changeAccountRoom('Thu Thảo', "Kinh doanh");

    // echo changeLeaderRoom("Marketing","Minh Mẫn");

    function editUser($name, $username, $email, $phone, $address, $birthday, $salary, $type, $room, $gender, $id){
        require 'connection.php';
        $sql = "UPDATE `account` SET `name`=?, `username`=?, `email`=?, `phone`=?, `diachi`=?, `birthday`=?, `salary`=?, `chucvu`=?, `phongban`=?, `gender`=?  WHERE `account`.`id` = ?";
		$stm = $dbCon->prepare($sql);
        try{
            $stm->execute(array($name,$username,$email,$phone,$address,$birthday,$salary,$type,$room,$gender,$id));
            return $stm->rowCount();
        }
        catch(Exception $e){
            $error = "Lỗi";
            return $error;
        }
    }

    function editRoom($name, $leader, $number, $desc, $id){
        require 'connection.php';
        $sql = "UPDATE `room` SET `name` = ?, `leader` = ?, `num_room` = ?, `description` = ? WHERE `room`.`id` = ?";
        $stm = $dbCon->prepare($sql);
        try{
            $stm->execute(array($name,$leader,$number,$desc,$id));
            return $stm->rowCount();
        }
        catch(Exception $e){
            return "Lỗi";
        }
    }

    // echo editUser("Thanh Hiền", "thanhhien", "hien123@gmail.com", "123456789", "Hà Nội", "2001-10-02",18,"Nhân viên","Kinh doanh","Nữ","50");

    function getNameById($id){
        require 'connection.php';
        $sql = "SELECT name FROM `account` WHERE id=?";
        $stm = $dbCon->prepare($sql);
        $stm->execute(array($id));
        $data = $stm->fetch(PDO::FETCH_ASSOC);
        return $data['name'];
    }

    function getRoomById($id){
        require 'connection.php';
        $sql = "SELECT phongban FROM account WHERE id=?";
        $stm = $dbCon->prepare($sql);
        $stm->execute(array($id));
        $data = $stm->fetch(PDO::FETCH_ASSOC);
        return $data['phongban'];
    }

    function getLeaderRoom($name){
        require 'connection.php';
        $sql = "SELECT leader FROM `room` WHERE `room`.`name`=?";
        $stm = $dbCon->prepare($sql);
        $stm->execute(array($name));
        $data = $stm->fetch(PDO::FETCH_ASSOC);
        return $data['leader'];
    }

    echo getLeaderRoom("Marketing");

    function setleaderByName($name,$type){
        require 'connection.php';
        $sql = "UPDATE `account` SET `chucvu` = ? WHERE `account`.`name` = ?";
        $stm = $dbCon->prepare($sql);
        $stm->execute(array($type,$name));
    }



    

    // setleaderByName("Trần Quốc Đạt","Trưởng phòng");
?>