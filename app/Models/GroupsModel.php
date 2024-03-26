<?php

namespace App\Models;

use CodeIgniter\Model;

class GroupsModel extends Model
{
    protected $table            = 'groups';
    protected $primaryKey       = 'id_group';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama_group', 'info'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
