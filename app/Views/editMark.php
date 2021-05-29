<?= $this->extend('_layout') ?>
<?= $this->section('content') ?>

<form method="POST" action="<?= base_url() . '/home/editMark?studentID=' . $_GET['studentID'] . '&classID=' . $_GET['classID'] ?>" class="user">

    <div class="form-group">
        <input type="text" class="form-control form-control-user" id="grade" name="grade" placeholder="Nhập điểm">
    </div>
    <div class="row">
        <div class="col-md-6">
            <a href="<?= base_url() . '/home/classes' ?>" class="btn btn-primary btn-user btn-block">
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