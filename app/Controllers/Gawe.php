<?php

namespace App\Controllers;

class Gawe extends BaseController
{
    public function index()
    {
        // cara 1 : query builder
        $builder = $this->db->table('gawe');
        $query   = $builder->get()->getResult();
        // or
        // $query   = $builder->get(); // ketentuan harus ada getResult
        
        // cara 2 : query manual
        // $query = $this->db->query("SELECT * FROM gawe")->getResult();

        return view('gawe/get', compact('query'));

        // $data = [
        //     'query' => $query->getResult()
        // ];
        // return view('gawe/get', $data);
    }

    public function create()
    {
        return view('gawe/add');
    }

    public function store()
    {
        // cara 1 : form name sama
        $data = $this->request->getPost();

        // cara 2 : name spesifik
        // $data = [
        //     'nama_gawe' => $this->request->getPost('nama_gawe'),
        //     'date_gawe' => $this->request->getPost('date_gawe'),
        //     'info_gawe' => $this->request->getPost('info_gawe'),
        // ];

        $this->db->table('gawe')->insert($data);

        if($this->db->affectedRows() > 0){
            return redirect()->to(site_url('gawe'))->with('success', 'data berhasil disimpan');
        }
    }

    public function edit($id = null)
    {
        if($id != null) {
            $query = $this->db->table('gawe')->getWhere(['id_gawe' => $id]);
            if ($query->resultID->num_rows > 0) {
                $data['gawe'] = $query->getRow();
                return view('gawe/edit', $data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function update($id)
    {
        $data = $this->request->GetPost();
        unset($data['_method']);
        $this->db->table('gawe')->where(['id_gawe' => $id])->update($data);
        return redirect()->to(site_url('gawe'))->with('success', 'data berhasil dirubah');
    }

    public function delete($id)
    {
        // $this->db->table('gawe')->where('id_gawe', $id)->delete();
        $this->db->table('gawe')->delete(['id_gawe' => $id]);

        return redirect()->to(site_url('gawe'))->with('success', 'data berhasil dihapus');
    }

    public function deleteAjax($id)
    {
        // $this->db->table('gawe')->where('id_gawe', $id)->delete();
        $this->db->table('gawe')->delete(['id_gawe' => $id]);

        $data = [
            'success' => 'data dihapus',
            'status_text' => 'data gawe berhasil dihapus',
            'status_icon' => 'success'
        ];

        return $this->response->setJSON($data);
        
        // return redirect()->to(site_url('gawe'))->with('success', 'data berhasil dihapus');
    }
}
