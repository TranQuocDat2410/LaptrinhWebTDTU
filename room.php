
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trang chủ - Danh sách phòng ban</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body id="list-room">

<?php
    session_start();
        if (!isset($_SESSION['id']))
        {
            header('Location: index.php');
            die();
        }
        else
        {
            $id = $_SESSION['id'];
            require_once 'connection.php';
            $sql = "SELECT * FROM `account` WHERE id=? ";
            $stm = $dbCon->prepare($sql);
            $stm->execute(array($id));
            if ($stm->rowCount()==1){
                $row = $stm->fetch(PDO::FETCH_ASSOC);
                $type = $row['chucvu'];
                
            }
            if($type=="Nhân viên"){
                header('Location: index.php');
                 die();
            }
        }
?>
    <h2 class="font-weight-bold text-center pt-3" >DANH SÁCH PHÒNG BAN</h2>
    <div class="container pt-3">
        <div>
            <p class="pl-3 pr-3 font-weight-bold text-primary" ><a href="add_room.php">Thêm thông tin phòng</a></p>
            <p class="pb-3 pl-3 pr-3 font-weight-bold text-primary"><a href="index.php">Trở lại</a></p>
        </div>
 
    <table cellpadding="10" cellspacing="10" border="10"  class="table-bordered table-hover m-auto">
        <tr class="header font-weight-bold text-center bg-primary text-light">
            <td>STT</td>
            <td>Tên Phòng</td>
            <td>Trưởng phòng</td>
            <td>Số phòng</td>
            <td>Mô tả</td>
            <td>Chi tiết</td>
        </tr>
        
            <?php
                require_once 'connection.php';
                $sql = 'SELECT * FROM `room`';
                $stm = $dbCon->prepare($sql);
                $stm->execute();
                while($room = $stm->fetch(PDO::FETCH_ASSOC)){
                    echo '<tr class="item" id="'.$room['id'].'">';
                    echo "<td> ".$room['id']."</td>";
                    echo "<td> ".$room['name']."</td>";
                    echo "<td>".$room['leader']." </td>";
                    echo "<td>".$room['num_room']." </td>";
                    echo "<td>".$room['description']." </td>";
                    echo'<td><button class="btn btn-secondary btn-sm "><a class="text-light" href="view_room.php?id='.$room['id'].'" >Chi tiết</a> </button></td>';
                    echo '</tr>  ';
                }
                
            ?>
       
        <tr class="control" style="text-align: right; font-weight: bold; font-size: 17px">
            <td colspan="6">
                <?php
                    $sql = 'SELECT COUNT(id) as count FROM `room`';
                    $stm = $dbCon->prepare($sql);
                    $stm->execute();
                    $total = $stm->fetch(PDO::FETCH_ASSOC);
                ?>
                <p>Số lượng phòng: <?= $total['count'] ?></p>
            </td>
        </tr>
    </table>
    </div>
 

</html>