<?php

namespace App\Models;
use CodeIgniter\Model;

class PracticeModel extends Model
{
    protected $table = 'practice';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email'];
}
