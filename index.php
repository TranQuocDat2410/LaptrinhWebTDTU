

<?php require_once 'heading.php' ?>

<?php
    session_start();
    if (!isset($_SESSION['id'])){
        header('Location: login.php');
        die();
    }
    else{
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
        $_SESSION['id'] = $id;
    }
?>

<body style="background-color: aquamarine">
    <div class=" container media bg-success">
        <div class="mr-3 py-3">
            <img src="./img/<?=$avatar?>" class="media-object" style="width:150px; height: 170px; border-radius: 10px">
        </div>
        <div class="media-body py-3">
            <h3><a id="namenv" href="detail-user.php?id=<?=$id?>" class="media-heading" style="text-decoration: none "><?=$name?></a></h3>
            <h5 id="type"><?=$type?></h5>
            <a href="logout.php" class="btn btn-danger">Log Out</a>
            <?php require_once 'privilage.php';?>
        </div>
    </div>


    <div class="container mt-3 p-0">
        <div class="row">
            <div class="col-12 col-lg-3">
                <ul class=" list-group">
                    <a href="index.php">
                        <li class="st mb-1 border list-group-item d-flex justify-content-between align-items-center ">Tasks 
                            <span class="bg-success badge bg-primary rounded-pill">1</span>
                        </li>
                    </a>
                    <a href="index.php?filter=new">
                        <li class="st mb-1 border list-group-item d-flex justify-content-between align-items-center ">New
                                <span class="bg-success badge bg-primary rounded-pill">1</span>
                        </li>
                    </a>
                    <a href="index.php?filter=progress">
                        <li class="st mb-1 border list-group-item d-flex justify-content-between align-items-center ">In progress <span class="bg-success badge bg-primary rounded-pill">1</span>
                        </li>
                    </a>  
                    <a href="index.php?filter=canceled">
                        <li class="st mb-1 border list-group-item d-flex justify-content-between align-items-center ">Canceled
                            <span class="bg-success badge bg-primary rounded-pill">1</span>
                        </li>
                    </a>
                    <a href="index.php?filter=waiting">
                        <li class="st mb-1 border list-group-item d-flex justify-content-between align-items-center ">Waiting
                            <span class="bg-success badge bg-primary rounded-pill">1</span>
                        </li>
                    </a>
                    <a href="index.php?filter=reject">
                        <li class="st mb-1 border list-group-item d-flex justify-content-between align-items-center ">Rejected
                            <span class="bg-success badge bg-primary rounded-pill">1</span>
                        </li>
                    </a>
                    <a href="index.php?filter=completed">
                        <li class="st mb-1 border list-group-item d-flex justify-content-between align-items-center ">Completed
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
                                <a id="cv" style="text-decoration:none; color: black" href="detail_task.php?id=<?=$row['id']?>" class="">
                                    <div style="background-color: white;" class="col-12 border py-3 px-5 fs-5 mb-3">
                                        <div class="row text-center">
                                            <div class="col-4">
                                                <p class="fw-bold"><?= $row['name'] ?></p>
                                            </div>
                                            <div class="col-4">
                                                <p class=""><?= $row['status'] ?></p>
                                            </div>
                                            <div class="col-4">
                                                <p class="text-end"><?= date("d/m/Y",strtotime($row['deadline'])) ?></p>
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