<?php

namespace App\Models;

use CodeIgniter\Model;

class SubjectModel extends Model
{
    // protected $DBGroup = 'nhom6';
    protected $table      = 'subject';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $allowedFields = ['id', 'name', 'createdBy', 'createdDate'];
    // protected $createField = '';
    // protected $updatedField = '';
    public function getAll()
    {
        return $this->findAll();
    }
    public function getSubjectById($id)
    {
        return $this->where('id', $id)->findAll();
    }
    public function getByName($name)
    {
        return $this->where('name', $name)->find();
    }
}
