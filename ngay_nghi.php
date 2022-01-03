
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
        function get_day($type){
            if($type=="Nhân viên"){
                return 12;
            }
            else if($type=="Trưởng phòng"){
                return 15;
            }
        }
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
                $name = $row['name'];
                $type = $row['chucvu'];
                $room=$row['phongban'];
                $total=$row['ngaynghi'];
                $day=get_day($type)-$row['ngaynghi'];
            }
            $_SESSION['id'] = $id;
        }
        
        function get_Ngaynghi($total,$date,$name)
        {
            $today = date("Y-m-d"); 
            $nextday=date('Y-m-d', strtotime($date. ' + 7 days'));
            if($total<7){
                if($today>=$nextday){
                    echo'<button type="button" class="btn btn-light"> <a href="nop_don.php?id='.$_SESSION['id'].'">Nộp đơn</a></button>';
                }
                else{
                     echo'<p>'.$name.', bạn đã nộp đơn ngày '.$date.', hãy quay lại vào ngày ' .$nextday.'</p>';
                }
    
            }
            else{
                echo'<p>Bạn đã nghỉ đủ số buổi quy định</p>';
            }
        }
    ?>
    <p style="text-align: center; font-weight: bold; font-size: 30px" >NỘP ĐƠN TRỰC TUYẾN</p>
    <div>
        <p>Xin chào :<?=$name?></p>
        <p>Phòng :<?=$room?></p>
        <p>Bạn đã nghỉ <?=$total?> ngày</p>
        <p>Bạn có thể nghỉ <?=$day?> ngày</p>
    </div>
    <?php
        
        require_once 'connection.php';
        $sql = "SELECT * FROM `nghiphep` WHERE ID=? ORDER BY Date DESC LIMIT 1";
        $stm = $dbCon->prepare($sql);
        $stm->execute(array($id));
        if ($stm->rowCount()==1){
             $nghiphep = $stm->fetch(PDO::FETCH_ASSOC);
             $id_form=$nghiphep['ID_Form'];
             $status=$nghiphep['Status'];
             $reason=$nghiphep['Reason'];
             $date=$nghiphep['Date'];
             $_SESSION['id_form'] = $id_form;
            if ($status=="Waiting"){
                echo'<table cellpadding="10" cellspacing="10" border="0" style="border-collapse: collapse; margin: auto">';
                echo'<tr class="header">';
                echo'<td>ID</td>';
                echo'<td>Họ và Tên</td>';
                echo'<td>Chức vụ</td>';
                echo'<td>Phòng bạn</td>';
                echo'<td>Ngày Nghỉ</td>';
                echo'<td>Lí do</td>';
                echo'<td>Trạng thái</td>';
                echo'<td></td>';
                echo'</tr>';
                echo'<tr class="item">';
                echo'<td>'.$id.'</td>';
                echo'<td>'.$name.'</td>';
                echo'<td>'.$type.'</td>';
                echo' <td>'.$room.'</td>';
                echo' <td>'.$date.'</td>';
                echo' <td>'.$reason.'</td>';
                echo' <td>'.$status.'</td>';
                echo '<td><button type="button" class="btn btn-light"> <a href="chitiet_don.php?id='.$_SESSION['id'].'&id_form='.$_SESSION['id_form'].'">Chi tiết</a></button></td>';
                echo' </tr>';
                echo'</table>';
            }
            else if ($status=="Approved"){
                echo "<script type='text/javascript'>
                $(document).ready(function(){
                $('#succedModal').modal('show');
                });
                </script>";
                echo'<table cellpadding="10" cellspacing="10" border="0" style="border-collapse: collapse; margin: auto">';
                echo'<tr class="header">';
                echo'<td>ID</td>';
                echo'<td>Họ và Tên</td>';
                echo'<td>Chức vụ</td>';
                echo'<td>Phòng bạn</td>';
                echo'<td>Ngày Nghỉ</td>';
                echo'<td>Lí do</td>';
                echo'<td>Trạng thái</td>';
                echo'</tr>';
                echo'<tr class="item">';
                echo'<td>'.$id.'</td>';
                echo'<td>'.$name.'</td>';
                echo'<td>'.$type.'</td>';
                echo' <td>'.$room.'</td>';
                echo' <td>'.$date.'</td>';
                echo' <td>'.$reason.'</td>';
                echo' <td>'.$status.'</td>';
                echo' </tr>';
                echo'</table>';
      
                get_Ngaynghi($total,date("Y-m-d"),$name);
            }
            else{
                echo "<script type='text/javascript'>
                $(document).ready(function(){
                $('#failModal').modal('show');
                });
                </script>";
                echo'<table cellpadding="10" cellspacing="10" border="0" style="border-collapse: collapse; margin: auto">';
                echo'<tr class="header">';
                echo'<td>ID</td>';
                echo'<td>Họ và Tên</td>';
                echo'<td>Chức vụ</td>';
                echo'<td>Phòng bạn</td>';
                echo'<td>Ngày Nghỉ</td>';
                echo'<td>Lí do</td>';
                echo'<td>Trạng thái</td>';
                echo'</tr>';
                echo'<tr class="item">';
                echo'<td>'.$id.'</td>';
                echo'<td>'.$name.'</td>';
                echo'<td>'.$type.'</td>';
                echo' <td>'.$room.'</td>';
                echo' <td>'.$date.'</td>';
                echo' <td>'.$reason.'</td>';
                echo' <td>'.$status.'</td>';
                echo' </tr>';
                echo'</table>';

                get_Ngaynghi($total,date("Y-m-d"),$name);
                           
            }
        }
        else{
            echo'<p> Nộp đơn tại đây</p>';
            echo'<button type="button" class="btn btn-light"> <a href="nop_don.php?id='.$_SESSION['id'].'">Nộp đơn</a></button>';
        }
    
    ?>
    <div>
        <button type="button" class="btn btn-light mt-1 "> <a href="lichsu_don.php?id=<?=$_SESSION['id']?>">Xem lịch sử đơn nghỉ phép</a></button>
        <button type="button" class="btn btn-light mt-1 "> <a href="index.php">Trở lại</a></button>
    </div>
  
    

    <!-- Succed Confirm Modal -->
    <div id="succedModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <hp class="modal-title">ĐƠN NGHỈ PHÉP</hp>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="delete_room.php" method="POST">
                    <div class="modal-body">
                        <p>Đơn của bạn đã được chấp thuận.</p>
                        <p>Trân trọng ./.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
                

            </div>

        </div>
    </div>
    <!-- Succed Confirm Modal -->
    <div id="failModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <hp class="modal-title">ĐƠN NGHỈ PHÉP</hp>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="delete_room.php" method="POST">
                    <div class="modal-body">
                        <p>Đơn của bạn không được chấp thuận vì một số lý do.</p>
                        <p>Trân trọng ./.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
                

            </div>

        </div>
    </div>


</body>
</html>