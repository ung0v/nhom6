<?= $this->extend('_layout') ?>
<?= $this->section('content') ?>

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Quản lý giảng viên</h1>


<!-- DataTales Example -->
<div class="card shadow mb-4">

    <div class="card-header py-3" style="display: flex;justify-content:space-between;">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách giảng viên</h6>

        <?php session_start() ?>
        <?php if ($_SESSION['role'] == '1') : ?>
            <a href="<?= base_url() . '/home/editTeacher' ?>" style="width: auto;" class="btn btn-primary btn-user btn-block right">
                Thêm giảng viên
            </a>
        <?php endif; ?>


    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên giảng viên</th>
                        <th>Giới tính</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Ngày sinh</th>
                        <th>Địa chỉ</th>
                        <th>Phụ trách môn</th>
                        <!-- <th>Ngày tạo</th> -->
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1; ?>
                    <?php foreach ($teachers as $item) : ?>
                        <tr>
                            <td><?= $count ?></td>
                            <td><?= $item["name"] ?></td>
                            <td><?= $item["gender"] ?></td>
                            <td><?= $item["email"] ?></td>
                            <td><?= $item["phoneNumber"] ?></td>
                            <td><?= $item['birthday'] ?></td>
                            <td><?= $item["address"] ?></td>
                            <td><?= $item['subjectsName'] ?></td>
                            <!-- <td><?= date("d-m-Y", strtotime($item['createdDate'])) ?></td> -->
                            <td>
                                <a href="<?= base_url() . '/home/editTeacher?id=' . $item['id'] ?>">Sửa</a>
                                |
                                <a onclick="return confirm('Bạn chắc chắn xóa chứ?');" href="<?= base_url() . '/home/deleteTeacher?id=' . $item['id'] ?>">Xóa</a>
                            </td>
                        </tr>
                        <?php $count++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>