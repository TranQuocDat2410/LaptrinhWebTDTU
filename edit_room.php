<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Thêm thông tin phòng mới</title>
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

    $error = '';
    $id='';
    $name = '';
    $number = '';
    $leader = '';
    $desc = '';

    // if (isset($_GET['id']))
    // {
    //     $id = $_GET['id'];
    // }
    $id = (isset($_GET['id']))? $_GET['id'] : "";
    $sql = "SELECT * FROM `room` WHERE id=?";
    require_once 'connection.php';
    $stm = $dbCon->prepare($sql);
    $stm->execute(array($id));
    $selectedItem = $stm->fetch(PDO::FETCH_ASSOC);


    if (isset($_POST['id']) && isset($_POST['tenphong']) && isset($_POST['leader'])&& isset($_POST['num_room']) && isset($_POST['mota']))
    {
        $id = $_POST['id'];
        $name = $_POST['tenphong'];
        $number = $_POST['num_room'];
        $leader = $_POST['leader'];
        $desc = $_POST['mota'];

        if (empty($name)) {
            $error = 'Hãy nhập tên phòng';
        }
        else if (empty($leader)) {
            $error = 'Hãy nhập trưởng Phòng';
        }
        else if (empty($number)) {
            $error = 'Hãy nhập số phòng';
        }
        else if (empty($desc)) {
            $error = 'Hãy nhập mô tả của phòng';
        }
        
        else {
            require_once 'Connection.php';
           
            $sql = "UPDATE `room` SET `name` = ?, `leader` = ?, `num_room` = ?, `description` = ? WHERE `room`.`id` = ?";
            $stm = $dbCon->prepare($sql);
            try{
                $stm->execute(array($name,$leader,$number,$desc,$id));
                require_once 'function.php';
                // changeLeader($selectedItem['name'],$leader);
                // header("Location: notification.php");
            }
            catch(Exception $e){
                echo $e->getMessage();
            }
            $sql = "UPDATE `account` SET `chucvu` = 'Trưởng phòng' WHERE `account`.`name` = ?";
            $stm = $dbCon->prepare($sql);
            try{
                $stm->execute(array($leader));
                // header("Location: notification.php");
            }
            catch(Exception $e){
                echo $e->getMessage();
            }

            $sql = "UPDATE `account` SET `chucvu` = 'Nhân viên' WHERE `account`.`name` = ?";
            $stm = $dbCon->prepare($sql);
            try{
                $stm->execute(array($selectedItem['leader']));
                header("Location: notification.php");
            }
            catch(Exception $e){
                echo $e->getMessage();
            }
            
            // echo "<script type='text/javascript'>
            // $(document).ready(function(){
            // $('#exampleModal').modal('show');
            // });
            // </script>";

        }
    }
?>
 <!-- Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            Cập nhật thành công phòng thành công. 
        </div>
        <div class="modal-footer">
           
            <button type="button" class="btn btn-light"> <a href="room.php">Quay lại</a></button>
        </div>
        </div>
    </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 border rounded my-5 p-4  mx-3">
                <p class="mb-5"><a href="room.php">Quay lại</a></p>
                <h3 class="text-center text-secondary mt-2 mb-3 mb-3">Chỉnh sửa thông tin phòng mới</h3>
                <form method="post" action="" novalidate enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="id">ID </label>
                        <input  readonly value="<?= $id?>" name="id" required class="form-control" type="number" placeholder="ID" id="id">
                    </div>
                    <div class="form-group">
                        <label for="name">Tên phòng</label>
                        <input value="<?= $selectedItem['name']?>" name="tenphong" required class="form-control" type="text" placeholder="Tên phòng" id="name">
                    </div>
                    <div class="form-group">
                        <label for="leader">Trưởng phòng</label>
                        <!-- <input value="" name="idtruongphong" required class="form-control" type="text" placeholder="" id="price"> -->
                        <select name="leader" id="leader"class="form-control">
                            <option><?= $selectedItem['leader'] ?></option>
                            <?php
                                $sql = 'SELECT name FROM `account` WHERE chucvu = "Nhân viên"';
                                $stm = $dbCon->prepare($sql);
                                $stm->execute();
                                while($employee = $stm->fetch(PDO::FETCH_ASSOC)){
                                    echo '<option>'.$employee['name'].'</option>';
                                }
                            ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="num_room">Số phòng</label>
                        <input value="<?= $selectedItem['num_room']?>" name="num_room" required class="form-control" type="number" placeholder="Số phòng" id="num_room">
                    </div>
                    <div class="form-group">
                        <label for="desc">Mô tả</label>
                        <textarea id="desc" name="mota" rows="4" class="form-control" placeholder="Mô tả"><?= $selectedItem['description'] ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <?php
                            if (!empty($error)) {
                                echo "<div class='alert alert-danger'>$error</div>";
                            }
                        ?>
                        <button type="submit" class="btn btn-primary px-5 mr-2">Cập Nhật</button>
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

