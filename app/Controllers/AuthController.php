<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        // cek request dari form login
        
        if($this->request->getMethod() === 'POST'){
          
          // tangkap kirim form ke disimpan salam variable
          $username = $this->request->getPost('username');
          $password = $this->request->getPost('password');
          
          $modelUser = new UserModel();
          $user = $modelUser->where('username', $username)->first();
          
          if($user && password_verify($password, $user->password)){
            session()->set([
                'login' => true,
                'username' => $user->username,
                'nama' => $user->nama,
                'email' => $user->email,
              ]);
            return redirect()->to('/');
          }
          session()->setFlashdata('error', 'Username atau password salah ketik');
            return redirect()->back();
        }
        return view('login');
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
