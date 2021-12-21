<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
<?php
    require_once ('Connection.php');
    $name = '';
    $username = '';
    $password ='';
    $email = '';
    $address = '';
    $birthday = '';
    $gender = '';
    $room = '';
    $salary = '';
    $avatar = 'avatar.png';
    $error = '';
    $phone ='';

    // $f = isset($_FILES['avatar']) ? $_FILES['avatar'] : "";
    // $dest = "img/".$f['name'];
    if (isset($_FILES['avatar'])){
        $f = $_FILES['avatar'];
        $dest = "img/".$f['name'];
        $avatar = $f['name'];
        move_uploaded_file($f['tmp_name'],$dest);
        if (empty($avatar)){
            $avatar = 'avatar.png';
        }
    }

    if (isset($_POST['name']) && isset($_POST['username']) && isset($_POST['address']) && isset($_POST['email']) && isset($_POST['birthday']) && isset($_POST['room']) && isset($_POST['salary']) && isset($_POST['phone']) ){
        $gender = isset($_POST['gender']) ? $_POST['gender'] : "" ; 
        $name = $_POST['name'];
        $username = $_POST['username'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $birthday = $_POST['birthday'];
        $room = $_POST['room'];
        $salary = $_POST['salary'];
        $phone = $_POST['phone'];
    


        if(empty($name)){
            $error = "Nhập tên nhân viên";
        }
        else if(empty($username)){
            $error = "Nhập username";
        }
        else if(empty($address)){
            $error = "Nhập địa chỉ nhà";
        }
        else if(empty($email)){
            $error = "Nhập địa chỉ email";
        }
        else if(empty($birthday)){
            $error = "Nhập ngày sinh";
        }
        else if(empty($gender)){
            $error = "Chọn giới tính";
        }
        else if(empty($room)){
            $error = "Nhập phòng ban";
        }
        else if(empty($salary)){
            $error = "Nhập lương nhân viên";
        }
        else if(empty($phone)){
            $error = "Nhập số điện thoại";
        }
        else{
            $passwordHashed = password_hash($username,PASSWORD_DEFAULT);
            // echo "thành công";
            $sql = " INSERT INTO `account` (`username`, `password`, `name`, `chucvu`, `phongban`, `diachi`, `birthday`, `activated`, `salary`, `email`, `avatar`, `phone`) VALUES (?, ?, ?, ?, ?, ?, ?, b'0', ?, ?, ?,?); ";
            $stm = $dbCon->prepare($sql);
            try{
                $stm->execute(array($username,$passwordHashed,$name,"Nhân viên",$room,$address,$birthday,$salary,$email, $avatar, $phone));
                if ($stm->rowCount()==1){
                    header("Location: notification.php?type=add_user_success");
                }
            }
            catch(Exception $e){
                $error = "Lỗi ".$e->getMessage();
            }

        }
        
    }

?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 border my-5 px-4 pt-4 pb-2 mx-auto">
                <h3 class="text-center text-secondary mt-2 mb-3 ">Thêm nhân viên</h3>    
                <form action="" method="post" novalidate enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Tên nhân viên</label>
                        <input value="<?= $name ?>" name="name" class="form-control" type="text" placeholder="Name" id="name">
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input value="<?= $username ?>"  name="username" class="form-control" type="text" placeholder="Username" id="username">
                    </div>

                    <div class="form-group">
                        <label for="phone">Điện thoại</label>
                        <input value="<?= $phone ?>" name="phone" class="form-control" type="text" placeholder="Điện thoại" id="phone">
                    </div>

                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input value="<?= $address ?>" name="address" class="form-control" type="text" placeholder="Địa chỉ" id="address">
                    </div>

                    <div class="form-group">
                        <label for="address">Địa chỉ email</label>
                        <input value ="<?= $email ?>" name="email" class="form-control" type="email" placeholder="Địa chỉ email" id="email">
                    </div>

                    <div class="form-group">
                        <label for="birthday">Ngày sinh</label>
                        <input value="<?= $birthday ?>" name="birthday" class="form-control" type="date" placeholder="birthday" id="birthday">
                    </div>

                    <div class="form-group form-inline">
                        <span class="mr-3">Giới tính: </span>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="Nam">
                            <label class="form-check-label" for="inlineRadio1">Nam</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="Nữ">
                            <label class="form-check-label" for="inlineRadio2">Nữ</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="list_room">Phòng ban</label>
                        <select name ="room" class="form-control" id="list_room">
                            <?php 
                                $sql = "SELECT name FROM `room`";
                                $stm = $dbCon->prepare($sql);
                                $stm->execute();
                                while($row = $stm->fetch(PDO::FETCH_ASSOC)){
                                    ?>
                                        <option><?= $row['name'] ?></option>        
                                    <?php       
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="salary">Lương</label>
                        <input value="<?= $salary ?>" name="salary" required class="form-control" type="number" placeholder="Lương" id="salary">
                    </div>

                    <div class="form-group">
                        <label for="avatar">Avatar</label>
                        <input type="file" class="form-control-file" id="avatar" name="avatar">
                    </div>
                    <div class="form-group">
                        <?php
                            if (!empty($error)) {
                                echo "<div class='alert alert-danger'>$error</div>";
                            }
                        ?>
                        <button type="submit" class="btn btn-primary px-5 d-block ml-auto">Thêm</button>
                    </div>                    
                    
                </form>
            </div>
            
        </div>
        
        
        
        
        
    
        
        
        
    </div>
    
</body>
</html>