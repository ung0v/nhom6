<?= $this->extend('_layout') ?>
<?= $this->section('content') ?>

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Phân quyền</h1>


<!-- DataTales Example -->
<div class="card shadow mb-4">

    <div class="card-header py-3" style="display: flex;justify-content:space-between;">
        <h6 class="m-0 font-weight-bold text-primary">Phân quyền</h6>


    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Vai trò</th>
                        <th>Tên giảng viên</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>

                    <?php if (isset($AllAdmin)) : ?>
                        <?php $count = 1; ?>
                        <?php foreach ($AllAdmin as $item) : ?>
                            <tr>
                                <td><?= $count ?></td>
                                <td><?php if ($item['role'] == '1') echo 'Admin';
                                    else echo 'Giảng viên bộ môn'; ?></td>
                                <td><?= $item['name'] ?></td>

                                <td>
                                    <a href="<?= base_url() . '/home/editPhanQuyen?id=' . $item['id'] ?>">Sửa</a>
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