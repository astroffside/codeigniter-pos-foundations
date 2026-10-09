<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = [
        'username',
        'full_name',
        'password',
        'avatar',
        'created_at',
    ];

    // The activity schema intentionally has no updated_at column.
    protected $useTimestamps = false;
}
