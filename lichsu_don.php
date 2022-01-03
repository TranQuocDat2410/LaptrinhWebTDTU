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
<body>

    <style>
        body{
            padding-top: 50px;
        }
        table{
            width: 80%;
            text-align: center;
        }
        td{
            padding: 10px;
        }
        tr.item{
            border-top: 1px solid #5e5e5e;
            border-bottom: 1px solid #5e5e5e;
        }

        tr.item:hover{
            background-color: #d9edf7;
        }

        tr.item td{
            min-width: 150px;
        }

        tr.header{
            font-weight: bold;
        }

        a{
            text-decoration: none;
        }
        a:hover{
            color: deeppink;
            font-weight: bold;
        }

        td img {
            max-height: 100px;
        }
    </style>

    <?php
        session_start();
        if (!isset($_SESSION['id']))
        {
            header('Location: ngay_nghi.php');
            die();
        }
        else
        {
            $id = $_SESSION['id'];
            echo $id;
            require_once 'connection.php';
            $sql = "SELECT * FROM `account` WHERE id=? ";
            $stm = $dbCon->prepare($sql);
            $stm->execute(array($id));
            if ($stm->rowCount()==1){
                $row = $stm->fetch(PDO::FETCH_ASSOC);
                $name = $row['name'];
                $type = $row['chucvu'];
                $room=$row['phongban'];
                $total=$row['ngaynghi'];
            }
       }
    ?>
    <p style="text-align: center; font-weight: bold; font-size: 30px" >DANH SÁCH CÁC ĐƠN ĐÃ NỘP</p>
    <div>
        <p>Xin chào :<?=$name?></p>
        <p>Phòng :<?=$room?></p>
    </div>
   <table cellpadding="10" cellspacing="10" border="0" style="border-collapse: collapse; margin: auto">
        <tr class="header">
            <td>ID</td>
            <td>Họ và Tên</td>
            <td>Chức vụ</td>
            <td>Phòng bạn</td>
            <td>Ngày Nghỉ</td>
            <td>Lí do</td>
            <td>Trạng thái</td>
            <td></td>
        </tr>
    <?php
        require_once 'connection.php';
        $sql = "SELECT * FROM `nghiphep` WHERE ID=? ORDER BY Date DESC ";
        $stm = $dbCon->prepare($sql);
        $stm->execute(array($id));
        if ($stm->rowCount()>0){
             while ($nghiphep = $stm->fetch(PDO::FETCH_ASSOC)){
                $id_form=$nghiphep['ID_Form'];
                $status=$nghiphep['Status'];
                $reason=$nghiphep['Reason'];
                $date=$nghiphep['Date'];
                $_SESSION['id_form'] = $id_form;
                echo'<tr class="item">';
                echo'<td>'.$id.'</td>';
                echo'<td>'.$name.'</td>';
                echo'<td>'.$type.'</td>';
                echo' <td>'.$room.'</td>';
                echo' <td>'.$date.'</td>';
                echo' <td>'.$reason.'</td>';
                echo' <td>'.$status.'</td>';
                echo '<td><button type="button" class="btn btn-light"> <a href="chitiet_don.php?id='.$id.'&id_form='.$id_form.'">Chi tiết</a></button></td>';
                echo' </tr>';
            }
             
        }
        else{
            echo"lỗi";
        }
    
    ?>
    </table>
    <div>
        
        <button type="button" class="btn btn-light mt-1 "> <a href="ngay_nghi.php">Trở lại</a></button>
    </div>
  
    
</body>
</html>