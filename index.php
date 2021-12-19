

<?php require_once 'heading.php' ?>

<?php
    $name = "Trần quốc Đạt";
    $type = "Nhân viên";
    session_start();
    if (!isset($_SESSION['username'])){
        header('Location: login.php');
        die();
    }else{
        $name = $_SESSION['name'];
        $type = $_SESSION['type'];
        $avatar = $_SESSION['avatar'];
    }
    
?>

<body>
    <div class="bg-success container header mt-3 py-3 ps-4">
        <div class="row">
            <div class="col-5 col-xs-5 col-sm-4 col-lg-3">
                <img src="img/<?=$avatar?>" class="avata-header" alt="">
            </div>
            <div class="col-12 col-xs-7 col-sm-6 col-lg-3">
                <div class="header-profile fs-4 p-0">
                    <a href="detail-user.html" class="header-profile-name">
                        <p class="m-0"><?=$name?></p>
                    </a>
                    <p class="header-profile-type m-0"><?= $type ?></p>
                </div>
                <a href="logout.php" class="me-auto btn-logout btn btn-danger mt-3">Log Out</a>
                <!-- <div class="dropdown">
                    <button class="btn btn-danger dropdown-toggle mt-3" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                        Chức năng
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class=" add-user-function dropdown-item" href="#" >Thêm nhân viên</a>
                        <a class="dropdown-item" href="list-user.php">Xem danh sách nhân viên</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div> -->
                <!-- <button type ="button" class="me-auto btn-logout btn btn-danger mt-3">Chức năng</button> -->
                <?php require_once 'privilage.php';?>
            </div>
        </div>
    </div>

    <div class="container mt-3 p-0">
        <div class="row">
            <div class="col-12 col-lg-3">
                <ul class=" list-group status-task">
                    <li class=" mb-1 border list-group-item d-flex justify-content-between align-items-center ">Tasks
                        <span class="bg-success badge bg-primary rounded-pill">1</span>
                    </li>
                    <li class="mb-1 border list-group-item d-flex justify-content-between align-items-center ">New
                        <span class="bg-success badge bg-primary rounded-pill">1</span>
                    </li>
                    <li class="mb-1 border list-group-item d-flex justify-content-between align-items-center ">In
                        progress
                        <span class="bg-success badge bg-primary rounded-pill">1</span>
                    </li>
                    <li class="mb-1 border list-group-item d-flex justify-content-between align-items-center ">Cancled
                        <span class="bg-success badge bg-primary rounded-pill">1</span>
                    </li>
                    <li class="mb-1 border list-group-item d-flex justify-content-between align-items-center ">Waiting
                        <span class="bg-success badge bg-primary rounded-pill">1</span>
                    </li>
                    <li class="mb-1 border list-group-item d-flex justify-content-between align-items-center ">Rejected
                        <span class="bg-success badge bg-primary rounded-pill">1</span>
                    </li>
                    <li class="mb-1 border list-group-item d-flex justify-content-between align-items-center ">Completed
                        <span class="bg-success badge bg-primary rounded-pill">1</span>
                    </li>
                </ul>
            </div>

            
            <div class="col-12 col-lg-9 tasks-list">
                <?php
                    require_once 'connection.php';
                    $sql = 'SELECT * FROM `tasks`';
                    $stm = $dbCon->prepare($sql);
                    $stm->execute();
                    // print_r($stm->rowCount());
                    while ($row = $stm->fetch(PDO::FETCH_ASSOC)){
                        // print_r($row) ;
                        ?>
                            <div class="col-12 border py-3 px-5 fs-5 mb-3 task-item">
                                <div class="row text-center">
                                    <div class="col-4">
                                        <p class="task-name fw-bold"><?= $row['name'] ?></p>
                                    </div>
                                    <div class="col-4">
                                        <p class="tasks-status"><?= $row['status'] ?></p>
                                    </div>
                                    <div class="col-4">
                                        <p class="task-deadline text-end"><?= date("d/m/Y",strtotime($row['deadline'])) ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                ?>
                <div class="col-12 border py-3 px-5 fs-5 mb-3 task-item">
                    <div class="row text-center">
                        <div class="col-4">
                            <p class="task-name fw-bold">Tên công việc</p>
                        </div>
                        <div class="col-4">
                            <p class="tasks-status">In progress</p>
                        </div>
                        <div class="col-4">
                            <p class="task-deadline text-end">30/12/2021</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 border py-3 px-5 fs-5 mb-3 task-item">
                    <div class="row text-center">
                        <div class="col-4">
                            <p class="task-name fw-bold">Tên công việc</p>
                        </div>
                        <div class="col-4">
                            <p class="tasks-status">In progress</p>
                        </div>
                        <div class="col-4">
                            <p class="task-deadline text-end">30/12/2021</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 border py-3 px-5 fs-5 mb-3 task-item">
                    <div class="row text-center">
                        <div class="col-4">
                            <p class="task-name fw-bold">Gặp gỡ khách hàng X</p>
                        </div>
                        <div class="col-4">
                            <p class="tasks-status">In progress</p>
                        </div>
                        <div class="col-4">
                            <p class="task-deadline text-end">30/12/2021</p>
                        </div>
                    </div>
                </div>

                

               
            </div>
        </div>
    </div>

    

<?php require_once 'modal-add-user.php' ?>


    <div id="modal-notification-status" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thông báo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="status"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="main.js"></script>
</body>

</html>