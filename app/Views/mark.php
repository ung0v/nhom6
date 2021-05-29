<?= $this->extend('_layout') ?>
<?= $this->section('content') ?>

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Danh sách điểm</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Bảng điểm của sinh viên: <?= $mark[0]['studentName'] ?></h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã sinh viên</th>
                        <th>Môn</th>
                        <!-- <th>Họ và tên</th> -->
                        <th>Điểm</th>
                        <th>Ngày vào điểm</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>STT</th>
                        <th>Mã sinh viên</th>
                        <th>Môn</th>
                        <!-- <th>Họ và tên</th> -->
                        <th>Điểm</th>
                        <th>Ngày tạo</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php $count = 1; ?>
                    <?php foreach ($mark as $item) : ?>
                        <tr>
                            <td><?= $count ?></td>
                            <td><?= $item["studentCode"] ?></td>

                            <td><?= $item["subjectName"] ?></td>
                            <!-- <td><?= $item["studentName"] ?></td> -->
                            <td><?= $item['grade'] ?></td>
                            <td><?= date("d-m-Y", strtotime($item['modifiedDate'])) ?></td>
                        </tr>
                        <?php $count++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>