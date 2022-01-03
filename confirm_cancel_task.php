<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Cancle Task</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <?php
        require 'function.php';
        if(isset($_GET['true'])){
            setStatusTask($_GET['id'],"Canceled");
            header("Location: index.php");
        }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mt-5 mx-auto p-3 border rounded">
                <h4 class="mb-5">Bạn có chắc muốn hủy công việc <?= getTaskNameById($_GET['id']) ?>?</h4>
                <a href="confirm_cancel_task.php?id=<?=$_GET['id']?>&true" class="btn btn-danger mr-3">Hủy</a>
                <a href="index.php" class="btn btn-success">Quay lại</a>
            </div>
        </div>
    </div>
</body>

</html>