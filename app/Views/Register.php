<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Đăng ký</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url('/public/vendor/fontawesome-free/css/all.min.css'); ?> " rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('/public/css/sb-admin-2.min.css'); ?> " rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Tạo tài khoản</h1>
                            </div>
                            <?php if ($message == "success") : ?>
                                <div class="alert alert-success">
                                    <strong>Tạo tài khoản thành công !</strong> Bấm vào <strong><a href="<?= base_url() ?>">đây</a></strong> để trở về trang chủ
                                </div>
                            <?php elseif ($message == "fail") : ?>
                                <div class="alert alert-danger">
                                    <strong>Tạo tài khoản không thành công !</strong> Đã xảy ra lỗi!!!
                                    <?php if ($error) : ?>
                                        <?php foreach ($error as $item) : ?>
                                            <li><?= $item ?></li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <form method="POST" action="<?= base_url() . '/register' ?>" class="user">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" name="fullname" id="fullname" placeholder="Họ và tên">
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" name="username" id="username" placeholder="Tên tài khoản">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Mật khẩu">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" name="rePassword" id="rePassowrd" placeholder="Nhập lại mật khẩu">
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <input type="radio" id="hs" name="position" value="1" />
                                    <label for="hs">Học sinh</label><br>
                                    <input type="radio" id="gv" name="position" value="0" />
                                    <label for="gv">Giảng viên</label><br>
                                </div> -->
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Địa chỉ Email">
                                </div>
                                <div class="form-group">
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
                                    <input type="date" class="form-control" name="birthday">
                                </div>
                                <div class="form-group">
                                    <input type="phone" class="form-control" name="phonenumber" placeholder="Số điện thoại">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="address" placeholder="Địa chỉ">
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Đăng ký
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="<?= base_url() . '/login' ?>">Đăng nhập</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url('/public/vendor/jquery/jquery.min.js'); ?> "></script>
    <script src="<?php echo base_url('/public/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url('/public/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url('/public/js/sb-admin-2.min.js'); ?>"></script>

</body>

</html>