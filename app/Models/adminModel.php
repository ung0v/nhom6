<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    // protected $DBGroup = 'nhom6';
    protected $table      = 'admin';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $allowedFields = ['id', 'name', 'username', 'subID', 'email', 'password', 'phoneNumber', 'address', 'birthday', 'gender', 'createdBy', 'createdDate', 'modifiedDate', 'role', 'status'];
    // protected $createField = '';
    // protected $updatedField = '';
    public function getAll()
    {
        return $this->where('role', '0')->findAll();
    }
    public function getById($id)
    {
        return $this->where('id', $id)->find();
    }
    public function getAllAdmin()
    {
        return $this->findAll();
    }
}
