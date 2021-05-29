<?= $this->extend('_layout') ?>
<?= $this->section('content') ?>

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Quản lý bộ môn</h1>


<!-- DataTales Example -->
<div class="card shadow mb-4">

    <div class="card-header py-3" style="display: flex;justify-content:space-between;">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách bộ môn</h6>

        <?php session_start() ?>

        <?php if ($_SESSION['role'] == '1') : ?>
            <a href="<?= base_url() . '/home/editClassSubject' ?>" style="width: auto;" class="btn btn-primary btn-user btn-block right">
                Thêm bộ môn
            </a>

        <?php endif; ?>

    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>STT</th>

                        <th>Mã giảng viên</th>
                        <th>Tên giảng viên</th>
                        <th>Tên lớp</th>
                        <th>Tên môn</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>

                    <?php if (isset($result)) : ?>
                        <?php $count = 1; ?>
                        <?php foreach ($result as $item) : ?>
                            <tr>
                                <td><?= $count ?></td>
                                <td><?= $item['teacher']["teacherID"] ?></td>
                                <td><?= $item['teacher']["teacherName"] ?></td>
                                <td><?= $item['class']["className"] ?></td>
                                <td><?= $item['subject']["subjectName"] ?></td>
                                <td>
                                    <a href="<?= base_url() . '/home/editClassSubject?id=' . $item['id'] ?>">Sửa</a>
                                    |
                                    <a href="<?= base_url() . '/home/deleteClassSubject?id=' . $item['id'] ?>" onclick="return confirm('Bạn chắc chắn xóa chứ?')">Xóa</a>
                                </td>
                            </tr>
                            <?php $count++; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>