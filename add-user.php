<?php
    require_once ('Connection.php');
    
    if ( empty($_POST['name']) || empty($_POST['username']) || empty($_POST['username']) || empty($_POST['address']) || empty($_POST['birthday']) || empty($_POST['gender']) || empty($_POST['room']) ){
        die(json_encode(array('status' => false, 'data' => 'Thông tin không được để trống')));
    }
    else{
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $username;
        $room = $_POST['room'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $birthday = $_POST['birthday'];
        $salary = $_POST['salary'];
        $passwordHashed = password_hash($password,PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO `account` (`username`, `password`, `name`, `chucvu`, `phongban`, `diachi`, `birthday`, `activated`, `salary`) VALUES (?,?,?,'Nhân viên',?,?,?, b'0',?)";

        try{
            $stm = $dbCon->prepare($sql);
            $stm->execute(array($username,$passwordHashed,$name,$room,$address,$birthday,$salary));
            echo json_encode(array('status' => true, 'data' => 'Thêm nhân viên thành công'));
        }
        catch(PDOException $ex){
            die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
        }
    }

?>