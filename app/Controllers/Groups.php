<?php

namespace App\Controllers;

use App\Models\GroupsModel;
use CodeIgniter\RESTful\ResourcePresenter;

class Groups extends ResourcePresenter
{
    // protected $helpers = ['costum']; // di load di ResourcePresenter saja

    public function __construct() {
        $this->group = new GroupsModel();
    }
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */ 
    public function index()
    {
        $data['groups'] = $this->group->findAll();
        return view('groups/index', $data);
    }

    /**
     * Present a view to present a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Present a view to present a new single resource object
     *
     * @return mixed
     */
    public function new()
    {
        return view('groups/new');
    }

    /**
     * Process the creation/insertion of a new resource object.
     * This should be a POST.
     *
     * @return mixed
     */
    public function create()
    {
        $validate = $this->validate([
            'nama_group' => [
                'rules'  => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Nama grup tidak boleh kosong',
                    'min_length' => 'Nama grup minimal 3 karakter'
                ],
            ],
        ]);

        if (!$validate) {
            return redirect()->back()->withInput();
        }

        $data = $this->request->getPost();
        $this->group->insert($data);
        return redirect()->to(site_url('groups'))->with('success', 'data berhasil disimpan');

    }

    /**
     * Present a view to edit the properties of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        if ($id != null) {
            if ($data['group'] = $this->group->where('id_group', $id)->first()) {
                $data['validation'] = \Config\Services::validation();
                return view('groups/edit', $data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    /**
     * Process the updating, full or partial, of a specific resource object.
     * This should be a POST.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $validate = $this->validate([
            'nama_group' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Nama grup tidak boleh kosong',
                    'min_length' => 'Nama grub minimal 3 karakter',
                ]
            ]
        ]);

        if (!$validate) {
            return redirect()->back()->withInput();
        }

        $data = $this->request->getPost();
        unset($data['_method']);
        $this->group->update($id, $data);
        return redirect()->to(site_url('groups'))->with('success', 'data berhasil diubah');
    }

    /**
     * Present a view to confirm the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function remove($id = null)
    {
        //
    }

    /**
     * Process the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $this->group->where('id_group', $id)->delete();
        return redirect()->to(site_url('groups'))->with('success', 'data berhasil dihapus');
    }

    public function trash()
    {
        $data['groups'] = $this->group->onlyDeleted()->findAll();
        return view('groups/trash', $data);
    }

    public function restore($id = null)
    {
        $this->db = \Config\Database::connect();
        if ($id != null) {
            $this->db->table('groups')
                ->set('deleted_at', null, true)
                ->where(['id_group' => $id])
                ->update();
            if ($this->db->affectedRows() > 0) {
                return redirect()->to(site_url('groups'))->with('success', 'data berhasil direstore');
            }
        } else {
            // cara 1 -- berat jika datanya banyak
            // $this->db->table('groups')
            //     ->set('deleted_at', null, true)
            //     ->update();
            
            // cara 2
            $this->db->table('groups')
                ->set('deleted_at', null, true)
                ->where('deleted_at IS NOT NULL', NULL, FALSE)
                ->update();

            if ($this->db->affectedRows() > 0) {
                return redirect()->to(site_url('groups'))->with('success', 'semua data berhasil direstore');
            }
        }
    }

    public function delete2($id = null)
    {
        if ($id != null) {
            $this->group->delete($id, true);
            return redirect()->to(site_url('groups/trash'))->with('success', 'berhasil dihapus permanen');
        } else {
            $this->group->purgeDeleted();
            return redirect()->to(site_url('groups/trash'))->with('success', 'semua data berhasil dihapus permanen');
        }
    }
}
