<?php
    // session_start();
    // $type = $_SESSION['type'];

?>

<?php
    if ($type == "Giám đốc"){
        ?>
            <div class="dropdown">
                <button class="btn btn-danger dropdown-toggle mt-3" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                    Chức năng
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class=" add-user-function dropdown-item" href="add-user-form.php" >Thêm nhân viên</a>
                    <a class="dropdown-item" href="list-user.php">Xem danh sách nhân viên</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </div>        
        <?php 
    }
    else{
        ?>  
            <div class="dropdown">
                <button class="btn btn-danger dropdown-toggle mt-3" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                    Chức năng
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <!-- <a class=" add-user-function dropdown-item" href="#" >Thêm nhân viên</a> -->
                    <!-- <a class="dropdown-item" href="list-user.php">Xem danh sách nhân viên</a> -->
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </div>            
        <?php
    }
?>

