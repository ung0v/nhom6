<?= $this->extend('_layout') ?>
<?= $this->section('content') ?>
<form method="POST" action="" class="user">
    <?php if ($error) : ?>
        <div class="alert alert-danger">
            <strong><?= $error ?></strong>
        </div>
    <?php endif; ?>
    <?php if (isset($teachers)) : ?>
        <div class=" form-group">
            <label class="bold">Giảng viên</label>
            <select class="form-control first_null not_chosen" name="teacher">
                <?php if (isset($teachers)) : ?>
                    <?php foreach ($teachers as $item) : ?>
                        <option value="<?= $item['id'] ?>" <?php if ($teacherID == $item['id'])  echo 'selected'; ?>><?= $item['name'] ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <div class=" form-group">
            <label class="bold">Lớp</label>
            <select class="form-control first_null not_chosen" name="class">
                <?php if (isset($classes)) : ?>
                    <?php foreach ($classes as $item) : ?>
                        <option value="<?= $item['id'] ?>" <?php if ($classID == $item['id'])  echo 'selected'; ?>><?= $item['name'] ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <div class=" form-group">
            <label class="bold">Môn</label>
            <select class="form-control first_null not_chosen" name="subject">
                <?php if (isset($subjects)) : ?>
                    <?php foreach ($subjects as $item) : ?>
                        <option value="<?= $item['id'] ?>" <?php if ($subjectID == $item['id'])  echo 'selected'; ?>><?= $item['name'] ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <div class="row">
            <div class="col-md-6">
                <a href="<?= base_url() . '/home/classSubject' ?>" class="btn btn-primary btn-user btn-block">
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