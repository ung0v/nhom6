<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    // protected $DBGroup = 'nhom6';
    protected $table      = 'student';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $allowedFields = ['id', 'name',  'username', 'password', 'classID', 'gender', 'birthday', 'phoneNumber', 'email', 'address', 'createdBy', 'createdDate', 'modifiedDate', 'status', 'studentCode'];
    // protected $createField = '';
    // protected $updatedField = '';
    public function getAll()
    {
        return $this->findAll();
    }
    public function getStudentById($id)
    {
        return $this->where('id', $id)->findAll();
    }
    public function getStudentByCode($code)
    {
        return $this->where('studentCode', $code)->findAll();
    }
    public function getStudentByClassID($id)
    {
        $condition = [
            'classID' => $id
        ];
        return $this->where('classID', $condition)->findAll();
    }
    public function coutStudentbyClassID($id)
    {
        return $this->where('classID', $id)->countAllResults();
    }
}
