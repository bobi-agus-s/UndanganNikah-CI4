<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function index()
    {

    }

    public function login()
    {
        if(session('id_user')) {
            return redirect()->to(site_url('home'));
        }
        return view('auth/login');
    }
    
    public function logout()
    {
        session()->remove('id_user');
        return redirect()->to(site_url('login'));
    }

    public function loginProcess()
    {
        $data = $this->request->getPost();
        $query = $this->db->table('users')->getWhere(['username' => $data['username']]);
        if ($user = $query->getRow()) {
            if (password_verify($data['password'], $user->password)) {
                $params = [
                    'id_user' => $user->id_user
                ];
                session()->set($params);
                return redirect()->to(site_url('home'));
            } else {
                return redirect()->back()->with('error', 'password salah');
            }
        } else {
            return redirect()->back()->with('error', 'username tidak ditemukan');
        }
    }
}
