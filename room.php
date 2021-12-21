
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


    <script>
        $(document).ready(function () {
            $(".delete").click(function () {

                $('#myModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            });
        });
    </script>


    <table cellpadding="10" cellspacing="10" border="0" style="border-collapse: collapse; margin: auto">
    <tr class="control" style="text-align: center; font-weight: bold; font-size: 30px">
            <td colspan="4">
                DANH SÁCH PHÒNG BAN
            </td>
        </tr>
        <tr class="control" style="text-align: left; font-weight: bold; font-size: 20px">
            <td colspan="4">
                <a href="add_room.php">Thêm thông tin phòng</a>
            </td>
            <td class="text-right">
                <a href="index.html">Trở lại</a>
            </td>
        </tr>
        <tr class="header">
            <td>STT</td>
            <td>Tên Phòng</td>
            <td>ID Trưởng phòng</td>
            <td>Số phòng</td>
            <td>Mô tả</td>
        </tr>
        
            <?php
                
                require_once 'Connection.php';
                $sql = 'SELECT * FROM `phongban`';
                $stm = $dbCon->prepare($sql);
                $stm->execute();
                while($room = $stm->fetch(PDO::FETCH_ASSOC)){
                    echo '<tr class="item" id="'.$room['idphong'].'">';
                    echo "<td> ".$room['idphong']."</td>";
                    echo "<td> ".$room['tenphong']."</td>";
                    echo "<td>".$room['idtruongphong']." </td>";
                    echo "<td>".$room['sophong']." </td>";
                    echo "<td>".$room['mota']." </td>";
                    echo'<td><button class="btn btn-secondary btn-sm "><a class="text-light" href="http://localhost/DoAnCuoiKy/edit_room.php?id='.$room['idphong'].'&name='.$room['tenphong'].'&leader='.$room['idtruongphong'].'&number='.$room['sophong'].'&desc='.$room['mota'].'" >Edit</a> </button></td>';
                    echo'<td><button class="btn btn-danger btn-sm remove">Delete</button></td>';
                    echo '</tr>  ';
                }
                
            ?>
        <tr class="control" style="text-align: right; font-weight: bold; font-size: 17px">
            <td colspan="5">
                <?php
                    $sql = 'SELECT COUNT(idphong) as count FROM `phongban`';
                    $stm = $dbCon->prepare($sql);
                    $stm->execute();
                    $total = $stm->fetch(PDO::FETCH_ASSOC);
                ?>
                <p>Số lượng phòng: <?= $total['count'] ?></p>
            </td>
        </tr>
    </table>


    <!-- Delete Confirm Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <hp class="modal-title">Xóa phòng</hp>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="delete_room.php" method="POST">
                    <div class="modal-body">
                        <p>Bạn có chắc rằng muốn xóa phòng này ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" ><a href="http://localhost/DoAnCuoiKy/delete_room.php" >Xoa</a></button>
                    </div>
                </form>
                

            </div>

        </div>
    </div>


</body>
<script type="text/javascript">
    $(".remove").click(function(){
        var id = $(this).parents("tr").attr("id");


        if(confirm('Are you sure to remove this record ?'))
        {
            $.ajax({
               url: 'delete_room.php',
               type: 'GET',
               data: {id: id},
               error: function() {
                  alert('Something is wrong');
               },
               success: function(data) {
                    $("#"+id).remove();
                    alert("Record removed successfully");  
               }
            });
        }
    });


</script>
</html>