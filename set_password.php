<!DOCTYPE html>
<html lang="en">
<?php require_once 'heading.php' ?>

<?php
    $oldPassword = "";
    $newPassword = "";
    $confirmPassword = "";
    $error = "";

    if (isset($_POST['old-password']) && isset($_POST['new-password']) && isset($_POST['confirm-password']) ){
        $oldPassword = $_POST['old-password'];
        $newPassword = $_POST['new-password'];
        $confirmPassword = $_POST['confirm-password'];
        if (empty($oldPassword)){
            $error = "Input your old password";
        }
        else if (empty($newPassword)){
            $error = "Input your new password";
        }
        else if (empty($confirmPassword)){
            $error = "Please confirm your password";
        }
        else if ($newPassword != $confirmPassword){
            $error = "Password does not match!";
        }
        else{
            // echo "good";
            $id = $_GET['id'];
            $passwordHashed = password_hash($newPassword,PASSWORD_DEFAULT);
            require_once 'connection.php';
            $sql = "SELECT *  FROM `account` WHERE `id` = ?";
            $stm = $dbCon->prepare($sql);
            $stm->execute(array($id));
            if ($stm->rowCount() == 1){
                $dataUser = $stm->fetch(PDO::FETCH_ASSOC);
                if (!password_verify($oldPassword,$dataUser['password'])){
                    $error = "Old password not correct!";
                }
                else{
                    $sql = "UPDATE `account` SET `password` = ?, `activated` = b'1' WHERE `account`.`id` = ?";
                    $stm = $dbCon->prepare($sql);
                    $stm->execute(array($passwordHashed,$id));
                    if ($stm->rowCount() == 0){
                        $error = "Lỗi";
                    }
                    else{
                        header("Location: notification.php");
                    }

                }
            }
        }
    }
?>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 border rounded my-5 p-4  mx-3">
                <p class="mb-5"><a href="index.php">Quay lại</a></p>
                <h3 class="text-center text-secondary mt-2 mb-3 mb-3">Cập nhật mật khẩu</h3>
                <form method="post" action="" novalidate enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="name">Mật khẩu cũ</label>
                        <input value="<?= $oldPassword?>" name="old-password" required class="form-control" type="password"
                            placeholder="" id="old-password">
                    </div>
                    <div class="form-group">
                        <label for="price">Mật khẩu mới</label>
                        <input value="<?= $newPassword?>" name="new-password" required class="form-control" type="password"
                            placeholder="" id="new-password">
                    </div>

                    <div class="form-group">
                        <label for="price">Xác nhận mật khẩu</label>
                        <input value="<?= $confirmPassword?>" name="confirm-password" required class="form-control" type="password"
                            placeholder="" id="confirm-password">
                    </div>
                    
                    <div class="form-group">
                        <?php
                            if (!empty($error)) {
                                echo "<div class='alert alert-danger'>$error</div>";
                            }
                        ?>
                        <button type="submit" class="btn btn-primary px-5 mr-2">Thêm</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</body>

</html>