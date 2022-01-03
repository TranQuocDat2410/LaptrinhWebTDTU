<?php 
    session_start();
    $user = "";
    $pass = "";
    $error = "";
    if (isset($_POST['user']) && isset($_POST['pass'])){
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        if (empty($user)){
            $error = "Input your username";
        }
        else if (empty($pass)){
            $error = "Input your password";
        }
        else{
            require_once 'connection.php';
            $sql = "SELECT * FROM `account` WHERE username = ?";
            $stm = $dbCon->prepare($sql);
            $stm->execute(array($user));
            if ($stm->rowCount()==0){
                $error = "User not in database";
            }
            else{
                $dataUser = $stm->fetch(PDO::FETCH_ASSOC);
                $id = $dataUser['id'];
                
                if (password_verify($pass,$dataUser['password']) ){
                    echo "login thành công";
                    if ($dataUser['activated'] == 0){
                        header("Location: set_password.php?id=$id");
                        die();
                    }
                    $_SESSION['id'] = $dataUser['id'];
                    // $_SESSION['name'] = $dataUser['name'];
                    // $_SESSION['username'] = $dataUser['username'];
                    // $_SESSION['address'] = $dataUser['diachi'];
                    // $_SESSION['type'] = $dataUser['chucvu'];
                    // $_SESSION['room'] = $dataUser['phongban'];
                    // $_SESSION['birthday'] = $dataUser['birthday'];
                    // $_SESSION['avatar'] = $dataUser['avatar'];
                    header("Location: index.php");
                }
                else {
                    $error = "Password not correct";
                }
            }
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css" />
</head>
<body id="lg">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <!-- <h3 class="text-center text-secondary mt-5 mb-3">User Login</h3> -->
            <h1 class="text-center mt-5 mb-3">TDT Company</h1>
            <img src="img/TĐT_logo.png" class="w-50 d-flex mx-auto my-3" alt="">
            <form method="post" action="" class="border rounded w-100 mb-5 mx-auto px-3 pt-3 bg-light">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input value="<?= $user ?>" name="user" id="user" type="text" class="form-control" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="pass" value="<?= $pass ?>" id="password" type="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group custom-control custom-checkbox">
                    <input <?= isset($_POST['remember']) ? 'checked' : '' ?> name="remember" type="checkbox" class="custom-control-input" id="remember">
                    <label class="custom-control-label" for="remember">Remember login</label>
                </div>
                <div class="form-group">
                    <?php
                        if (!empty($error)) {
                            echo "<div class='alert alert-danger'>$error</div>";
                        }
                    ?>
                    <button class="btn btn-success px-5">Login</button>
                </div>
                <div class="form-group">
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
