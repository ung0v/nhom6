<?= $this->extend('_layout') ?>
<?= $this->section('content') ?>

<form method="POST" class="user">

    <div class="form-group">
        <?php if (isset($class)) : ?>
            <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Nhập tên lớp" value="<?= $class['name'] ?>">
    </div>
    <div class="form-group">
        <input type="text" class="form-control form-control-user" id="code" name="code" placeholder="Nhập mã lớp" value="<?= $class['code'] ?>">
    </div>
    <div class="form-group">
        <input type="text" class="form-control form-control-user" id="numberStudent" name="numberStudent" placeholder="Nhập sĩ số" value="<?= $class['numberStudent'] ?>">
    </div>
    <?php if (isset($teachers)) : ?>
        <div class=" form-group">
            <label class="bold">Môn</label>
            <select class="form-control first_null not_chosen" name="teacher">
                <?php foreach ($subjects as $item) : ?>
                    <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    <?php endif; ?>
    <?php if (isset($teachers)) : ?>
        <div class=" form-group">
            <label class="bold">Người giảng dạy</label>
            <select class="form-control first_null not_chosen" name="teacher">
                <?php foreach ($teachers as $item) : ?>
                    <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-6">
            <a href="<?= base_url() . '/home/class' ?>" class="btn btn-primary btn-user btn-block">
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