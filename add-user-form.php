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

    if (isset($_FILES['avatar'])){
        $f = $_FILES['avatar'];
        $dest = "img/".$f['name'];
        $avatar = $f['name'];
        move_uploaded_file($f['tmp_name'],$dest);
        if (empty($avatar)){
            $avatar = 'avatar.png';
        }
    }

    // if (isset($_POST['name']) && isset($_POST['username']) && isset($_POST['address']) && isset($_POST['email']) && isset($_POST['birthday']) && isset($_POST['salary']) && isset($_POST['phone']) ){
    if (isset($_POST['submit'])){
        $gender = isset($_POST['gender']) ? $_POST['gender'] : "" ; 
        $name = isset($_POST['name']) ? $_POST['name'] : "" ;
        $username = isset($_POST['username']) ? $_POST['username'] : "" ;
        $address = isset($_POST['address'])? $_POST['address'] : "" ;
        $email = isset($_POST['email'])? $_POST['email'] : "" ;
        $birthday = isset($_POST['birthday'])? $_POST['birthday'] : "";
        $room = isset($_POST['room'])? $_POST['room'] : "" ;
        $salary = isset($_POST['salary'])? $_POST['salary'] : "" ;
        $phone = isset($_POST['phone'])? $_POST['phone'] : "" ;
    


        if(empty($name)){
            $error = "Nh???p t??n nh??n vi??n";
        }
        else if(empty($username)){
            $error = "Nh???p username";
        }
        else if(empty($address)){
            $error = "Nh???p ?????a ch??? nh??";
        }
        else if(empty($email)){
            $error = "Nh???p ?????a ch??? email";
        }
        else if(empty($birthday)){
            $error = "Nh???p ng??y sinh";
        }
        else if(empty($gender)){
            $error = "Ch???n gi???i t??nh";
        }
        else if(empty($room)){
            $error = "Nh???p ph??ng ban";
        }
        else if(empty($salary)){
            $error = "Nh???p l????ng nh??n vi??n";
        }
        else if(empty($phone)){
            $error = "Nh???p s??? ??i???n tho???i";
        }
        else if (strtotime($birthday) > time()){
            $error = "Ng??y sinh kh??ng h???p l???";
        }
        else{
            
            require 'function.php';
            if(add_user($username, $name, $room, $address, $birthday, $salary, $email, $avatar, $phone, $gender)==1){
                header("Location: notification.php?type=add_user_success");
            }
            else{
                $error = add_user($username, $name, $room, $address, $birthday, $salary, $email, $avatar, $phone, $gender);
            }
            
        }
        
    }

?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 border my-5 px-4 pt-4 pb-2 mx-auto">
                <h3 class="text-center text-secondary mt-2 mb-3 ">Th??m nh??n vi??n</h3>    
                <form action="" method="post" novalidate enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">T??n nh??n vi??n</label>
                        <input value="<?= $name ?>" name="name" class="form-control" type="text" placeholder="Name" id="name">
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input value="<?= $username ?>"  name="username" class="form-control" type="text" placeholder="Username" id="username">
                    </div>

                    <div class="form-group">
                        <label for="phone">??i???n tho???i</label>
                        <input value="<?= $phone ?>" name="phone" class="form-control" type="text" placeholder="??i???n tho???i" id="phone">
                    </div>

                    <div class="form-group">
                        <label for="address">?????a ch???</label>
                        <input value="<?= $address ?>" name="address" class="form-control" type="text" placeholder="?????a ch???" id="address">
                    </div>

                    <div class="form-group">
                        <label for="address">?????a ch??? email</label>
                        <input value ="<?= $email ?>" name="email" class="form-control" type="email" placeholder="?????a ch??? email" id="email">
                    </div>

                    <div class="form-group">
                        <label for="birthday">Ng??y sinh</label>
                        <input value="<?= $birthday ?>" name="birthday" class="form-control" type="date" placeholder="birthday" id="birthday">
                    </div>

                    <div class="form-group form-inline">
                        <span class="mr-3">Gi???i t??nh: </span>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="Nam" <?php if(isset($_POST['gender']) && $_POST['gender'] =='Nam' ){echo "checked";}?>>
                            <label class="form-check-label" for="inlineRadio1">Nam</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="N???" <?php if(isset($_POST['gender']) && $_POST['gender'] =='N???' ){echo "checked";}?>>
                            <label class="form-check-label" for="inlineRadio2">N???</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="list_room">Ph??ng ban</label>
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
                        <label for="salary">L????ng</label>
                        <input value="<?= $salary ?>" name="salary" required class="form-control" type="number" placeholder="L????ng" id="salary">
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
                        <button name="submit" type="submit" class="btn btn-primary px-5 d-block ml-auto">Th??m</button>
                    </div>                    
                    
                </form>
            </div>
            
        </div>
        
        
        
        
        
    
        
        
        
    </div>
    
</body>
</html>