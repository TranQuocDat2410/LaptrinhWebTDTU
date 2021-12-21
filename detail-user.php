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
    <link rel="stylesheet" href="detail_user.css">
</head>

<body>
    <?php
        $id = isset($_GET['id']) ? $_GET['id'] : "";
        if (!empty($id)){
            require_once 'connection.php';
            $sql = "SELECT * FROM `account` WHERE `id` = ?";
            $stm = $dbCon->prepare($sql);
            try{
                $stm->execute(array($id));
                $row = $stm->fetch(PDO::FETCH_ASSOC);

            }
            catch(Exception $e){
                echo $e->getMessage();
            }
        }
        

    ?>
    <div class="container">
        <div class="main-body">
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="img/<?=$row['avatar']?>" alt="Admin"
                                    class="rounded-circle" width="150">
                                <div class="mt-3">
                                    <h4><?= $row['name'] ?></h4>
                                    <p class="text-secondary mb-1"><?=$row['chucvu']?></p>
                                    <p class="text-muted font-size-sm"><?= $row['phongban'] ?></p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?= $row['email'] ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Phone</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    (239) 816-9029
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Địa chỉ</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?= $row['diachi'] ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Ngày sinh</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?= date("d/m/Y",strtotime($row['birthday'])) ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row ">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Lương</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?= $row['salary'] ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row justify-content-end">
                                <div class=" col-3 mr-2 d-flex justify-content-end px-1">
                                    <a class="btn btn-info text-right" target="__blank"
                                        href="https://www.bootdey.com/snippets/view/profile-edit-data-and-skills">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>