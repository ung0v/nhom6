<?= $this->extend('_layout') ?>
<?= $this->section('content') ?>

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Quản lý môn học</h1>


<!-- DataTales Example -->
<div class="card shadow mb-4">

    <div class="card-header py-3" style="display: flex;justify-content:space-between;">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách môn</h6>

        <?php session_start() ?>

        <?php if ($_SESSION['role'] == '1') : ?>
            <a href="<?= base_url() . '/home/editSubject' ?>" style="width: auto;" class="btn btn-primary btn-user btn-block right">
                Thêm môn
            </a>

        <?php endif; ?>


    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên môn</th>
                        <th>Ngày tạo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1; ?>
                    <?php foreach ($subjects as $item) : ?>
                        <tr>
                            <td><?= $count ?></td>
                            <td><?= $item["name"] ?></td>
                            <td><?= date("d-m-Y", strtotime($item['createdDate'])) ?></td>
                            <td>
                                <a href="<?= base_url() . '/home/editSubject?subjectID=' . $item['id'] ?>">Sửa</a>
                                |
                                <a href="<?= base_url() . '/home/deleteSubject?subjectID=' . $item['id'] ?>" onclick="return confirm('Bạn chắc chắn xóa chứ?')">Xóa</a>
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