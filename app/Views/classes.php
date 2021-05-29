<?= $this->extend('_layout') ?>
<?= $this->section('content') ?>

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Quản lý điểm lớp <?= $currentClass ?></h1>

<form action="<?= base_url() . '/Home/classes' ?>">
    <div class="row">

        <div class="col-md-3">
            <div class="form-group">
                <select class="form-control first_null not_chosen" name="classID">
                    <option value="">--- Chọn lớp ---</option>
                    <?php foreach ($classes as $item) : ?>
                        <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <!-- <div class="col-md-3">
            <div class="form-group">
                <select class="form-control first_null not_chosen" name="subjectID">
                    <option value="">--- Chọn môn ---</option>

                  
                </select>
            </div>
        </div> -->
        <div class="col-md-1">
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Xác nhận
            </button>
        </div>
    </div>
</form>

<!-- DataTales Example -->
<div class="card shadow mb-4">

    <div class="card-header py-3" style="display: flex;justify-content:space-between;">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách lớp</h6>


        <!-- <?php if ($_SESSION['role'] == '1') : ?>
            <a href="<?= base_url() . '/home/addMark' ?>" style="width: auto;" class="btn btn-primary btn-user btn-block right">
                Thêm điểm
            </a>

        <?php endif; ?> -->


    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã sinh viên</th>
                        <th>Lớp</th>
                        <th>Họ và tên</th>
                        <th>Điểm</th>
                        <!-- <th>Thời gian sửa gần đây nhất</th> -->
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1 ?>
                    <?php if (isset($_GET['classID'])) : ?>
                        <?php foreach ($students as $item) : ?>
                            <tr>
                                <td><?= $count ?></td>
                                <td><?= $item["studentCode"] ?></td>
                                <td><?= $item["className"] ?></td>
                                <td><?= $item['name'] ?></td>
                                <td><?= $item["grade"] ?></td>
                                <!-- <td><?php $date =  date_create($item['modifiedDate']);
                                            echo date_format($date, "d-m-Y H:i:s") ?></td> -->
                                <td>
                                    <a href="<?= base_url() . '/home/editMark?studentID=' . $item['id'] . '&classID=' . $_GET['classID'] ?>">Sửa</a>
                                    |
                                    <a onclick="return confirm('Bạn chắc chắn xóa chứ?');" href="<?= base_url() . '/home/deleteMark?studentID=' . $item['id'] . '&classID=' . $_GET['classID'] ?>">Xóa</a>
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