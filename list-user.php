<?php require_once 'heading.php' ?>

<body style="background-color: aquamarine" id="list-user">
    <div  class="container">
        <h1 class="text-center mt-5 mb-3 ">Danh sách nhân viên</h1>
        <table class="table table-striped table-hover bg-light">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Họ và tên</th>
                <th scope="col">Phòng ban</th>
                <th scope="col">Chức vụ</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Trần Quốc Đạt</td>
                <td>Kế toán</td>
                <td>Nhân viên</td>
                <td>
                    <button class="btn btn-success">View</button>
                    <button class="btn btn-danger">Edit</button>
                </td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Trần Quốc Đạt</td>
                <td>Kế toán</td>
                <td>Nhân viên</td>
                <td>
                    <button class="btn btn-success">View</button>
                    <button class="btn btn-danger">Edit</button>
                </td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>Trần Quốc Đạt</td>
                <td>Kế toán</td>
                <td>Nhân viên</td>
                <td>
                    <button class="btn btn-success">View</button>
                    <button class="btn btn-danger">Edit</button>
                </td>
              </tr>
              <tr>
            </tbody>
          </table>
    </div>
    <script src="main.js"></script>
</body>
</html>