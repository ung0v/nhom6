<?php

namespace App\Models;

use CodeIgniter\Model;

class ClassSubjectModel extends Model
{
    // protected $DBGroup = 'nhom6';
    protected $table      = 'classsubject';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $allowedFields = ['id', 'classID', 'subID', 'adminID', 'modifiedDate'];
    // protected $createField = '';
    // protected $updatedField = '';
    public function getAll()
    {
        return $this->findAll();
    }
    public function getByAdminID($adminID)
    {
        return $this->where('adminID', $adminID)->findAll();
    }
    public function getById($id)
    {
        return $this->where('id', $id)->findAll();
    }
}
