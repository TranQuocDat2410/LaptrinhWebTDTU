

<?php require_once 'heading.php' ?>

<?php
    // $name = "Trần quốc Đạt";
    // $type = "Nhân viên";
    session_start();
    if (!isset($_SESSION['id'])){
        header('Location: login.php');
        die();
    }else{
        // $name = $_SESSION['name'];
        // $type = $_SESSION['type'];
        // $avatar = $_SESSION['avatar'];
        $id = $_SESSION['id'];
        require_once 'connection.php';
        $sql = "SELECT * FROM `account` WHERE id=? ";
        $stm = $dbCon->prepare($sql);
        $stm->execute(array($id));
        if ($stm->rowCount()==1){
            $row = $stm->fetch(PDO::FETCH_ASSOC);
            $name = $row['name'];
            $type = $row['chucvu'];
            $avatar = $row['avatar']; 
        }
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
                    <a href="index.php">
                        <li class=" mb-1 border list-group-item d-flex justify-content-between align-items-center ">Tasks 
                            <span class="bg-success badge bg-primary rounded-pill">1</span>
                        </li>
                    </a>
                    <a href="index.php?filter=new">
                        <li class="mb-1 border list-group-item d-flex justify-content-between align-items-center ">New
                                <span class="bg-success badge bg-primary rounded-pill">1</span>
                        </li>
                    </a>
                    <a href="index.php?filter=progress">
                        <li class="mb-1 border list-group-item d-flex justify-content-between align-items-center ">In progress <span class="bg-success badge bg-primary rounded-pill">1</span>
                        </li>
                    </a>  
                    <a href="index.php?filter=canceled">
                        <li class="mb-1 border list-group-item d-flex justify-content-between align-items-center ">Canceled
                            <span class="bg-success badge bg-primary rounded-pill">1</span>
                        </li>
                    </a>
                    <a href="index.php?filter=waiting">
                        <li class="mb-1 border list-group-item d-flex justify-content-between align-items-center ">Waiting
                            <span class="bg-success badge bg-primary rounded-pill">1</span>
                        </li>
                    </a>
                    <a href="index.php?filter=reject">
                        <li class="mb-1 border list-group-item d-flex justify-content-between align-items-center ">Rejected
                            <span class="bg-success badge bg-primary rounded-pill">1</span>
                        </li>
                    </a>
                    <a href="index.php?filter=completed">
                        <li class="mb-1 border list-group-item d-flex justify-content-between align-items-center ">Completed
                            <span class="bg-success badge bg-primary rounded-pill">1</span>
                        </li>
                    </a>
                </ul>
            </div>

            
            <div class="col-12 col-lg-9 tasks-list">

                <?php
                    require 'function.php';
                    if (isset($_GET['review_task'])){
                        $reviewtask = getReviewTask($name);
                        foreach ($reviewtask as $row){
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
                    }
                    else{
                        $taskfilter = (isset($_GET['filter']))? $_GET['filter'] : "";
                        switch ($taskfilter){
                            case "new":
                                renderTask($name,"New");
                                break;
                            case "progress":
                                renderTask($name,"In progress");
                                break;
                            case "canceled":
                                renderTask($name,"Canceled");
                                break;
                            case "waiting":
                                renderTask($name,"Waiting");
                                break;
                            case "reject":
                                renderTask($name,"Reject");
                                break;
                            case "completed":
                                renderTask($name,"Completed");
                                break;
                            default:
                                getTaskList($name);
                                break;
                            
                        }
                    }

                    
                    
                    // echo $taskfilter;
                    
                ?>

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