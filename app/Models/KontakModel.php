<?php

namespace App\Models;

use CodeIgniter\Model;


class KontakModel extends Model
{
    protected $table            = 'kontak';
    protected $primaryKey       = 'id_kontak';
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = ['nama_kontak', 'phone', 'id_group'];
    // Dates
    protected $useTimestamps = true;

    protected $validationRules    = [
        'id_group'     => 'required', 
        'nama_kontak'        => 'required|min_length[2]',
    ];
    protected $validationMessages = [
        'id_group'        => [
            'required' => 'grub belum dipilih',
        ],
        'nama_kontak' => [
            'required' => 'nama kontak tidak boleh kosong',
            'min_length' => 'nama kontak minimal 2 karakter' 
        ]
    ];

    function getAll()
    {
        $builder = $this->db->table('kontak');
        // $builder->join('groups', 'id_group'); jika field relasi sama
        $builder->join('groups', 'groups.id_group = kontak.id_group');
        return $builder->get()->getResult();
    }

    function getPaginated($num, $keyword = null)
    {
        $builder = $this->builder();
        $builder->join('groups', 'groups.id_group = kontak.id_group');
        if ($keyword != '') {
            $builder->like('nama_kontak', $keyword);
            $builder->orLike('phone', $keyword);
            $builder->orLike('nama_group', $keyword);

        }
        return [
            'kontak' => $this->paginate($num),
            'pager' => $this->pager
        ];
    }


}
