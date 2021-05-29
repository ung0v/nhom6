<?php

namespace App\Models;

use CodeIgniter\Model;

class MarkModel extends Model
{
    // protected $DBGroup = 'nhom6';
    protected $table      = 'mark';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $allowedFields = ['id', 'classID', 'studentID', 'grade', 'modifiedBy', 'modifiedDate'];
    // protected $createField = '';
    // protected $updatedField = '';
    public function getAll()
    {
        return $this->findAll();
    }
    public function getMarkByStudentID($studentID)
    {
        $condition = [
            'studentID' => $studentID
        ];
        return $this->where($condition)->find();
    }
    public function getMarkByStudentIDAndSubID($studentID, $subID)
    {
        $condition = [
            'studentID' => $studentID,
            'classID' => $subID
        ];
        return $this->where($condition)->find();
    }
}
