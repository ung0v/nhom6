<?= $this->extend('_layout') ?>
<?= $this->section('content') ?>
<form method="POST" action="" class="user">
    <?php if ($error) : ?>
        <div class="alert alert-danger">
            <strong><?= $error ?></strong>
        </div>
    <?php endif; ?>
    <div class=" form-group">
        <label class="bold">Môn</label>
        <select class="form-control first_null not_chosen" name="role">
            <option value="0">Giảng viên bộ môn</option>
            <option value="1">Admin</option>
        </select>
    </div>
    <div class="row">
        <div class="col-md-6">
            <a href="<?= base_url() . '/home/PhanQuyen' ?>" class="btn btn-primary btn-user btn-block">
                Trở về
            </a>
        </div>
        <div class="col-md-6">
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Xác nhận
            </button>
        </div>
    </div>
</form>
<?= $this->endSection() ?>