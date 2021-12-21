

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
        $id = $_SESSION['id'];
    }
    
?>

<body>
    
    <div class=" container media bg-success">
        <div class="media-left mr-3 py-3">
            <img src="./img/<?= $avatar ?>" class="media-object" style="width:150px; height: 150px">
        </div>
        <div class="media-body py-3">
            <h4><a href="detail-user.php?id=<?=$id?>" class="media-heading"><?=$name?></a></h4>
            <p><?=$type?></p>
            <a href="logout.php" class="me-auto btn-logout btn btn-danger">Log Out</a>
            <?php require_once 'privilage.php';?>
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
                            <a href="detail_task.php?id=<?=$row['id']?>" class="">
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
                            </a>       
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