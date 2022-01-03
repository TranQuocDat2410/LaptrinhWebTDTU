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
<body style="background-color: aquamarine">
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
            min-width: 100px;
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
    <p style="text-align: center; font-weight: bold; font-size: 30px" >Danh Sách Các Đơn</p>
   <table style="background-color: white" cellpadding="10" cellspacing="10" border="0" style="border-collapse: collapse; margin: auto">
        <tr class="header">
            <td>ID</td>
            <td>Họ và Tên</td>
            <td>Chức vụ</td>
            <td>Giới tính</td>
            <td>Phòng bạn</td>
            <td>ID_Form</td>
            <td>Ngày Nghỉ</td>
            <td>Số ngày</td>
            <td>Lí do</td>
            <td></td>
        </tr>
    <?php
        if($type=="Giám đốc"){
            require_once 'connection.php';
            $sql = "SELECT account.id,account.name,account.gender,account.chucvu,account.phongban,nghiphep.ID_Form,nghiphep.Date,nghiphep.End_day,nghiphep.Reason FROM `account`,`nghiphep` WHERE nghiphep.ID=account.ID and account.chucvu=? and nghiphep.Status=? ORDER BY nghiphep.ID_Form DESC;";
            $stm = $dbCon->prepare($sql);
            $stm->execute(array("Trưởng phòng","Waiting"));
            if ($stm->rowCount()>0){
                while ($nghiphep = $stm->fetch(PDO::FETCH_ASSOC)){
                    $id_nv=$nghiphep['id'];
                    $name_nv=$nghiphep['name'];
                    $chucvu_nv=$nghiphep['chucvu'];
                    $gioitinh_nv=$nghiphep['gender'];
                    $phongban_nv=$nghiphep['phongban'];
                    $id_form=$nghiphep['ID_Form'];
                    $reason=$nghiphep['Reason'];
                    $date=$nghiphep['Date'];
                    $date1=date_create($nghiphep['Date']);
                    $date2=date_create($nghiphep['End_day']);
                    $total=date_diff($date1,$date2)->format('%a');
                    $_SESSION['id_form'] = $id_form;
                    echo'<tr class="item">';
                    echo'<td>'.$id_nv.'</td>';
                    echo'<td>'.$name_nv.'</td>';
                    echo'<td>'.$chucvu_nv.'</td>';
                    echo' <td>'.$gioitinh_nv.'</td>';
                    echo' <td>'.$phongban_nv.'</td>';
                    echo' <td>'. $id_form.'</td>';
                    echo' <td>'.$date.'</td>';
                    echo' <td>'.$total.'</td>';
                    echo' <td>'.$reason.'</td>';
                    echo '<td><button type="button" class="btn btn-light"> <a href="duyetdon_chitiet.php?id='.$id_nv.'&id_form='.$id_form.'">Chi tiết</a></button></td>';
                    echo' </tr>';
                }
                
            }
            else{
                echo"lỗi";
            }
        }
        else if ($type=="Trưởng phòng"){
            require_once 'connection.php';
            $sql = "SELECT account.id,account.name,account.gender,account.chucvu,account.phongban,nghiphep.ID_Form,nghiphep.Date,nghiphep.End_day,nghiphep.Reason FROM `account`,`nghiphep` WHERE nghiphep.ID=account.ID and account.chucvu=? and nghiphep.Status=? ORDER BY nghiphep.ID_Form DESC;";
            $stm = $dbCon->prepare($sql);
            $stm->execute(array("Nhân viên","Waiting"));
            if ($stm->rowCount()>0){
                while ($nghiphep = $stm->fetch(PDO::FETCH_ASSOC)){
                    $id_nv=$nghiphep['id'];
                    $name_nv=$nghiphep['name'];
                    $chucvu_nv=$nghiphep['chucvu'];
                    $gioitinh_nv=$nghiphep['gender'];
                    $phongban_nv=$nghiphep['phongban'];
                    $id_form=$nghiphep['ID_Form'];
                    $reason=$nghiphep['Reason'];
                    $date=$nghiphep['Date'];
                    $date1=date_create($nghiphep['Date']);
                    $date2=date_create($nghiphep['End_day']);
                    $total=date_diff($date1,$date2)->format('%a');
                    $_SESSION['id_form'] = $id_form;
                    echo'<tr class="item">';
                    echo'<td>'.$id_nv.'</td>';
                    echo'<td>'.$name_nv.'</td>';
                    echo'<td>'.$chucvu_nv.'</td>';
                    echo' <td>'.$gioitinh_nv.'</td>';
                    echo' <td>'.$phongban_nv.'</td>';
                    echo' <td>'. $id_form.'</td>';
                    echo' <td>'.$date.'</td>';
                    echo' <td>'.$total.'</td>';
                    echo' <td>'.$reason.'</td>';
                    echo '<td><button type="button" class="btn btn-light"> <a href="duyetdon_chitiet.php?id='.$id_nv.'&id_form='.$id_form.'">Chi tiết</a></button></td>';
                    echo' </tr>';
                }
                
            }
            else{
                echo"lỗi";
            }
        }
        
    
    ?>
    </table>
    <div style="margin-top: 20px" class="d-flex justify-content-center">
        <a class="btn btn-primary mr-auto " style="color:white; text-decoration: none" href="lichsu_don.php?id=<?=$_SESSION['id']?>">Xem lịch sử đơn nghỉ phép</a>
        <a href="index.php" class="btn btn-danger mr-auto">Quay lại</a>
    </div>
</body>
</html>