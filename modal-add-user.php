<div id="add_user_modal_form" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm nhân viên</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Tên nhân viên</label>
                    <input name="name" required class="form-control" type="text" placeholder="Name" id="name">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input name="username" required class="form-control" type="text" placeholder="Username"
                        id="username">
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ</label>
                    <input name="address" required class="form-control" type="text" placeholder="Địa chỉ" id="address">
                </div>
                <div class="form-group">
                    <label for="birthday">Ngày sinh</label>
                    <input name="birthday" required class="form-control" type="date" placeholder="birthday"
                        id="birthday">
                </div>
                <div class="form-group form-inline">
                    <!-- <p>Giới tính</p> -->
                    <span class="mr-3">Giới tính </span>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="male" value="Nam">
                        <label class="form-check-label" for="inlineRadio1">Nam</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="female" value="Nữ">
                        <label class="form-check-label" for="inlineRadio2">Nữ</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="list_room">Phòng ban</label>
                    <select class="form-control" id="list_room">
                        <option>Kế toán</option>
                        <option>Kỹ thuật</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="salary">Lương</label>
                    <input name="salary" required class="form-control" type="number" placeholder="Lương" id="salary">
                </div>
                <div class="form-group">
                    <label for="avatar">Avatar</label>
                    <input type="file" class="form-control-file" id="avatar" name="avatar">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn-add-user btn btn-danger">Thêm</button>
            </div>
        </div>
    </div>
</div>