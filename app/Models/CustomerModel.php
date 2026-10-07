<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table            = 'customers';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = [
        'full_name',
        'email',
        'phone',
        'created_at',
    ];

    // The activity schema intentionally has no updated_at column.
    protected $useTimestamps = false;
}
