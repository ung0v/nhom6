<?= $this->extend('_layout') ?>
<?= $this->section('content') ?>
<form method="POST" action="" class="user">

    <?php if ($message == "fail") : ?>
        <div class="alert alert-danger">
            <strong>Không thành công !</strong> Đã xảy ra lỗi!!!
            <?php if ($error) : ?>
                <?php foreach ($error as $item) : ?>
                    <li><?= $item ?></li>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <?php if (isset($student)) : ?>
        <div class="form-group">
            <input type="phone" class="form-control" name="studentCode" placeholder="Mã sinh viên" value="<?= $student['studentCode'] ?>">
        </div>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" class="form-control form-control-user" name="fullname" id="fullname" placeholder="Họ và tên" value="<?= $student['name'] ?>">
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" class="form-control form-control-user" name="username" id="username" placeholder="Tên tài khoản" value="<?= $student['username'] ?>">
            </div>
        </div>
        <div class=" form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Mật khẩu">
            </div>
            <div class="col-sm-6">
                <input type="password" class="form-control form-control-user" name="rePassword" id="rePassowrd" placeholder="Nhập lại mật khẩu">
            </div>
        </div>
        <div class="form-group">
            <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Địa chỉ Email" value="<?= $student['email'] ?>">
        </div>
<!-- 
        <div class=" form-group">
            <label class="bold">Lớp</label>
            <select class="form-control first_null not_chosen" name="classID">

                <?php if (isset($classes)) : ?>
                    <?php foreach ($classes as $item) : ?>
                        <option value="<?= $item['id'] ?>" <?php if ($student['classID'] == $item['id'])  echo 'selected'; ?>><?= $item['name'] ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div> -->        
        <?php if (isset($classes)) : ?>
            <div class="form-group col-md-3">
                <?php foreach ($classes as $item) : ?>
                    <input type="checkbox" class="checkbox" id="<?= $item['name'] ?>" name="classID[]" value="<?= $item['id'] ?>" <?php 
                        if (is_array($student['class'])) {
                            foreach($student['class'] as $classID) {
                                if ($item['id'] == $classID) {
                                    echo "checked";
                                }
                            }
                        }
                        ?>>
                    <label for="<?= $item['name'] ?>"><?= $item['name'] ?></label><br>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div class=" form-group">
            <label class="bold">Giới tính</label>
            <select class="form-control first_null not_chosen" name="gender">
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
                <option value="Khác">Khác</option>
            </select>
            <!-- <input type="radio" name="gender" value="Male">Nam
                                        <input type="radio" name="gender" value="Female">Nữ -->
        </div>
        <div class="form-group">
            <label class="bold">Ngày Sinh</label>
            <input type="date" class="form-control" name="birthday" value="<?= date('Y-m-d', strtotime($student['birthday']))?>">
        </div>
        <div class="form-group">
            <input type="phone" class="form-control" name="phonenumber" placeholder="Số điện thoại" value="<?= $student['phoneNumber'] ?>">
        </div>
        <div class=" form-group">
            <input type="text" class="form-control" name="address" placeholder="Địa chỉ" value="<?= $student['address'] ?>">
        </div>
        <div class="row">
            <div class="col-md-6">
                <a href="<?= base_url() . '/home/students' ?>" class="btn btn-primary btn-user btn-block">
                    Trở về
                </a>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Xác nhận
                </button>
            </div>
        </div>
    <?php endif; ?>
</form>
<?= $this->endSection() ?>