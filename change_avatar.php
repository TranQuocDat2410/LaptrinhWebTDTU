<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Thêm sản phẩm mới</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        .bg {
            background: #eceb7b;
        }
    </style>
</head>
<body>
<?php
    $avatar = isset($_FILES['avatar'])? $_FILES['avatar']:"";
    if(isset($_FILES['avatar'])){
        // echo "good";
        $id = isset($_GET['id'])? $_GET['id'] : "";
        $errors= array();
        $file_name = $_FILES['avatar']['name'];
        $file_size =$_FILES['avatar']['size'];
        $file_tmp =$_FILES['avatar']['tmp_name'];
        $file_type=$_FILES['avatar']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['avatar']['name'])));
        $extensions= array("jpeg","jpg","png");
        if(in_array($file_ext,$extensions)=== false){
            $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }
        if(empty($errors)==true){
            move_uploaded_file($file_tmp,"img/".$file_name);
            require_once 'connection.php';
            $sql = "UPDATE `account` SET `avatar` = ? WHERE `account`.`id` = ?";
            $stm = $dbCon->prepare($sql);
            // echo "Success";
            try{
                
                $stm->execute(array($file_name,$id));
                header("Location: notification.php");

            }
            catch(Exception $e){
                $error = "Lỗi";
            }
            

         }else{
            print_r($errors);
         }
    }
    
?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 border rounded my-5 p-4  mx-3">
                <p class="mb-5"><a href="index.php">Quay lại</a></p>
                <h3 class="text-center text-secondary mt-2 mb-3 mb-3">Đổi Avatar</h3>
                <form method="post" novalidate enctype="multipart/form-data">
            
                    <div class="form-group mb-3 custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="avatar">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                   
                    <div class="form-group">
                        <?php
                            if (!empty($error)) {
                                echo "<div class='alert alert-danger'>$error</div>";
                            }
                        ?>
                        <button type="submit" class="btn btn-primary px-5 mr-2">Đổi</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
</body>
</html>

