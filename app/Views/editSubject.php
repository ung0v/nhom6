<?= $this->extend('_layout') ?>
<?= $this->section('content') ?>

<form method="POST" class="user">

    <div class="form-group">
        <?php if (isset($subject)) : ?>
            <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Nhập tên môn" value="<?= $subject['name'] ?>">
    </div>
    <div class="row">
        <div class="col-md-6">
            <a href="<?= base_url() . '/home/subject' ?>" class="btn btn-primary btn-user btn-block">
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