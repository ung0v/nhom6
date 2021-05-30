<?php

namespace App\Models;

use CodeIgniter\Model;

class ClassesModel extends Model
{
    // protected $DBGroup = 'nhom6';
    protected $table      = 'class';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $allowedFields = ['id', 'name', 'code', 'numberStudent', 'teacherID', 'subID', 'createdBy', 'createdDate'];
    // protected $createField = '';
    // protected $updatedField = '';
    public function getAll()
    {
        return $this->findAll();
    }
    public function getById($id)
    {
        $condition = [
            'id' => $id,
        ];
        return $this->where($condition)->find();
    }
    public function getByTeacherID($id)
    {
        $condition = [
            'teacherID' => $id,
        ];
        return $this->where($condition)->findAll();
    }
    public function getByIds($id)
    {
        return $this->find($id);
    }
}
